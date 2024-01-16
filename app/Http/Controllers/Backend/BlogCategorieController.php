<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategorie;
use Illuminate\Http\Request;

class BlogCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('backend.category.index' , ['categories' => BlogCategorie::all()]);
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
        // $request->validate([]);

        BlogCategorie::create([
            'CategoryName'  => $request->CategoryName ,
            'CategorySlug'  => strtolower(str_replace(' ' , '-' , $request->CategoryName))
        ]);

        toastr()->success('Blog Category Was Created!');
                
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategorie $blogCategorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategorie $blogCategorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategorie $blogCategorie)
    {
        // $request->validate([]);
        
        $blogCategorie->update([
            'CategoryName'  => $request->CategoryName ,
            'CategorySlug'  => strtolower(str_replace(' ' , '-' , $request->CategoryName))
        ]);
                
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategorie $blogCategorie)
    {
        $blogCategorie->delete();

        return redirect()->back();
    }
    


}
