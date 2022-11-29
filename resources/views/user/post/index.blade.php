@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')
 <!-- CONTENT START -->
 <div class="page-content">
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center"  style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="overlay-main bg-black opacity-05"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="text-white">{{ __('Post') }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ __('Post') }}</li>
                        </ul>
                    </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- SECTION CONTENT START -->
    <div class="section-full small-device p-tb80 bg-white">
        <div class="container">
            @if ($posts->count() != 0)

            <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12">
                    <div class="shadow p-a30 side-bar-opposite">

                    <div class="wt-listing-container" id="showSearchResult">

                    
                    @foreach ($posts as $index => $post)
                    <div class="col-lg-6 col-md-6">
                        <div class="listing-cat-box m-b30">
                        </div>
                    </div>
                     <div class="wt-listing-container dashboard-my-listing">
                    <div class="list-item-container posts-list m-b30 clearfix">
                        <h4 class="listing-place-name"><a href="{{ route('listing.show',$post->slug) }}">{{ $post->title }} </a></h4>
                        <div class="post-user">
                        <img class="post-user-img" src="http://127.0.0.1:8000/uploads/custom-images/user-2021-09-08-03-05-05-9773.jpg" alt="" height="30px" width="30px"> <p style="
    padding-top: 5px; ">Title description, Dec 7, 2017</p>
                        </div>    
                            @if(isset($post->thumbnail_image) && !empty($post->thumbnail_image))
                       
                        <div class="listing-cat-media"><img src="{{ asset($post->thumbnail_image) }}" alt=""></div>

                        @endif
                        <p class="post-text">{{ substr($post->body, 0, 100) }}...</p> 
                        <br>
                        <br>
                        <a href="{{route('user.post.details',$post->slug)}}">Read more..</a>

                        <div class="list-category-content">
                            <div class="listing-logo-outer">
                            </div>
                        </div>
                    </div>
                </div>
                                        
                <!-- COLUMNS 1 -->
               
                @endforeach


                    </div>
                </div>



            <!-- GALLERY CONTENT END -->
            <div class="blog-pag-box ml-3">
                {{ $posts->links() }}
            </div>
            @else
            <h2 class="text-danger text-center">{{ $websiteLang->where('id',395)->first()->custom_text }}</h2>
            @endif
        </div>
    </div>
    <!-- SECTION CONTENT END  -->

</div>
<!-- CONTENT END -->
@endsection
