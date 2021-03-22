<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => rand(100, 10000),
            'approved' => rand(0, 1),
            'status' => rand(0, 1),
            'quantity' => rand(1, 30),
            'category_id' => rand(1, 10),
        ];
    }
}
