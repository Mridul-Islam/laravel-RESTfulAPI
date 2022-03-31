<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        user::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $usersQuantity = 30;
        $categoriesQuantity = 15;
        $productsQuantity = 50;
        $transactionsQuantity = 60;

        User::factory($usersQuantity)->create();
        Category::factory($categoriesQuantity)->create();
        Product::factory($productsQuantity)->create()->each(function ($product){
            $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
            $product->categories()->attach($categories);
        });
        Transaction::factory($transactionsQuantity)->create();

    }//End of run function
}// End of DatabaseSeeder class
