<div class="book-area-two pt-100 pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="book-content-two">
                    <div class="section-title">
                        <span class="sp-color">{{ $bookarea->ShortTitle }}</span>
                        <h2>{{ $bookarea->MainTitle }}</h2>
                        <p>
                            {{ $bookarea->ShortDesc }}
                            Atoli is one of the best resorts in the global market and that's why you will get a luxury life period on the global market. We always
                            provide you a special support for all of our guests and that's will  be the main reason to be the most popular.
                        </p>
                    </div>
                    <a href="{{ $bookarea->LinkUrl }}" class="default-btn btn-bg-three">Quick Booking</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="book-img-2">
                    <img src="{{ $bookarea->images->url() }}" alt="Images">
                </div>
            </div>
        </div>
    </div>
</div>