<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Product>
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            ['name' => 'TV LED 55"', 'category' => 'Elektronik', 'price' => 5999000],
            ['name' => 'Kulkas 2 Pintu', 'category' => 'Elektronik', 'price' => 6750000],
            ['name' => 'Mesin Cuci Front Loading', 'category' => 'Elektronik', 'price' => 4500000],
            ['name' => 'Sofa Minimalis 3 Seater', 'category' => 'Furnitur', 'price' => 3200000],
            ['name' => 'Lemari Pakaian 3 Pintu', 'category' => 'Furnitur', 'price' => 2800000],
            ['name' => 'AC Split 1 PK', 'category' => 'Elektronik', 'price' => 3500000],
        ];

        $product = fake()->randomElement($products);

        return [
            'name' => $product['name'],
            'price' => $product['price'],
            'status' => fake()->randomElement(['promo', 'baru', 'reguler']),
            'description' => fake()->sentence(10),
            'category' => $product['category'],
            'is_active' => true,
        ];
    }
}