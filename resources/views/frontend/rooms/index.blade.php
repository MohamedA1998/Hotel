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

                @foreach ($rooms as $room)
                    <div class="col-lg-4 col-md-6">
                        <div class="room-card">
                            <a href="{{ route('frontroom.roomdetails' , ['room' => $room]) }}">
                                <img src="{{ \App\Facades\ImageFacade::first($room->image) }}" alt="Images" height="350px" width="100%">
                            </a>
                            <div class="content">
                                <h3>
                                    <a href="{{ route('frontroom.roomdetails' , ['room' => $room]) }}">
                                        {{ $room->roomType->name }}
                                    </a>
                                </h3>
                                <ul>
                                    <li class="text-color">{{ $room->price }}</li>
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
                @endforeach

            </div>
        </div>
    </div>
    <!-- Room Area End -->

@endsection
