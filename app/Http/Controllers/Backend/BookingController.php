<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use App\Models\RoomNumber;
use Illuminate\Http\Request;
use App\Models\RoomBookedDate;
use App\Models\BookingRoomList;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Mail\BookConfirm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.booking.booking_list' , [
            'allData' => Booking::orderBy('id','desc')->get()
        ]);
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
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // $editData = Booking::with('room')->find($id);
        return view('backend.booking.edit_booking',[
            'editData'  => $booking ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        if(isset($request->payment_status) && isset($request->status))
        {
            $booking->payment_status    = $request->payment_status;
            $booking->status            = $request->status;
            $booking->save();

            // Mail
            Mail::to( $booking->email )->send(new BookConfirm( $booking ));

            return redirect()->back()->with($this->alert('success' , 'Information Updated Successfully'));
        }


        if( isset($request->check_in) && isset($request->check_out ))
        {   
            if ($request->available_room < $request->number_of_rooms) {
                return redirect()->back()->with($this->alert('error' , 'Something Want To Wrong!'));
            }
    
            $data = $booking ;
            $data->number_of_rooms = $request->number_of_rooms;
            $data->check_in = date('Y-m-d', strtotime($request->check_in));
            $data->check_out = date('Y-m-d', strtotime($request->check_out));
            $data->save();
    
            BookingRoomList::where('booking_id', $data->id)->delete();
    
            $sdate = date('Y-m-d',strtotime($request->check_in ));
            $edate = date('Y-m-d',strtotime($request->check_out));
            $eldate = Carbon::create($edate)->subDay();
            $d_period = CarbonPeriod::create($sdate,$eldate);
            foreach ($d_period as $period) {
                $booked_dates = new RoomBookedDate();
                $booked_dates->booking_id = $data->id;
                $booked_dates->room_id = $data->rooms_id;
                $booked_dates->book_date = date('Y-m-d', strtotime($period));
                $booked_dates->save();
            }
            
            return redirect()->back()->with($this->alert('success' , 'Booking Updated Successfully'));

        }

        return redirect()->back()->with($this->alert('error' , 'Method Dos Not Working!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }



    public function AssignRoom( $booking_id )
    {
        $booking = Booking::find( $booking_id );

        $booking_date_array = RoomBookedDate::where('booking_id',$booking_id)->pluck('book_date')->toArray();

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$booking_date_array)->where('room_id',$booking->room_id)->distinct()->pluck('booking_id')->toArray(); 

        $booking_ids = Booking::whereIn('id',$check_date_booking_ids)->pluck('id')->toArray();

        $assign_room_ids = BookingRoomList::whereIn('booking_id',$booking_ids)->pluck('room_number_id')->toArray();
        
        $room_numbers = RoomNumber::where('room_id',$booking->room_id)->whereNotIn('id',$assign_room_ids)->where('Status','Active')->get();

        return view('backend.booking.assign_room',compact('booking','room_numbers'));
    }



    public function AssignRoomStore($booking_id,$room_number_id){

        $booking = Booking::find($booking_id);
        $check_data = BookingRoomList::where('booking_id',$booking_id)->count();

        if ($check_data < $booking->number_of_rooms) {
            
            $assign_data = new BookingRoomList();
            $assign_data->booking_id = $booking_id;
            $assign_data->room_id = $booking->room_id;
            $assign_data->room_number_id = $room_number_id;
            $assign_data->save();
            
            return redirect()->back()->with($this->alert('success' , 'Room Assign Successfully'));   
 
        }else { 
            
            return redirect()->back()->with('error' , 'Room Already Assign');   
            
        }

     }// End Method 



    public function AssignRoomDelete($id)
    {
        $assign_room = BookingRoomList::find($id);
        
        $assign_room->delete();
        
        return redirect()->back()->with($this->alert('success' , 'Assign Room Deleted Successfully'));   
    }// End Method 

    

    public function DownloadInvoice( $id )
    {
        $editData = Booking::with('room')->find( $id );
        
        $pdf = Pdf::loadView('backend.booking.booking_invoice',compact('editData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('invoice.pdf');
    }




    // Change Count Notification
    public function MarkAsRead(Request $request , $notificationId)
    {
        $user = Auth::user();

        $notification = $user->notifications()->where('id',$notificationId)->get();

        if ($notification) {
            $notification->markAsRead();
        }        
        
        return response()->json(['count' => $user->unreadNotifications()->count()]);
    }

}
