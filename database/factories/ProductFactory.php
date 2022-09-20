<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

    protected $model = Product::class;

    public function definition()
    {
        $name = fake()->unique()->name();
        return [
            'category_id' => fake()->numberBetween(1,5),
            'subcategory_id' => null,
            'name' => $name,
            'slug' => Str::slug($name),
            'short_description' => fake()->text(200),
            'description' => fake()->text(500),
            'regular_price' => fake()->numberBetween(10,500),
            'SKU' => 'DIGI'.fake()->unique()->numberBetween(100,500),
            'stock_status' => 'instock',
            'quantity' => fake()->numberBetween(100,200),
            'image' => 'digital_'.fake()->unique()->numberBetween(1,22).'.jpg',
        ];
    }
}
