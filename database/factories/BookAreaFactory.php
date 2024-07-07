<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookArea>
 */
class BookAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ShortTitle'    => fake()->sentence(3),
            'MainTitle'     => fake()->sentence,
            'ShortDesc'     => fake()->sentence(35),
            'image'       => fake()->imageUrl()
        ];
    }
}
