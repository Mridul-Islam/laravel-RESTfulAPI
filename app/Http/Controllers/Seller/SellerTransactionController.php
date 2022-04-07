<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerTransactionController extends ApiController
{

    public function index(Seller $seller)
    {
        $transactions = $seller->products()->with('transactions')->get()->pluck('transactions')
            ->collapse();
        return $this->showAll($transactions);
    }

}
