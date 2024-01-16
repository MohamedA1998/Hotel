@extends('frontend.layout.app')
@section('content')

    <!-- Inner Banner -->
    <x-inner-banner home="Home" title="404 Error page!" bg="inner-bg9" />
    <!-- Inner Banner End -->

    <!-- Start 404 Error -->
    <div class="error-area">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="error-content">
                    <h1>4 <span>0</span> 4</h1>
                    <h3>Oops! Page Not Found</h3>
                    <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
                    <a href="index.html" class="default-btn btn-bg-three">
                        Return To Home Page
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 Error -->
    
@endsection