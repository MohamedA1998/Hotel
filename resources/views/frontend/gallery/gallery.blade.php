@extends('frontend.layout.app')
@section('content')

<!-- Inner Banner -->
<x-inner-banner home="Home" title="Gallery" bg="inner-bg3" />
<!-- Inner Banner End -->

<!-- Gallery Area -->
<div class="gallery-area pt-100 pb-70">
    <div class="container">
        <div class="tab gallery-tab">

            <div class="tab_content current active pt-45">
                <div class="tabs_item current">
                    <div class="gallery-tab-item">
                        <div class="gallery-view">
                            <div class="row">

                                @foreach ($gallery as $item)
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="single-gallery">
                                            <img src="{{ $item->images->url() }}" alt="Images" width="100%" height="300px">
                                            <a href="{{ $item->images->url() }}" class="gallery-icon">
                                                <i class='bx bx-plus'></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>
<!-- Gallery Area End -->
    
@endsection