<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteSetting>
 */
class SiteSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'logo'      => '',
            'phone'     => fake()->phoneNumber,
            'address'   => fake()->address,
            'email'     => fake()->email,
            'facebook'  => 'https://www.facebook.com/',
            'twitter'   => 'https://twitter.com',
            'copyright' => 'Copyright © ' . date('Y') . '. All right reserved.'
        ];
    }
}