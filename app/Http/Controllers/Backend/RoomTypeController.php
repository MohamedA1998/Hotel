<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.allroom.roomtype.index' , [
            'RoomTypes' => RoomType::orderBy('id' , 'desc')->get(),
        ]);
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
        RoomType::create([
            'name'  => $request->name
        ])->room()->create();

        return redirect()->back()->with($this->alert('success' , 'RoomType Inserted Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $type)
    {
        $room = $type->room ;
        $room->facility()->delete();
        $room->roomnumber()->delete(); 
        // Delete Image
        if ( count($type->room->images) > 0 || $type->room->image ){
            Storage::delete($type->room->image);

            if( count($type->room->images) > 0 ){
                foreach( $type->room->images as $image ){
                    Storage::delete( $image->path );
                }
            }
        }

        $room->images()->delete();

        $type->room()->delete();

        $type->delete();

        return redirect()->back()->with($this->alert('success' , 'RoomType Was Deleted Successfully'));
    }
}

