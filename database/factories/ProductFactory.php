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
    public function definition()
    {
        return [
            //'tgl_entry' => now(),
            'user' => fake()->name(),
            'no_hp' => fake()->randomNumber(5, false),
            'bidang_system' => fake()->sentence(),
            'kategori' => fake()->sentence(),
            'sub_kategori' => fake()->sentence(),
            'menu' => fake()->sentence(),
            'problem' => fake()->sentence(),
            'result' => fake()->sentence(),
            'prioritas' => fake()->randomElement([0, 1]),
            'status' => fake()->randomElement([0, 1]),
            'handle_by' => fake()->name()
        ];
    }
}
