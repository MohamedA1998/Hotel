<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('Image.index');
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
        dd('Test Make New Branch');
        // $file = base64_decode(request('file'));
        // // dump($file);
        dd($request->all());
        // if($request->hasFile('image')){
            $request->file('file')->move(
                public_path('flat'), uniqid('flat') . '.' . $request->file('file')->extension()
            );
        // }

        return redirect()->back()->with('success','This Image Was Stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
