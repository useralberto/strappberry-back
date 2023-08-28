<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
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
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'description' => $this->faker->sentence,
            'quantity' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl(200, 200, 'products', true),
            'category_id' => $this->faker->numberBetween(1, 6),
        ];
    }
}
