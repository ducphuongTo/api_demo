<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'product_name' => $this->faker->word,
            'product_thumbnail' => $this->faker->imageUrl(640,480),
            'product_image' => $this->faker->imageUrl(640,480),
            'desc' => $this->faker->paragraph,
            'product_price' => $this->faker->numberBetween(1000, 20000),
            'category_id' => $this->faker->numberBetween(1, 4),
            'brand_id' => $this->faker->numberBetween(1, 7),
            'user_id' => function() {
                return User::all()->random();
        },
        ];
    }
}
