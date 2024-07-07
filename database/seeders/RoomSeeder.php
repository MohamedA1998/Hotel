<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = RoomType::orderBy('id' , 'desc')->get();

        $facilitys = collect(['Complimentary Breakfast', '32/42 inch LED TV', 'Smoke alarms',
                                    'Minibar', 'Work Desk', 'Free Wi-Fi', 'Safety box', 'Rain Shower', 'Slippers',
                                    'Hair dryer', 'Wake-up service', 'Laundry & Dry Cleaning', 'Electronic door lock']);
                                    
        foreach($roomTypes as $roomType){
            Room::factory()->count(1)->make()->each(function($room)use($roomType , $facilitys){
                $room->room_type_id = $roomType->id;
                $room->save();
    
                for ($i=0; $i < rand(5,12); $i++) { 
                    $room->facility()->create([
                        'facility_name' => $facilitys->random()
                    ]);
                }
            });
        }
    }
}
