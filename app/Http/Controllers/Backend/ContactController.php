<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function GetMessage()
    {
        return view('backend.contact.contact' , [
            'messages'  => Contact::latest()->get(),
        ]);
    }


}
