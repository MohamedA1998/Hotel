@extends('frontend.layout.app')
@section('content')
    {{-- {{ dd($blogpost) }} --}}
    <!-- Inner Banner -->
    {{-- <x-inner-banner home="Home" title="Blog Details" bg="inner-bg3" /> --}}
    <div class="inner-banner inner-bg4">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>Blog Details</li>
                </ul>
                <h3>{{ $blogpost->PostTitile }}</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Blog Details Area -->
    <div class="blog-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-article">
                        <div class="blog-article-img">
                            <img src="{{ $blogpost->images->url() }}" alt="Images" width="1000px" height="600px">
                        </div>

                        <div class="blog-article-title">
                            <h2>{{ $blogpost->PostTitile }}</h2>
                            <ul>
                                
                                <li>
                                    <i class='bx bx-user'></i>
                                    {{ $blogpost->user->name }}
                                </li>

                                <li>
                                    <i class='bx bx-calendar'></i>
                                    {{ $blogpost->created_at->format('M d Y') }}
                                </li>
                            </ul>
                        </div>
                        
                        <div class="article-content">
                            <p>
                                {!! $blogpost->LongDesc !!}
                            </p>
                        </div>

                        <div class="comments-wrap">
                            <h3 class="title">Comments</h3>
                            <ul>
                                @foreach ($comments as $comment)
                                    <li>
                                        <img src="{{ $comment->user->images ? $comment->user->images->url() : asset('no_image.jpg') }}" alt="Image" width="50px" height="50px">
                                        <h3>{{ $comment->user->name }}</h3>
                                        <span>{{ $comment->created_at->format('M d Y h:m') }}</span>
                                        <p>
                                            {{ $comment->message }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="comments-form">
                            <div class="contact-form">
                                <h2>Leave A Comment</h2>
                                @auth
                                    <form method="POST" action="{{ route('comment.store') }}">
                                        @csrf

                                        <div class="row">
                                            
                                            <input type="hidden" name="post_id" value="{{ $blogpost->id }}" />
                                            
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-12 col-md-12">
                                                <button type="submit" class="default-btn btn-bg-three">
                                                    Post A Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <p>Plz <a href="{{ route('login') }}">Login</a> First For Add Comment</p>
                                @endauth
                            </div>
                        </div>
                    </div>
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
                                        <a href="{{ route('blogpost.details.slug' , ['slug' => $Post->PostSlug ]) }}" class="thumb">
                                            <img src="{{ $Post->images->url() }}" alt="Images" width="80px" height="80px">
                                        </a>
                                        <div class="info">
                                            <h4 class="title-text">
                                                <a href="{{ route('blogpost.details.slug' , ['slug' => $Post->PostSlug ]) }}">
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
    <!-- Blog Details Area End -->
    
@endsection