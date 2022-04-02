<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends ApiController
{

    public function index()
    {
        $buyers = Buyer::has('transactionss')->get();
        return $this->showAll($buyers);
    }


    public function show($id)
    {
        $buyer = Buyer::has('transactions')->findOrFail($id);
        return $this->showOne($buyer);
    }


}
