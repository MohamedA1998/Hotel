<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomNumber;
use Illuminate\Http\Request;

class RoomNumberController extends Controller
{
    public function store(Request $request , Room $room)
    {
        $room->roomnumber()->create([
            'room_type_id'  => $room->roomType->id    ,
            'room_number'    => $request->room_number ,
            'status'        => $request->status
        ]);

        toastr()->success('Room Number Was Created!!!','Room Number');

        return redirect()->back();
    }
    

    public function update(Request $request, Room $room , RoomNumber $roomnumber)
    {
        $roomnumber->update([
            'room_number'    => $request->room_number ,
            'status'        => $request->status
        ]);

        toastr()->success('Room Number Was Updated!!!','Room Number');

        return redirect()->back();
    }
    

    public function destroy(Room $room , RoomNumber $roomnumber)
    {
        $roomnumber->delete();

        toastr()->success('Room Number Was Deleted!!!','Room Number');

        return redirect()->back();
    }
}
