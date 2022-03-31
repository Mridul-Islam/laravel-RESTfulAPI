<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::all();
        return response()->json(['data' => $transactions]);
    }


    public function show($id)
    {
        //
    }


}
