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
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
            <div class="overlay-main bg-black opacity-05"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="text-white">{{ $menus->where('id',4)->first()->navbar }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $menus->where('id',4)->first()->navbar }}</li>
                        </ul>
                    </div>

                    <!-- BREADCRUMB ROW END -->
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->

        @php
            $about_section=$section->where('id',1)->first();
        @endphp
        @if ($about_section->show_homepage==1)
        <!-- ABOUT SECTION START -->
        <div class="section-full p-t80 p-b50 bg-orange-light">
            <div class="container">
                <div class="section-content">
                    <!-- TITLE START-->
                    <div class="section-head text-center">
                        <span class="wt-separator-icon"><i class="{{ $about_section->icon }}"></i></span>
                        <h2>{{ $about_section->header }}</h2>
                        <div class="wt-separator sep-gradient-light"></div>
                        <p>{{ $about_section->description }}</p>
                    </div>
                    <!-- TITLE END-->

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="how-it-right">
                                {!! clean($about->description) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="how-it-work">
                                <div class="video-section-dark">
                                    <img src="{{ $about->background_image ? $about->background_image : '' }}" alt="">
                                    <div class="video-btn-position">
                                        <a href="{{ $about->video_link }}" class="mfp-video play-now">
                                            <i class="icon fa fa-play"></i>
                                            <span class="ripple"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ABOUT  SECTION END -->
        @endif

        @php
            $feature_section=$section->where('id',2)->first();
            $features=$features->take($feature_section->content_quantity);
        @endphp
        @if ($feature_section->show_homepage==1)
        <!-- WELCOME SECTION START -->
        <div class="section-full home-feature-bg p-t80 p-b50 bg-no-repeat bg-center">
            <div class="container">
                <div class="section-content">
                    <!-- TITLE START-->
                    <div class="section-head text-center">
                        <span class="wt-separator-icon"><i class="{{ $feature_section->icon }}"></i></span>
                        <h2>{{ $feature_section->header }}</h2>
                        <div class="wt-separator sep-gradient-light"></div>
                        <p>{{ $feature_section->description }}</p>
                    </div>
                    <!-- TITLE END-->

                    <div class="row d-flex justify-content-center">
                        @foreach ($features as $index => $feature)
                        <div class="col-lg-4 col-md-6 col-sm-12 ">
                            <div class="icon-circle-box {{ ++$index%2==0 ? 'active' : '' }} bg-orange-light v-icon-effect">
                                <div class="wt-icon-box-wraper center p-b50  m-b30 bdr-1 bdr-gray bdr-solid corner-radius">
                                    <div class="icon-md m-b20 icon-circle">
                                        <span class="icon-cell">
                                            <i class="{{ $feature->icon }} "></i>
                                        </span>
                                    </div>
                                    <div class="icon-content relative">
                                        <h4 class="wt-tilte">{{ $feature->title }}</h4>
                                        <span class="icon-count-number">{{ +$index }}</span>
                                        <p>{{ $feature->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- WELCOME  SECTION END -->
        @endif


        @php
            $partner_section=$section->where('id',4)->first();
            $partners=$partners->take($partner_section->content_quantity);
        @endphp
        @if ($partner_section->show_homepage==1)
        <!-- CLIENT LOGO SECTION START -->
        <div class="section-full bg-orange-light">
            <div class="container">
                <div class="section-content">

                    <!-- TESTIMONIAL 4 START ON BACKGROUND -->
                    <div class="section-content">
                        <div class="section-content p-tb10 owl-btn-vertical-center">
                            <div class="owl-carousel home-client-carousel-2 ">
                                @foreach ($partners as $partner)

                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                            <a href="{{ $partner->link ? $partner->link : '' }}"><img src="{{ asset($partner->image) }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CLIENT LOGO  SECTION End -->
        @endif


        @php
        $overview_section=$section->where('id',3)->first();
        @endphp
        @if ($overview_section->show_homepage==1)
       <!-- MOBILE ANIMATION SECTION START -->
       <div class="section-full  p-t80 p-b140  map-animation-section overlay-wraper bg-cover bg-no-repeat" style="background-image:url({{ $overview_bg_image->image ? asset($overview_bg_image->image) : '' }});">
        <div class="overlay-main site-bg-primary opacity-08"></div>
        <div class="container">


            <div class="section-content overview-bottom">

                <div class="info-video-section text-white">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="info-video-title">
                                <h2 class="wt-tilte m-t0">{{ $overview_section->header }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="video-section">
                                <div class="video-icon-left">
                                    <span>
                                         <a href="{{ $overviewVideo }}" class="mfp-video play-now">
                                            <i class="fa fa-play site-text-secondry"></i>
                                            <span class="ripple"></span>
                                    </a>
                                    </span>
                                </div>
                                <div class="video-icon-title">
                                    <span>{{ $overview_section->description }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="counter-outer p-t50 p-b20">

                    <div class="row">
                        @foreach ($overviews as $overview)
                        <div class="col-md-3 col-sm-6">
                            <div class="m-b30  wt-icon-box-wraper left">
                                <h2 class="counter site-text-secondry">{{ $overview->qty }}</h2>
                                <h4 class="text-white">{{ $overview->name }}</h4>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- MOBILE ANIMATION SECTION END -->
        @endif
    </div>
    <!-- CONTENT END -->
@endsection
