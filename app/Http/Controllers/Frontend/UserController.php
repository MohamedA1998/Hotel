<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookArea;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Room;
use App\Models\Team;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function HomePage()
    {
        return view('frontend.index' , [
            'rooms'         => Room::with('roomType')->limit(4)->get(),
            'teams'         => Team::latest()->get()    ,
            'bookarea'      => BookArea::first()    ,
        ]);
    }


    public function UserBooking()
    {
        return view('frontend.dashboard.UserBooking' , [
            'user'   => User::with('booking')->find(Auth::id()),
        ]);
    }

    public function UserInvoicePDF( $id )
    {
        $editData = Booking::with('room')->find( $id );
        
        $pdf = Pdf::loadView('backend.booking.booking_invoice',compact('editData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('invoice.pdf');
    }


    public function ShowAllGallery()
    {
        return view('frontend.gallery.gallery' , [
            'gallery'   => Gallery::latest()->get()
        ]);
    }
    

    public function ContactUS()
    {
        return view('frontend.contact.contact');
    }

    public function StoreContact(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with($this->alert('success' , 'Your Message Was Sented'));
    }

}
