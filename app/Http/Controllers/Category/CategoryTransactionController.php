<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryTransactionController extends ApiController
{
    public function index(Category $category){
        $transactions = $category->products()->whereHas('transactions')->with('transactions')->get()
            ->pluck('transactions')
            ->collapse()->unique('id');
        return $this->showAll($transactions);
    }
}
