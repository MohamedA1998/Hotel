<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.gallery.index' , [
            'gallerys'  => Gallery::with('images')->latest()->get() ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.gallery.addGallery');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if( $request->images ){
            foreach( $request->images as $image ){
                $path = $image->store('upload/gallery');
                // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                // Image::make($image)->resize(550,550)->save('upload/gallery/'.$name_gen);
                // $path = 'upload/gallery/'.$name_gen;

                $gallery = Gallery::create();

                $gallery->images()->create([
                    'path'  => $path
                ]);
            }
        }

        return redirect()->route('gallery.index')->with($this->alert('success' , 'Gallery Was Uploaded!!!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('backend.gallery.editGallery' , [
            'gallery'   => $gallery ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        if( $request->hasFile('image') ){
            $path = $request->file('image')->store('upload/gallery');

            Storage::delete( $gallery->images->path );

            $gallery->images()->update([
                'path'  => $path
            ]);
        }

        return redirect()->route('gallery.index')->with($this->alert('success' , 'Gallery Was Updated!!!')); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        
            Storage::delete( $gallery->images->path );
            $gallery->images()->delete();
        

        $gallery->delete();
        
        return redirect()->back()->with($this->alert('success' , 'Image Was Deleted!!!'));
    }


    public function DeleteSelected( Request $request )
    {
        $items = $request->input('selectedItem' , []);

        foreach( $items as $item ){
            $gallery = Gallery::find($item);

            Storage::delete( $gallery->images->path );

            $gallery->images()->delete();

            $gallery->delete();
        }

        return redirect()->back()->with($this->alert('success' , 'Images Was Deleted!!!'));
    }


}
