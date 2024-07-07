<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $iamge = [];
        for ($i=0; $i < 5; $i++) { 
            $iamge[] = fake()->imageUrl();
        }

        $adult = rand(1 , 5);
        $child = rand(1, 3);

        return [
            'total_adult'   => $adult,
            'total_child'   => $child,
            'room_capacity' => $adult + $child,
            'image'         => implode(',' , $iamge),
            'price'         => fake()->numberBetween(250 , 2000),
            'size'          => rand(25 , 150),
            'discount'      => fake()->numberBetween(5 , 40),
            'short_desc'    => fake()->sentence,
            'description'   => fake()->sentence(500),
            'status'        => true,
        ];
    }
}
