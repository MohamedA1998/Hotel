@extends('frontend.layout.app')
@section('content')

<!-- Inner Banner -->
<x-inner-banner home="Home" title="Blog Posts" bg="inner-bg4" />
<!-- Inner Banner End -->

<!-- Blog Style Area -->
<div class="blog-style-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                
                @forelse ($blogpost as $post)
                    <div class="col-lg-12">
                        <div class="blog-card">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4 p-0">
                                    <div class="blog-img">
                                        <a href="{{ route('blogpost.details.slug' , ['slug' => $post->PostSlug ] ) }}">
                                            <img src="{{ $post->images->url() }}" alt="Images" height="250px" width="100%">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-md-8 p-0">
                                    <div class="blog-content">
                                        <span>{{ $post->created_at->format('M d Y') }}</span>
                                        <h3>
                                            <a href="{{ route('blogpost.details.slug' , ['slug' => $post->PostSlug]) }}">
                                                {{ $post->PostTitile }}
                                            </a>
                                        </h3>
                                        <p>{{ $post->ShortDesc }}</p>
                                        <a href="{{ route('blogpost.details.slug' , ['slug' => $post->PostSlug ] ) }}" class="read-btn">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <h2 class="text-center">No Blog Post Yet!!</h2>
                @endforelse

                                    
                @if(count($blogpost))
                    <div class="col-lg-12 col-md-12">
                        <div class="pagination-area">

                            {{ $blogpost->links('vendor.pagination.custem') }}

                        </div>
                    </div>
                @endif
            </div>


            <div class="col-lg-4">
                <div class="side-bar-wrap">
                    <div class="search-widget">
                        <form class="search-form">
                            <input type="search" class="form-control" placeholder="Search...">
                            <button type="submit">
                                <i class="bx bx-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="services-bar-widget">
                        <h3 class="title">Blog Category</h3>
                        <div class="side-bar-categories">
                            <ul>
                                @foreach ($BlogCategorie as $Category)
                                    <li>
                                        <a href="{{ route('blog.category.id' , ['id' => $Category->id]) }}">{{ $Category->CategoryName }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="side-bar-widget">
                        <h3 class="title">Recent Posts</h3>
                        <div class="widget-popular-post">
                            @foreach ($LimitPost as $Post)
                                <article class="item">
                                    <a href="{{ route('blogpost.details.slug' , ['slug' => $Post->PostSlug])  }}" class="thumb">
                                        <img src="{{ $Post->images->url() }}" alt="Images" width="80px" height="80px">
                                    </a>
                                    <div class="info">
                                        <h4 class="title-text">
                                            <a href="{{ route('blogpost.details.slug' , ['slug' => $Post->PostSlug])  }}">
                                                {{ $Post->PostTitile }}
                                            </a>
                                        </h4>
                                        <ul>
                                            <li>
                                                <i class='bx bx-user'></i>
                                                29K
                                            </li>
                                            <li>
                                                <i class='bx bx-message-square-detail'></i>
                                                15K
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Style Area End -->
    
@endsection