<?php

namespace App\Http\Controllers\Backend;

use App\Facades\ImageFacade;
use App\Http\Controllers\Controller;
use App\Models\BookArea;
use Illuminate\Http\Request;

class BookAreaController extends Controller
{
    public function index()
    {
        return view('backend.bookarea.index' , [
            'bookarea' =>  BookArea::first()
        ]);
    }
    

    public function update(Request $request, BookArea $bookarea)
    {     
        $bookarea->update([
            'ShortTitle'    => $request->ShortTitle ,
            'MainTitle'     => $request->MainTitle ,
            'ShortDesc'     => $request->ShortDesc ,
            'image'         => $request->photo
        ]);

        ImageFacade::size(1000 , 1000)->update($bookarea , 'upload/bookarea');

        toastr('Book Are Updated With Image Success.' ,'success' , 'Book Area Updated');

        return redirect()->route('bookarea.index');
    }
}
