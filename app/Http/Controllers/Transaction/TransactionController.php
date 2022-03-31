<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends ApiController
{

    public function index()
    {
        $transactions = Transaction::all();
        return $this->showAll($transactions);
    }


    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return $this->showOne($transaction);
    }


}
