<?php

namespace Database\Factories;

use App\Models\Reserve;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReserveFactory extends Factory
{
    protected $model = Reserve::class;

    public function definition()
    {
        return [
            'id_product' => Product::factory(),
            'quantity_reserve' => rand(1, 10)
        ];
    }
}
