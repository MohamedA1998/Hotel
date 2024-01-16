<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomNumber;
use Illuminate\Http\Request;

class RoomNumberController extends Controller
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
        $room = Room::find($request->RoomId);

        $room->roomnumber()->create([
            'room_type_id'  => $room->roomType->id    ,
            'RoomNumber'    => $request->RoomNumber ,
            'Status'        => $request->Status
        ]);

        return redirect()->back()->with($this->alert('success' , 'Room Number Was Created!!!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomNumber $roomNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomNumber $roomNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomNumber $roomnumber)
    {
        $roomnumber->update([
            'RoomNumber'    => $request->RoomNumber ,
            'Status'        => $request->Status
        ]);

        return redirect()->back()->with($this->alert('success' , 'Room Number Was Updated!!!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomNumber $roomnumber)
    {
        $roomnumber->delete();

        return redirect()->back()->with($this->alert('success' , 'Room Number Was Deleted!!!'));
    }
}
