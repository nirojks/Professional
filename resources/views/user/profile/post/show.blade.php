@extends('layouts.user.layout')
@section('title')
    <title>{{ $post->title }}</title>
@endsection
@section('meta')
@endsection

@section('user-content')
<!-- CONTENT START -->
<div class="page-content ">
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center"  style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="overlay-main bg-black opacity-05"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="text-white">{{ $post->title }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li><a href="{{ route('listings') }}">{{ $menus->where('id',7)->first()->navbar }}</a></li>
                            <li>{{ $post->title }}</li>
                        </ul>
                    </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- SECTION CONTENT START -->
    <div class="section-full small-device  p-tb80 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                   <!-- BLOG START -->
                     <div class="blog-post blog-md date-style-1 blog-list-1 clearfix  m-b60 bg-white" >
                        <div class="post-user">
                            @if($post->listing_id == 0 && isset($post->user) && !empty($post->user))
                                @if(empty($post->user->image))
                                <img class="post-user-img" src="http://127.0.0.1:8000/uploads/custom-images/user-2021-09-08-03-05-05-9773.jpg" alt="" height="30px" width="30px"> <p style="padding-top: 5px; ">By {{ $post->user->name }}</p>
                                @else
                                <img class="post-user-img" src="{{ asset($post->user->image) }}" alt="" height="30px" width="30px"> <p style="padding-top: 5px; ">By {{ $post->user->name }}</p>
                                @endif
                            @elseif($post->listing_id != 0)
                            <span class="listing-cat-address"><a href="{{ route('listing.show',$post->listing->slug) }}"><i class="sl-icon-layers" style="float:left; margin-right:5px; padding-top:3px;"></i><p>{{ $post->listing->title }}</p></a></span>
                            @endif  
                            
                        </div>
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="javascript:;"><img src="{{ asset($post->image) }}" alt="" height="400px"></a>
                        </div>
                        <div class="wt-post-info  bg-white p-t30">
                            <div class="wt-post-meta ">
                                <ul>
                                    <li class="post-date"><i class="fa fa-calendar-o site-text-secondry"></i><span>{{ $post->created_at->format('M d Y') }}</span></li>
                                    @if($post->listing_id !=0)
                                    <li class="post-catagory"><i class="fa fa-tags site-text-secondry"></i><a href="{{ route('listing.show',$post->listing->slug) }}">{{ $post->listing->title }} </a> </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="wt-post-title ">
                                <h3 class="post-title">{{ $post->title }}</h3>
                            </div>

                            <div class="wt-post-text">
                            {!! clean($post->body) !!}
                            </div>
                        </div>

                    </div>

                    <!-- BLOG END -->

                </div>
                <!-- SIDE BAR START -->
             
                <!-- SIDE BAR END -->
            </div>



        </div>
    </div>
    <!-- SECTION CONTENT END -->

</div>
<!-- CONTENT END -->

<div id="fb-root"></div>

@endsection
