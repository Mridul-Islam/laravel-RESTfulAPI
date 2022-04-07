<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerBuyerController extends ApiController
{
    public function index(Seller $seller){
        $buyers = $seller->products()->whereHas('transactions')->with('transactions.buyer')
            ->get()->pluck('transactions')->collapse()->pluck('buyer')->unique('id');
        return $this->showAll($buyers);
    }
}
