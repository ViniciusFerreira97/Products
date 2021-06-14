<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'id_client' => Client::factory(),
            'sku_product' => $this->faker->name(),
            'quantity_product' => rand(10, 50)
        ];
    }
}
