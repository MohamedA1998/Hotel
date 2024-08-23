<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomBookedDate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class FrontRoomController extends Controller
{

    public function GetAllRoomData( Request $request )
    {
        return view('frontend.rooms.index' , [
            'rooms' => Room::latest()->get(),
        ]);
    }


    public function SingleRoomDetails(Room $room)
    {
        return view('frontend.rooms.room-details' , [
            'room'          => $room->load('roomType' , 'facility'),
            'otherroom'     => Room::with('roomType')->where('id' , '!=' , $room->id)->orderBy('id' , 'DESC')->limit(2)->get(),
        ]);
    }



    public function SearchFromBooking( Request $request )
    {
        $request->flash();

        if ( $request->check_in >= $request->check_out ){
            return redirect()->back()->with($this->alert('error' , 'Something Want To Working'));
        }

        $sdate          = date( 'Y-m-d' , strtotime($request->check_in ) );
        $edate          = date( 'Y-m-d' , strtotime($request->check_out) );
        $alldate        = Carbon::create( $edate )->subDay();
        $d_period       = CarbonPeriod::create( $sdate , $alldate );

        $dt_array = [];
        foreach ($d_period as $period) {
           array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $rooms = Room::withCount('roomnumber')->where('status',1)->get();

        return view('frontend.rooms.search_room',compact('rooms','check_date_booking_ids'));
    }



    public function SearchRoomDetails( Request $request , Room $room ){
        $request->flash();

//        $room->roomnumber

        return view('frontend.rooms.search_room_details' , [
            'room'          => $room->load('facility'),
            'otherroom'     => Room::where('id' , '!=' , $room->id)->orderBy('id' , 'DESC')->limit(2)->get(),
        ]);
    }// End Method




    public function CheckRoomAvailability(Request $request){

        $sdate = date('Y-m-d',strtotime($request->check_in));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
           array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $room = Room::withCount('roomnumber')->find($request->room_id);

        $bookings = Booking::withCount('assign_rooms')->whereIn('id',$check_date_booking_ids)->where('room_id',$room->id)->get()->toArray();

        $total_book_room = array_sum(array_column($bookings,'assign_rooms_count'));

        $av_room = @$room->roomnumber_count - $total_book_room;

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffInDays($fromDate);

        return response()->json(['available_room'=>$av_room, 'total_nights'=>$nights ]);
    }// End Method

}
