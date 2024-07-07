<?php

namespace App\Http\Controllers\Backend;

use App\Facades\ImageFacade;
use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{

    public function index()
    {
        return view('backend.allroom.roomtype.index' , [
            'RoomTypes' =>  RoomType::with('room')->latest()->get(),
        ]);
    }
    

    public function store(Request $request)
    {
        RoomType::create([
            'name'  => $request->name
        ])->room()->create();
        
        toastr('RoomType Inserted Successfully' , 'success' , 'Room Type');

        return redirect()->back();
    }
    

    public function destroy(RoomType $type)
    {
        ImageFacade::delete($type->room->image);

        $type->delete();

        toastr('RoomType Was Deleted Successfully' , 'success' , 'Room Type');

        return redirect()->back();
    }
}

