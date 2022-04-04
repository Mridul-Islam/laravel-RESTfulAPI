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
        $rules = [
            'name' => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $rules);

        $newCategory = Category::create($request->all());
        return $this->showOne($newCategory, 201);

    }


    public function show(Category $category)
    {
        //$category = Category::findOrFail($id);
        return $this->showOne($category);
    }


    public function update(Request $request, Category $category)
    {
        if($request->has('name')){
            $category->name = $request->name;
        }
        if($request->has('description')){
            $category->description = $request->description;
        }
        if(!$category->isDirty()){
            return $this->errorResponse('You need to specify a different value to update',  422);
        }

        $category->save();
        return $this->showOne($category);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
