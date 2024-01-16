<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Stripe;
use App\Models\Room;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\RoomBookedDate;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\BookingComplete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class FrontBookingController extends Controller
{
    

    public function BookingStore( Request $request )
    {
        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'persion' => 'required',
            'number_of_rooms' => 'required',
        ]);

        if ($request->available_room < $request->number_of_rooms) {
            return redirect()->back()->with($this->alert('error' , 'Something want to wrong!'));
        }

        Session::forget('book_date');

        $data = array();
        $data['number_of_rooms'] = $request->number_of_rooms;
        $data['available_room'] = $request->available_room;
        $data['persion'] = $request->persion;
        $data['check_in'] = date('Y-m-d',strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d',strtotime($request->check_out));
        $data['room_id'] = $request->room_id;

        Session::put('book_date',$data);

        return redirect()->route('checkout');

    }


    
    public function CheckOut()
    {
        if ( Session::has('book_date') ){
            $book_data = Session::get('book_date');
            $room = Room::find( $book_data['room_id'] );

            $toDate = Carbon::parse($book_data['check_in']);
            $fromDate = Carbon::parse($book_data['check_out']);
            $nights = $toDate->diffInDays($fromDate);

            return view('frontend.checkout.checkout' , [
                'room'      => $room ,
                'book_data' => $book_data ,
                'nights'    => $nights
            ]);
        }else{
            return redirect('/')->with($this->alert('error' , 'Something want to wrong!'));
        }
    }


    public function CheckOutStore( Request $request )
    {
        $this->validate($request , [
            'name'              => 'required',
            'email'             => 'required',
            'country'           => 'required',
            'phone'             => 'required',
            'address'           => 'required',
            'state'             => 'required',
            'zip_code'          => 'required',
            'payment_method'    => 'required', 
        ]);

        $book_data = Session::get('book_date'); 
        $toDate = Carbon::parse($book_data['check_in']);
        $fromDate = Carbon::parse($book_data['check_out']);
        $total_nights = $toDate->diffInDays($fromDate);

        $room           = Room::find( $book_data['room_id'] );
        $subtotal       = $room->price * $total_nights * $book_data['number_of_rooms'] ;
        $discount       = ($room->discount / 100) * $subtotal ;
        $total_price    = $subtotal - $discount;
        $code           = rand(000000000,999999999);

        // Stripe Payment
        if ( $request->payment_method == 'Stripe' ){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $s_pay = Stripe\Charge::create([
                "amount"        => $total_price * 100,
                "currency"      => "usd",
                "source"        => $request->stripeToken,
                "description"   => "Payment For Booking. Booking No ".$code,
            ]);

            // Check If Payment Ok ????
            if ($s_pay['status'] == 'succeeded') {
                $payment_status = 1;
                $transation_id = $s_pay->id;
            }else{
                return redirect()->back()->with($this->alert('error' , 'Sorry Payment Field'));
            }

        }else{
            $payment_status = 0 ;
            $transation_id  = '';
        }
        

        $data = new Booking();
        $data->room_id         = $room->id;
        $data->user_id          = Auth::user()->id;

        $data->check_in         = date('Y-m-d',strtotime($book_data['check_in']));
        $data->check_out        = date('Y-m-d',strtotime($book_data['check_out']));
        $data->persion          = $book_data['persion'];
        $data->number_of_rooms  = $book_data['number_of_rooms'];
        $data->total_night      = $total_nights ;

        $data->actual_price     = $room->price;
        $data->subtotal         = $subtotal;
        $data->discount         = $discount;
        $data->total_price      = $total_price;

        $data->payment_method   = $request->payment_method;
        $data->transation_id    = '';
        $data->payment_status   = 0;

        $data->name             = $request->name;
        $data->email            = $request->email;
        $data->phone            = $request->phone;
        $data->country          = $request->country;
        $data->state            = $request->state;
        $data->zip_code         = $request->zip_code;
        $data->address          = $request->address;

        $data->code = $code;
        $data->status = 0;
        $data->save();

        $sdate                  = date('Y-m-d',strtotime($book_data['check_in']));
        $edate                  = date('Y-m-d',strtotime($book_data['check_out']));
        $eldate                 = Carbon::create($edate)->subDay();
        $d_period               = CarbonPeriod::create($sdate,$eldate);
        foreach( $d_period as $period ){
            RoomBookedDate::create([
                'booking_id'    => $data->id ,
                'room_id'       => $room->id ,
                'book_date'     => date('Y-m-d', strtotime($period))
            ]);
        }

        Session::forget('book_data');
        
        Notification::send( User::RoleEqualAdmin() , new BookingComplete( $request->name ) );

        return redirect('/')->with($this->alert('success' , 'Booking Added Successfully'));

    }   
   
    


}
