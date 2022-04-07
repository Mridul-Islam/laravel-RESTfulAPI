<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use function PHPUnit\Framework\throwException;

class SellerProductController extends ApiController
{
    public function index(Seller $seller){
        $products = $seller->products;
        return $this->showAll($products);
    }

    public function store(Request $request, User $seller){
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'image'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = "mobile.jpg";
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->showOne($product);

    }

    public function update(Request $request, Seller $seller, Product $product){
        $rules = [
            'quantity' => 'integer|min:1',
            'image' => 'image',
            'status' => 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
        ];

        $this->validate($request, $rules);
        $this->checkSeller($seller, $product);
        $product->fill($request->only([
            'name',
            'description',
            'quantity'
        ]));
        if($request->has('status')){
            $product->status = $request->status;
            if($product->is_available() && $product->categories()->count() == 0){
                return $this->errorResponse('An active product must have at least one category', 409);
            }
        }
        if($product->isClean()){
            return $this->errorResponse('You need to speciry a defferent value', 422);
        }
        $product->save();
        return $this->showOne($product);
    }

    public function destroy(Seller $seller, Product $product){
        $this->checkSeller($seller, $product);
        $product->delete();
        return $this->showOne($product);
    }

    public function checkSeller(Seller $seller, Product $product){
        if($seller->id != $product->seller_id){
            throw new HttpException(422, 'This seller is not the owner of this product');
        }
    }



}// End of class
