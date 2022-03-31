<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $this->showOne($category);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
