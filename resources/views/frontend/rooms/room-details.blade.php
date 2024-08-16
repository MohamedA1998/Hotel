@extends('frontend.layout.app')
@section('content')
<!-- Inner Banner -->
<x-inner-banner home="Home" :title="$room->roomType->name" bg="inner-bg10" />
<!-- Inner Banner End -->

<!-- Room Details Area End -->
<div class="room-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Booking Sheet </h3>

                        <form>
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check in</label>
                                        <div class="input-group">
                                            <input type="text" name="check_in" class="form-control dt_picker" value="{{ old('check_in') ? date('Y-m-d' , strtotime(old('check_in'))) : "yyy-mm-dd" }}" autocomplete="off" required>
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check Out</label>
                                        <div class="input-group">
                                            <input type="text" name="check_out" class="form-control dt_picker" value="{{ old('check_out') ? date('Y-m-d' , strtotime(old('check_out'))) : "yyy-mm-dd" }}" autocomplete="off" required>
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                {{-- <h1>{{ Request::get('persion') }}</h1> --}}

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Persons</label>
                                        <select class="form-control">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Rooms</label>
                                        <select class="form-control">
                                           <option value="">1</option>
                                           <option value="">2</option>
                                           <option value="">3</option>
                                           <option value="">4</option>
                                           <option value="">5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="room-details-article">
                    <div class="room-details-slider owl-carousel owl-theme">
                        @foreach (\App\Facades\ImageFacade::image($room->image) as $image)
                            <div class="room-details-item">
                                <img src="{{ $image }}" alt="Images" width="100%" height="650px">
                            </div>
                        @endforeach
                    </div>

                    <div class="room-details-title">
                        <h2>{{ $room->roomType->name }}</h2>
                        <ul>

                            <li>
                                <b> Basic : ${{ $room->price }}/Night/Room</b>
                            </li>

                        </ul>
                    </div>

                    <div class="room-details-content">
                        <p>
                            {!! $room->description !!}
                        </p>


                    <div class="side-bar-plan">
                        <h3>Basic Plan Facilities</h3>
                        <ul>
                            @foreach ($room->facility as $item)
                                <li><a href="#">{{ $item->facility_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>







            <div class="row">
                <div class="col-lg-6">
                    <div class="services-bar-widget">
                        <h3 class="title">Room Details</h3>
                        <div class="side-bar-list">
                            <ul>
                                <li>
                                    <a href="#"> <b>Capacity : </b> {{ $room->room_capacity }} Person <i class='bx bxs-cloud-download'></i></a>
                                </li>
                                <li>
                                    <a href="#"> <b>Size : </b> {{ $room->size }} / 276ft2 <i class='bx bxs-cloud-download'></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="services-bar-widget">
                        <h3 class="title">Room Details</h3>
                        <div class="side-bar-list">
                            <ul>
                                <li>
                                    <a href="#"> <b>View : </b> {{ $room->view }} <i class='bx bxs-cloud-download'></i></a>
                                </li>
                                <li>
                                    <a href="#"> <b>Bad Style : </b> {{ $room->bed_style }} <i class='bx bxs-cloud-download'></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



                    </div>

                    <div class="room-details-review">
                        <h2>Clients Review and Retting's</h2>
                        <div class="review-ratting">
                            <h3>Your retting: </h3>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <form >
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control"  cols="30" rows="8" required data-error="Write your message" placeholder="Write your review here.... "></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three">
                                        Submit Review
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Room Details Area End -->

<!-- Room Details Other -->
<div class="room-details-other pb-70">
    <div class="container">
        <div class="room-details-text">
            <h2>Our Related Offer</h2>
        </div>

        <div class="row">
            @foreach ($otherroom as $otherroom)
                <div class="col-lg-6">
                    <div class="room-card-two">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-4 p-0">
                                <div class="room-card-img">
                                    <a href="{{ route('frontroom.roomdetails' , ['room' => $otherroom->id]) }}">
                                        <img src="{{ \App\Facades\ImageFacade::first($room->image) }}" alt="Images" width="100%" height="335px">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-8 p-0">
                                <div class="room-card-content">
                                    <h3>
                                        <a href="{{ route('frontroom.roomdetails' , ['room' => $otherroom->id]) }}">
                                            {{ $otherroom->roomType->name }}
                                        </a>
                                    </h3>
                                    <span>{{ $otherroom->price }} / Per Night </span>
                                    <div class="rating">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                    </div>
                                    <p>{{ $otherroom->short_desc }}</p>
                                    <ul>
                                        <li><i class='bx bx-user'></i> {{ $otherroom->room_capacity }} Person</li>
                                        <li><i class='bx bx-expand'></i> {{ $otherroom->size }} / 376ft2</li>
                                    </ul>

                                    <ul>
                                        <li><i class='bx bx-show-alt'></i>{{ $otherroom->view }}</li>
                                        <li><i class='bx bxs-hotel'></i>{{ $otherroom->bed_style }}</li>
                                    </ul>

                                    <a href="{{ route('frontroom.roomdetails' , ['room' => $otherroom->id]) }}" class="book-more-btn">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Room Details Other End -->

@endsection
