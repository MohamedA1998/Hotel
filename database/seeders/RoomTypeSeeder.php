<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomType = collect([ 'PREMIER SINGLE', 'SUPER PREMIER DELUXE', 'PREMIER DELUXE TWIN' , 'EXECUTIVE SULTE' ])
            ->each(function ($roomType) {
                RoomType::create([
                    'name'=> $roomType,
                ]);
            });
    }
}
