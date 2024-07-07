<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::with('roomType')->get();

        foreach($rooms as $room){
            $loopCount = rand(5 , 15);

            for ($i=0; $i < $loopCount; $i++) {
                RoomNumber::create([
                    'room_id'       => $room->id,
                    'room_type_id'  => $room->roomType->id,
                    'room_number'   => fake()->numberBetween($room->id . '11' , $room->id . '99') ,
                ]);
            }
        }

        
    }
}
