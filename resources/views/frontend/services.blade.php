@extends('frontend.layout.app')
@section('content')

    <!-- Inner Banner -->
    <x-inner-banner home="Home" title="Services Style One" bg="inner-bg7" />
    <!-- Inner Banner End -->

    <!-- Services Area Two -->
    <div class="services-area-two pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color">SERVICES</span>
                <h2>Our Resort Services and All Other Details</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-4 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-wifi-signal-1 text-color"></i>
                        <h3><a href="service-details.html">Wifi Coverage</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt ante tellus, sit amet rhoncus massa .</p>
                        <a href="service-details.html" class="get-btn">Get Service </a>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-sauna text-color"></i>
                        <h3><a href="service-details.html">Pool & Spa</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt ante tellus, sit amet rhoncus massa .</p>
                        <a href="service-details.html" class="get-btn">Get Service </a>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-tea-cup-with-muffin-and-cookies text-color"></i>
                        <h3><a href="service-details.html">Buffet Breakfast</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt ante tellus, sit amet rhoncus massa .</p>
                        <a href="service-details.html" class="get-btn">Get Service </a>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-champagne-glass text-color"></i>
                        <h3><a href="service-details.html">Luxury Bars</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt ante tellus, sit amet rhoncus massa .</p>
                        <a href="service-details.html" class="get-btn">Get Service </a>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-vacuum text-color"></i>
                        <h3><a href="service-details.html">Cleaning Everyday</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt ante tellus, sit amet rhoncus massa .</p>
                        <a href="service-details.html" class="get-btn">Get Service </a>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="services-card">
                        <i class="flaticon-beach-vacation text-color"></i>
                        <h3><a href="service-details.html">Sea View Balcony</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt ante tellus, sit amet rhoncus massa .</p>
                        <a href="service-details.html" class="get-btn">Get Service </a>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="pagination-area">
                        <a href="#" class="prev page-numbers">
                            <i class='bx bx-chevrons-left'></i>
                        </a>

                        <span class="page-numbers current" aria-current="page">1</span>
                        <a href="#" class="page-numbers">2</a>
                        <a href="#" class="page-numbers">3</a>
                        
                        <a href="#" class="next page-numbers">
                            <i class='bx bx-chevrons-right'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services Area Two End -->
    
@endsection