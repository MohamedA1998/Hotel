@extends('frontend.layout.app')
@section('content')

    <!-- Inner Banner -->
    <x-inner-banner home="Home" title="Service Details" bg="inner-bg6" />
    <!-- Inner Banner End -->

    <!-- Service Details Area -->
    <div class="service-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="service-article">
                        <div class="service-article-img">
                            <img src="assets/img/service-details-img.jpg" alt="Images">
                        </div>

                        <div class="service-article-title">
                            <h2>Hotel Room Reservation into the Desire Places</h2>
                        </div>

                        <div class="service-article-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore 
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore 
                            </p>
                            <p>
                                Ecespiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, 
                                eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim 
                                ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui
                                ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quci velit modi tempora incidunt
                                ut labore et dolore magnam aliquam quaerat .
                            </p>

                            <blockquote class="blockquote"> 
                                <p>
                                    Awesome dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    Ut enim ad minim veniam, quis nostrud exercitationaco laboris nisi ut aliquip commodo consequat. 
                                </p>
                            </blockquote>
                        </div>

                        <div class="service-facility-content">
                            <h2>Our Facilities</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore 
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore 
                            </p>
                            <ul>
                                <li><i class='bx bxs-check-circle'></i>Wifi Coverage</li>
                                <li><i class='bx bxs-check-circle'></i>Pool & Spa</li>
                                <li><i class='bx bxs-check-circle'></i>Luxury Bars</li>
                                <li><i class='bx bxs-check-circle'></i>Cleaning Everyday</li>
                                <li><i class='bx bxs-check-circle'></i>Sea View Balcony</li>
                            </ul>
                        </div>

                        <div class="more-services">
                            <h2>Our Related Services</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="services-item">
                                        <i class="flaticon-resort"></i>
                                        <h3><a href="service-details.html">Resort Reservation Into a Suitable Place</a></h3>
                                        <p>One can easily reserve a resort room in a suitable place as you want. This will be able to make good feelings.</p>
                                        <a href="service-details.html" class="get-btn">Get Service</a>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="services-item">
                                        <i class="flaticon-calendar"></i>
                                        <h3><a href="service-details.html">Book Now to Secure Availability Time Now</a></h3>
                                        <p>You can easily reserve a hotel room in a suitable place as you want. This will be able to make good feelings.</p>
                                        <a href="service-details.html" class="get-btn">Get Service</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="service-side-bar">
                        <div class="search-widget">
                            <form class="search-form">
                                <input type="search" class="form-control" placeholder="Search...">
                                <button type="submit">
                                    <i class="bx bx-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="services-bar-widget">
                            <h3 class="title">Others Services</h3>
                            <div class="side-bar-categories">
                                <ul>
                                    <li>
                                        <a href="#">Conference Rooms Related</a>
                                    </li>
                                    <li>
                                        <a href="#">Hotel Rooms Related</a>
                                    </li>
                                    <li>
                                        <a href="#">Resort Reservation Related</a>
                                    </li>
                                    <li>
                                        <a href="#">Weeding Hall Related</a>
                                    </li>
                                    <li>
                                        <a href="#">Community Centre Related</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="services-bar-widget">
                            <h3 class="title">Download Brochures</h3>
                            <div class="side-bar-list">
                                <ul>
                                    <li>
                                        <a href="#">Pdf File (1) <i class='bx bxs-cloud-download'></i></a>
                                    </li>
                                    <li>
                                        <a href="#">Pdf File (2) <i class='bx bxs-cloud-download'></i></a>
                                    </li>
                                    <li>
                                        <a href="#">Pdf File (3) <i class='bx bxs-cloud-download'></i></a>
                                    </li>
                                    <li>
                                        <a href="#">Pdf File (4) <i class='bx bxs-cloud-download'></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Details Area End -->

@endsection