@extends('layouts.user.layout')
@section('title')
    <title>{{ $menus->where('id',16)->first()->navbar }}</title>
@endsection
@section('user-content')
     <!-- CONTENT START -->
     <div class="page-content">

        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
            <div class="overlay-main bg-black opacity-05"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="text-white">{{ $menus->where('id',16)->first()->navbar }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $menus->where('id',16)->first()->navbar }}</li>
                        </ul>
                    </div>

                    <!-- BREADCRUMB ROW END -->
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->

        <div class="container">
            <!-- TOP ACTIVITIES SECTION START -->
        <div class="section-full mobile-map-animation-padding p-t80 p-b80 bg-orange-light dot-left-top-img dot-right-bottom-img">


            <div class="section-content container-fluid">
                <div class="row">
                    <div class="col">
                        @if ($privacy)
                              {!! clean($privacy->privacy_policy) !!}
                        @endif
                    </div>
                </div>
            </div>


        </div>
        <!-- TOP ACTIVITIES SECTION START -->

        </div>






    </div>
    <!-- CONTENT END -->
@endsection
