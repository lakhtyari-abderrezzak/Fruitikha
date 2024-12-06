<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categories_id'=> 1,
            'user_id'=> 1,
            'name'=>fake()->sentence(2),
            'price'=>20,
            'quntity'=> 10,
            'img_url'=>'assets/img/products/product-img-1',
        ];
    }
}
