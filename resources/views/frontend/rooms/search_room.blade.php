@extends('frontend.layout.app')
@section('content')

<!-- Inner Banner -->
<x-inner-banner home="Home" title="Rooms" bg="inner-bg9" />
<!-- Inner Banner End -->

<!-- Room Area -->
<div class="room-area pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">ROOMS</span>
            <h2>Our Rooms & Rates</h2>
        </div>
        <div class="row pt-45">
            <?php $empty_array = []; ?>

            @foreach ($rooms as $item)

                @php
                    $bookings = App\Models\Booking::withCount('assign_rooms')->whereIn('id',$check_date_booking_ids)->where('room_id',$item->id)->get()->toArray();
                    $total_book_room = array_sum(array_column($bookings,'assign_rooms_count'));
                    $av_room = @$item->roomnumber_count-$total_book_room;
                @endphp

                @if ( $av_room > 0 && old('persion') <= $item->total_adult)
                    <div class="col-lg-4 col-md-6">
                        <div class="room-card">
                            <a href="{{ route('search_room_details' , [
                                'room' => $item ,
                                'check_in' => old('check_in') ,
                                'check_out' => old('check_out') ,
                                'persion' => old('persion')
                                ]) }}">
                                <img src="{{ \App\Facades\ImageFacade::first($item->image) }}" alt="Images" height="350px" width="100%">
                            </a>
                            <div class="content">
                                <h3>
                                    <a href="{{ route('search_room_details' , [
                                        'room' => $item ,
                                        'check_in' => old('check_in') ,
                                        'check_out' => old('check_out') ,
                                        'persion' => old('persion')] )
                                    }}">
                                        {{ $item->roomType->name }}
                                    </a>
                                </h3>
                                <ul>
                                    <li class="text-color">{{ $item->price }}</li>
                                    <li class="text-color">Per Night</li>
                                </ul>
                                <div class="rating text-color">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star-half'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <?php array_push($empty_array, $item->id) ?>

                @endif
            @endforeach

            @if (count($rooms) == count($empty_array))
                <p class="text-center text-danger">Sorry No Data Found</p>
            @endif

        </div>
    </div>
</div>
<!-- Room Area End -->

@endsection
