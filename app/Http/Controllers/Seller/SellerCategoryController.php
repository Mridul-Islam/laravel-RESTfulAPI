<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerCategoryController extends ApiController
{
    public function index(Seller $seller){
        $categories = $seller->products()->with('categories')->get()->pluck('categories')->collapse()
            ->unique('id');
        return $this->showAll($categories);
    }
}
