<?php

namespace App\Http\Controllers\Backend;

use App\Facades\Image;
use App\Http\Controllers\Controller;
use App\Models\BookArea;
use Illuminate\Http\Request;

class BookAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        return view('backend.bookarea.index' , ['bookarea' =>  BookArea::first()]);
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
    public function show(BookArea $bookArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookArea $bookArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookArea $bookarea)
    {     
        $bookarea->update([
            'ShortTitle'    => $request->ShortTitle ,
            'MainTitle'     => $request->MainTitle ,
            'ShortDesc'     => $request->ShortDesc ,
            'LinkUrl'       => $request->LinkUrl
        ]);    

        Image::size(1000 , 1000)->update($bookarea , 'photo' , 'upload/bookarea');

        return redirect()->back()->with($this->alert('success' , 'Book Area Was Updated'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookArea $bookArea)
    {
        //
    }
}
