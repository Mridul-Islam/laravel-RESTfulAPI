<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition()
    {
        $seller = Seller::has('products')->get()->random();
        $buyer = User::all()->except($seller->id)->random();
        return [
            'quantity' => $this->faker->numberBetween(1, 3),
            'buyer_id' => $this->$buyer->id,
            'product_id' => $this->$seller->products->random()->id
        ];
    }
}
