<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    // Image Testimonial
    // Image::make()->resize(50,50);
    
    
    public function index()
    {
        return view('backend.testimonial.index' , ['testimonials' => Testimonial::all()]);
    }

    

    public function create()
    {
        //
    }

    
    
    public function store(Request $request)
    {
        $testimonial = Testimonial::create([
            'name'      => $request->name ,
            'city'      => $request->city ,
            'message'   => $request->message
        ]);

        if ( $request->hasFile('photo') ){
            $path = $request->file('photo')->store('upload/testimonial');
            $testimonial->images()->create([
                'path'  => $path
            ]);
        }

        return redirect()->back();
    }

    
        
    public function show(Testimonial $testimonial)
    {
        //
    }
    


    public function edit(Testimonial $testimonial)
    {
        
    }
    


    public function update(Request $request, Testimonial $testimonial)
    {
        // $request->validate([]);
        $testimonial->update([
            'name'      => $request->name ,
            'city'      => $request->city ,
            'message'   => $request->message
        ]);

        if( $request->hasFile('photo') ){
            $path = $request->file('photo')->store('upload/testimonial');

            if( $testimonial->images ){
                Storage::delete( $testimonial->images->path );
                $testimonial->images->path = $path;
                $testimonial->images->save();
            }else{
                $testimonial->images()->create([
                    'path'  => $path
                ]);
            }
        }
        
        return redirect()->back();
    }
    


    public function destroy(Testimonial $testimonial)
    {
        if( $testimonial->images ){
            Storage::delete( $testimonial->images->path );
            $testimonial->images()->delete();
        }

        $testimonial->delete();
        
        return redirect()->back();
    }



}
