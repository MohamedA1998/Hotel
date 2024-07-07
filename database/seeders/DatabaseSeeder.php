<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BookArea;
use App\Models\SiteSetting;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::factory(1)->admin()->create();
        User::factory(1)->user()->create();

        Team::factory(10)->create();
        BookArea::factory()->create();
        SiteSetting::factory()->create();

        $this->call([
            RoomTypeSeeder::class,
            RoomSeeder::class,
            RoomNumberSeeder::class
        ]);
    }
}
