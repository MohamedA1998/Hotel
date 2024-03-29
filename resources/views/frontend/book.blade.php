@extends('frontend.layout.app')
@section('content')

    <!-- Inner Banner -->
    <x-inner-banner home="Home" title="Booking" bg="inner-bg5" />
    <!-- Inner Banner End -->

        <!-- Book Area -->
        <div class="book-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="book-img">
                        <img src="assets/img/book-img.jpg" alt="Images">
                        <div class="book-shape">
                            <img src="assets/img/shape/shape1.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="booking-form">
                        <h3>Booking Sheet </h3>
                        <form>
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input type="text" name="name"  class="form-control" required data-error="Please enter your name" placeholder="Your Name">
                                        <i class='bx bx-user'></i>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Your Email</label>
                                        <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Your Email">
                                        <i class='bx bx-mail-send'></i>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Check in</label>
                                        <div class="input-group date">
                                            <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Check Out</label>
                                        <div class="input-group">
                                            <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Numbers of Persons</label>
                                        <select class="form-control">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                        </select>	
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Numbers of Rooms</label>
                                        <select class="form-control">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                        </select>	
                                    </div>
                                </div>
    
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-two border-radius-5">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Book Area End -->

@endsection