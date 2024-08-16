<?php

namespace App\Http\Controllers\Backend;

use App\Facades\ImageFacade;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function edit(Room $room)
    {
        $room->load(['roomType' , 'images' , 'facility' , 'roomnumber']);

        return view('backend.allroom.rooms.editroom' , [
            'room' => $room
        ]);
    }

    public function update(Request $request, Room $room)
    {
        $room->update([
            'total_adult'       => $request->total_adult ,
            'total_child'       => $request->total_child ,
            'room_capacity'     => $request->room_capacity ,
            'price'             => $request->price ,
            'size'              => $request->size   ,
            'view'              => $request->view   ,
            'bed_style'         => $request->bed_style ,
            'discount'          => $request->discount   ,
            'short_desc'        => $request->short_desc   ,
            'description'       => $request->description ,
        ]);

        ImageFacade::size(550 , 550)->update($room ,'upload/room');

        if (isset($request->facility_name) && !empty($request->facility_name)){
            $room->facility()->delete();

            foreach( $request->facility_name as $facility ){
                $room->facility()->create(['facility_name' => $facility]);
            }
        }

        toastr()->success('Room Was Updated Successfully!!!','Room Updated');

        return redirect()->back();
    }

    public function RoomDeleteSpaceficImage(Room $room , $index)
    {
        ImageFacade::deleteByIndex($room , $index);

        toastr()->success('Image Was Deleted Successfully!!!','Room Updated');

        return redirect()->back();
    }
}
