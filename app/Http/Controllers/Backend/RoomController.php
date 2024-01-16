<?php

namespace App\Http\Controllers\Backend;

use App\Facades\ImageFacade;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($room)
    {
        return view('backend.allroom.rooms.editroom' , [
            'room' => Room::with(['roomType' , 'images' , 'facility' , 'roomnumber'])->find($room)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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
            'status'            => 1
        ]);
        
        // Single Image This First Image Was Created And Updateing
        ImageFacade::size(550 , 550)->save();

        if( $request->hasFile('image') ){
            $path = $request->file('image')->store('upload/room');

            if( !empty( $room->image ) ){
                Storage::delete( $room->imageurl());
                $room->image = $path ;
                $room->save();
            }else{
                $room->image = $path;
                $room->save();
            }
        }

        if( !empty( $request->images ) ){
            // Delete From Database
            if( !empty($room->images) > 0 ){
                foreach( $room->images as $image ){
                    Storage::delete($image->path);
                }
            }

            $room->images()->delete();
            // You Wont To Delete From Storage Folder

            foreach( $request->images as $image ){
                $path = $image->store('upload/room');

                $room->images()->create([
                    'path'  => $path
                ]);
            }
        }
        
        // Facility Data
        if ( $request->facility_name == null ){
            return redirect()->back()->with($this->alert('error' , 'Sorry Not Any Basic Facility Select'));            
        }else{
            $room->facility()->delete();

            foreach( $request->facility_name as $facility ){
                $room->facility()->create(['facility_name' => $facility]);
            }
        }
                
        return redirect()->back()->with($this->alert('success' , 'Room Was Updated Successfully!!!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }

    public function RoomDeleteImageFromImages(Image $image)
    {
        Storage::delete($image->path);

        $image->delete();

        return redirect()->back()->with($this->alert('success' , 'Image Was Deleted Successfully!!!'));
    }

    

}
