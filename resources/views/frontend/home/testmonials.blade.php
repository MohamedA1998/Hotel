@php
    $testimonials = App\Models\Testimonial::latest()->get();
@endphp
<div class="testimonials-area-three pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">TESTIMONIAL</span>
            <h2>Our Latest Testimonials and What Our Client Says</h2>
        </div>
        <div class="row align-items-center pt-45">
            <div class="col-lg-6 col-md-6">
                <div class="testimonials-img-two">
                    <img src="{{ asset('frontend/assets/img/testimonials/testimonials-img5.jpg') }}" alt="Images">
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="testimonials-slider-area owl-carousel owl-theme">
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonials-slider-content">
                            <i class="flaticon-left-quote"></i>
                            <p>
                                {{ $testimonial->message }}
                            </p>
                            <ul>
                                <li>
                                    <img src="{{ $testimonial->images->url() }}" alt="Images">
                                    <h3>{{ $testimonial->name }}</h3>
                                    <span>{{ $testimonial->city }}</span>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
