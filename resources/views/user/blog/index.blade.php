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
                        <h2 class="text-white">{{ $menus->where('id',7)->first()->navbar }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $menus->where('id',7)->first()->navbar }}</li>
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
            @if ($blogs->count() != 0)
            <!-- GALLERY CONTENT START -->
            <div class="news-grid clearfix row">
                @php
                    $colorId=1;
                @endphp
                @foreach ($blogs as $index => $blog)
                <!-- COLUMNS 1 -->
                <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                    <div class="blog-post blog-grid-1 overlay-wraper post-overlay  large-date bg-cover bg-no-repeat bg-top-center" style="background-image:url({{ url($blog->thumbnail_image) }})">
                        <div class="overlay-main overlay-gradient"></div>
                                @php

                                    if($index %4 ==0){
                                        $colorId=1;
                                    }
                                    $color="";
                                    if($colorId==1){
                                        $color="clr-blue";
                                    }else if($colorId==2){
                                        $color="clr-voilet";
                                    }else if($colorId==3){
                                        $color="clr-red";
                                    }else if($colorId==4){
                                        $color="clr-cyan";
                                    }
                                @endphp
                            <div class="blog-category"><a href="{{ route('blog.category',$blog->category->slug) }}"><span class="{{ $color }}">{{ $blog->category->name }}</span></a></div>
                            <div class="wt-post-info text-white">
                                <div class="post-overlay-position">
                                    <div class="post-content-outer p-a30">

                                        <div class="wt-post-title ">
                                            <h4 class="post-title"><a href="{{ route('blog.details',$blog->slug) }}" class="text-white text-capitalize">{{ $blog->title }}</a></h4>
                                        </div>
                                        <div class="wt-post-meta ">
                                            <ul>
                                                <li class="post-date  site-text-secondry">{{ $blog->created_at->format('M d Y') }}</li>

                                                @if ($setting->text_direction=='RTL')
                                                    <li class="post-author"> {{ $blog->admin->name }} {{ $websiteLang->where('id',22)->first()->custom_text }}</li>
                                                    @else
                                                    <li class="post-author"> {{ $websiteLang->where('id',22)->first()->custom_text }} {{ $blog->admin->name }} </li>

                                                    @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                @php
                    $colorId++;
                @endphp
                @endforeach
            </div>
            <!-- GALLERY CONTENT END -->
            <div class="blog-pag-box ml-3">
                {{ $blogs->links() }}
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
