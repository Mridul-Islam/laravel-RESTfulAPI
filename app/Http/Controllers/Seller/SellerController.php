<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{

    public function index()
    {
        $seller = Seller::has('products')->get();
        return response()->json(['data' => $seller], 200);
    }


    public function show($id)
    {
        $seller = Seller::has('products')->findOrFail($id);
        return response()->json(['data' => $seller], 200);
    }

}
