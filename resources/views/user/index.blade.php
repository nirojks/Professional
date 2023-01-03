@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.15/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.15/dist/js/splide.min.js"></script>

    <style>
        .splide__slide img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        @media screen and (max-width: 600px) {
            .splide__slide img {
                height: 300px !important;
            }
        }
    </style>

    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection


@section('user-content')

    <!-- CONTENT START -->
    <div class="page-content">
        @php
            $banner_section = $section->where('id', 1)->first();
        @endphp
        @if ($banner_section->show_homepage == 1)
            <!-- Banner -->

            <!-- @if ($banner->status == 1) -->
                <!-- <div class="banner-image">
             
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($sliders as $index => $slider)
                                <div class="item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ $slider->image ? asset($slider->image) : '' }}" alt="Los Angeles"
                                        style="width:100%;">
                                    <div class="carousel-caption captionform">
                                        <form method="GET" action="{{ route('search-listing') }}">
                                            <div class="banner-textrow">
                                                <h1 style="color:white;">{{ $banner_section->header }}</h1>
                                                <span>{{ $banner_section->description }}</span>
                                            </div>

                                            <div class="search-bar-warp row">

                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group shadow-line">
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ $websiteLang->where('id', 1)->first()->custom_text }}"
                                                            name="search">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group shadow-line">
                                                        <select class="form-control select2" name="category_id">
                                                            <option value="">
                                                                {{ $websiteLang->where('id', 2)->first()->custom_text }}
                                                            </option>
                                                            @foreach ($listingCategories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach


                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-group shadow-line">
                                                        <select class="form-control select2" name="location">
                                                            <option value="">
                                                                {{ $websiteLang->where('id', 3)->first()->custom_text }}
                                                            </option>
                                                            @foreach ($locationsForSearch as $location)
                                                                <option value="{{ $location->id }}">
                                                                    {{ $location->location }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="page_type" value="list_view">

                                                <div class="text-center search-bar-btn col-lg-12">
                                                    <button
                                                        class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id', 4)->first()->custom_text }}</button>
                                                </div>

                                            </div>


                                        </form>
                                    </div>
                                </div>
                            @endforeach



                        </div>

                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div> -->
            <!-- @else -->
            <!-- @endif -->
                <div class="banner-wrap bg-cover"
                    style="background-image:url({{ $banner->image ? asset($banner->image) : '' }})">
                    <div class="banner-image">
                        <div class="banner-content-area">
                            <div class="container">
                                <form method="GET" action="{{ route('search-listing') }}">

                                    <div class="banner-textrow">
                                        <strong>{{ $banner_section->header }}</strong>
                                        <span>{{ $banner_section->description }}</span>
                                    </div>

                                    <div class="search-bar-warp row">

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group shadow-line">
                                                <input type="text" class="form-control"
                                                    placeholder="{{ $websiteLang->where('id', 1)->first()->custom_text }}"
                                                    name="search">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group shadow-line">
                                                <select class="form-control select2" name="category_id">
                                                    <option value="">
                                                        {{ $websiteLang->where('id', 2)->first()->custom_text }}</option>
                                                    @foreach ($listingCategories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="form-group shadow-line">
                                                <select class="form-control select2" name="location">
                                                    <option value="">
                                                        {{ $websiteLang->where('id', 3)->first()->custom_text }}</option>
                                                    @foreach ($locationsForSearch as $location)
                                                        <option value="{{ $location->id }}">{{ $location->location }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="page_type" value="list_view">

                                        <div class="text-center search-bar-btn col-lg-12">
                                            <button
                                                class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id', 4)->first()->custom_text }}</button>
                                        </div>

                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="banner-image-overlay"></div>
                </div>
            
        @endif
        <!-- Banner END -->

        @php
            $banner_category = $section->where('id', 11)->first();
        @endphp
        @if ($banner_category->show_homepage == 1)
            <div class="container main-categories-slider-outer">
                <div class="main-categories-slider">
                    <div class="owl-carousel banner-categories owl-btn-vertical-center">
                        @foreach ($listingCategories as $category)
                            <div class="item">
                                <a href="{{ route('listings', ['category_slug' => $category->slug, 'page_type' => 'list_view']) }}"
                                    class="main-categories-box-outer site-text-primary text-center v-icon-effect">
                                    <div class="main-categories-box">
                                        <div class="main-categories-icon">
                                            <img src="{{ asset($category->icon_image) }}" alt="" class="v-icon ">
                                        </div>
                                    </div>
                                    <span>{{ $category->name }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div>
            <div id="splide" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide"><img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=1200"></li>
                        <li class="splide__slide"><img src="https://images.pexels.com/photos/186077/pexels-photo-186077.jpeg?auto=compress&cs=tinysrgb&w=1200"></li>
                        <li class="splide__slide"><img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?auto=compress&cs=tinysrgb&w=1200"></li>
                        <li class="splide__slide"><img src="https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg?auto=compress&cs=tinysrgb&w=1200"></li>
                    </ul>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Splide('#splide', {
                    type: 'loop',
                    perPage: 1,
                    autoplay: true,
                    interval: 8000,
                    pagination: false,
                    gap: '20px',
                }).mount();
            });
        </script>

        @php
            $feature_section = $section->where('id', 2)->first();
            $features = $features->take($feature_section->content_quantity);
        @endphp
        @if ($feature_section->show_homepage == 1)
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
                                    <div
                                        class="icon-circle-box {{ ++$index % 2 == 0 ? 'active' : '' }} bg-orange-light v-icon-effect">
                                        <div
                                            class="wt-icon-box-wraper center p-b50  m-b30 bdr-1 bdr-gray bdr-solid corner-radius">
                                            <div class="icon-md m-b20 icon-circle">
                                                <span class="icon-cell">
                                                    <i class="{{ $feature->icon }} v-icon mt-4"></i>
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
        @endif
        <!-- WELCOME  SECTION END -->


        @php
            $overview_section = $section->where('id', 3)->first();
        @endphp
        @if ($overview_section->show_homepage == 1)
            <!-- MOBILE ANIMATION SECTION START -->
            <div class="section-full home-overview-bg  p-t80 p-b140  map-animation-section overlay-wraper bg-cover bg-no-repeat"
                style="background-image:url({{ $bannerImages->where('id', 13)->first()->image ? asset($bannerImages->where('id', 13)->first()->image) : '' }});">
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


        @php
            $category_section = $section->where('id', 4)->first();
            $listingCategories = $listingCategories->take($category_section->content_quantity);
        @endphp
        @if ($category_section->show_homepage == 1)
            <!-- TOP ACTIVITIES SECTION START -->
            <div
                class="section-full mobile-map-animation-padding p-t80 p-b80 bg-orange-light dot-left-top-img dot-right-bottom-img">

                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head text-center">
                        <span class="wt-separator-icon"><i class="{{ $category_section->icon }}"></i></span>
                        <h2>{{ $category_section->header }}</h2>
                        <div class="wt-separator sep-gradient-light"></div>
                        <p>{{ $category_section->description }}</p>
                    </div>
                    <!-- TITLE END-->
                </div>


                <div class="section-content container-fluid">
                    <div class="row">
                        @php
                            $colorId = 1;
                        @endphp
                        @foreach ($listingCategories as $index => $category)
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 m-b30">
                                <div class="featured-cat-box bg-cover bg-no-repeat v-icon-effect"
                                    style="background-image:url({{ $category->image ? url($category->image) : '' }})">
                                    <div class="featured-cat-text clearfix">
                                        <div class="f-cat-icon {{ $category->icon }} v-icon"></div>
                                        <div class="featured-cat-name-outer">
                                            <h4 class="featured-cat-name">{{ $category->name }}</h4>

                                            @php
                                                
                                                if ($index % 4 == 0) {
                                                    $colorId = 1;
                                                }
                                                $color = '';
                                                if ($colorId == 1) {
                                                    $color = 'clr-blue';
                                                } elseif ($colorId == 2) {
                                                    $color = 'clr-voilet';
                                                } elseif ($colorId == 3) {
                                                    $color = 'clr-red';
                                                } elseif ($colorId == 4) {
                                                    $color = 'clr-cyan';
                                                }
                                                
                                                $activeListingsByCategory = $category->listings->where('status', 1);
                                                $qty = 0;
                                                foreach ($activeListingsByCategory as $key => $listing) {
                                                    if ($listing->expired_date == null) {
                                                        $qty += 1;
                                                    } elseif ($listing->expired_date > date('Y-m-d')) {
                                                        $qty += 1;
                                                    }
                                                }
                                                
                                            @endphp
                                            <span
                                                class="py-1 featured-cat-user color-lebel {{ $color }}">{{ $qty }}
                                                {{ $websiteLang->where('id', 56)->first()->custom_text }}</span>
                                        </div>
                                    </div>
                                    <div class="featured-cat-overlay"></div>
                                    <a href="{{ route('listings', ['category_slug' => $category->slug, 'page_type' => 'list_view']) }}"
                                        class="featured-cat-linking"></a>
                                </div>
                            </div>
                            @php
                                $colorId++;
                            @endphp
                        @endforeach
                    </div>
                </div>

                <div class="text-center m-t10">
                    <a href="{{ route('listing.category') }}" class="site-button-secondry site-btn-effect"
                        data-hover="Read More">{{ $websiteLang->where('id', 5)->first()->custom_text }}</a>
                </div>


            </div>
            <!-- TOP ACTIVITIES SECTION START -->
        @endif

        @php
            $location_section = $section->where('id', 5)->first();
        @endphp
        @if ($location_section->show_homepage == 1)
            <!-- DESTINATION WE LOVE SECTION START -->
            <div
                class="section-full home-location-bg  p-t80 p-b50 site-bg-primary dot-left-top-bg-dark bg-repeat-x bg-bottom-center">

                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head text-center text-white">
                        <span class="wt-separator-icon"><i class="{{ $location_section->icon }}"></i></span>
                        <h2>{{ $location_section->header }}</h2>
                        <div class="wt-separator sep-gradient-dark"></div>
                        <p>{{ $location_section->description }}</p>
                    </div>
                    <!-- TITLE END-->
                </div>


                <div class="section-content container">
                    <!-- PAGINATION START -->
                    <div class="filter-wrap p-b20 text-center">
                        <ul class="filter-navigation masonry-filter filter-gradi">
                            <li class="active"><a data-filter="*" data-hover="All"
                                    href="javascript::void">{{ $websiteLang->where('id', 6)->first()->custom_text }}</a>
                            </li>
                            @foreach ($locations as $index => $location)
                                <li><a data-filter=".{{ $location->id }}"
                                        href="javascript::void">{{ $location->location }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- PAGINATION END -->
                    <!-- GALLERY CONTENT START -->
                    <div class="masonry-wrap mfp-gallery work-grid row clearfix">
                        <!-- COLUMNS 1 -->
                        @php
                            $colorId = 1;
                        @endphp
                        @foreach ($locations as $index => $location)
                            <div class="masonry-item {{ $location->id }}  col-lg-4 col-md-6 col-sm-12 m-b30">
                                <div class="cities-slide-box bg-cover bg-no-repeat"
                                    style="background-image:url({{ $location->image ? asset($location->image) : '' }})">
                                    @php
                                        
                                        if ($index % 4 == 0) {
                                            $colorId = 1;
                                        }
                                        $color = '';
                                        if ($colorId == 1) {
                                            $color = 'clr-blue';
                                        } elseif ($colorId == 2) {
                                            $color = 'clr-voilet';
                                        } elseif ($colorId == 3) {
                                            $color = 'clr-red';
                                        } elseif ($colorId == 4) {
                                            $color = 'clr-cyan';
                                        }
                                        
                                        $activeListingsByLocation = $location->listings->where('status', 1);
                                        $qty = 0;
                                        foreach ($activeListingsByLocation as $key => $listing) {
                                            if ($listing->expired_date == null) {
                                                $qty += 1;
                                            } elseif ($listing->expired_date > date('Y-m-d')) {
                                                $qty += 1;
                                            }
                                        }
                                        
                                    @endphp
                                    <span
                                        class="py-1 cities-slide-user color-lebel {{ $color }}">{{ $qty }}
                                        {{ $websiteLang->where('id', 56)->first()->custom_text }}</span>
                                    <div class="cities-slide-text text-white">
                                        <div class="cities-location-sign"><i class="{{ $location->icon }}"></i></div>
                                        <div class="city-slide-content">
                                            <h4 class="cities-slide-name">{{ $location->location }}</h4>

                                        </div>
                                    </div>
                                    <div class="cities-slide-overlay"></div>
                                    <a href="{{ route('listings', ['location_slug' => $location->slug, 'page_type' => 'list_view']) }}"
                                        class="cities-slide-linking"></a>
                                </div>
                            </div>
                            @php
                                $colorId++;
                            @endphp
                        @endforeach

                    </div>
                    <!-- GALLERY CONTENT END -->
                </div>


            </div>
            <!-- DESTINATION WE LOVE SECTION START -->
        @endif



        @php
            $listing_section = $section->where('id', 6)->first();
        @endphp
        @if ($listing_section->show_homepage == 1)
            <!-- EXCLUSIVE LISTING PLACE SECTION START -->
            <div class="section-full p-t80 p-b70 bg-orange-light dot2-left-top-img dot2-right-bottom-img">

                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head text-center">
                        <span class="wt-separator-icon"><i class="{{ $listing_section->icon }}"></i></span>
                        <h2>{{ $listing_section->header }}</h2>
                        <div class="wt-separator sep-gradient-light"></div>
                        <p>{{ $listing_section->description }}</p>
                    </div>
                    <!-- TITLE END-->
                </div>

                <div class="section-content container-fluid">

                    <div class="owl-carousel visited-place owl-btn-bottom-center">
                        @php
                            $colorId = 1;
                        @endphp
                        @foreach ($listings as $index => $listing)
                            @if ($listing->expired_date == null)
                                <div class="item">
                                    <div class="listing-cat-box">
                                        <div class="listing-cat-media"><img src="{{ asset($listing->thumbnail_image) }}"
                                                alt=""></div>
                                        @php
                                            
                                            if ($index % 4 == 0) {
                                                $colorId = 1;
                                            }
                                            $color = '';
                                            if ($colorId == 1) {
                                                $color = 'clr-blue';
                                            } elseif ($colorId == 2) {
                                                $color = 'clr-voilet';
                                            } elseif ($colorId == 3) {
                                                $color = 'clr-red';
                                            } elseif ($colorId == 4) {
                                                $color = 'clr-cyan';
                                            }
                                        @endphp
                                        <span
                                            class="listing-category-name color-lebel {{ $color }}">{{ $listing->listingCategory->name }}</span>
                                        <div class="wt-listing-view-section">
                                            <ul>
                                                @guest
                                                    <li>
                                                        <a href="javascript::void" class="listing-cat-preview"
                                                            data-toggle="modal" data-target=".sign-in-modal">
                                                            <i class="fa fa-heart fill-add-to-fav "></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('user.add.to.wishlist', $listing->id) }}"
                                                            class="listing-cat-preview">
                                                            <i class="fa fa-heart fill-add-to-fav "></i>
                                                        </a>
                                                    </li>
                                                @endguest
                                                <li>
                                                    <a href="javascript::void" class="listing-cat-preview"
                                                        data-toggle="modal"
                                                        data-target=".preview-place-{{ $listing->id }}">
                                                        <i class="fa fa-eye "></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="listing-cat-text">
                                            <div class="listing-logo-outer d-flex justify-content-between">
                                                <div class="listing-place-logo"><img src="{{ asset($listing->logo) }}"
                                                        alt=""></div>
                                                @if ($listing->listingSchedule->count() > 0)
                                                    @php
                                                        
                                                        $today = date('l');
                                                        $today = $days->where('day', $today)->first();
                                                        $schedule = $listing->listingSchedule->where('day_id', $today->id)->first();
                                                    @endphp
                                                    @if ($schedule)
                                                        @if ($schedule->status == 1)
                                                            @php
                                                                $start_time = date('Y-m-d') . $schedule->start_time;
                                                                $start_time = strtotime($start_time);
                                                                
                                                                $end_time = date('Y-m-d') . $schedule->end_time;
                                                                $end_time = strtotime($end_time);
                                                                $current_time = Carbon\Carbon::now()->timestamp;
                                                            @endphp

                                                            @if ($start_time <= $current_time && $current_time <= $end_time)
                                                                <div class="listing-place-timing"><span
                                                                        class="color-lebel clr-green">{{ $websiteLang->where('id', 8)->first()->custom_text }}</span>
                                                                </div>
                                                            @else
                                                                <div class="listing-place-timing"><span
                                                                        class="color-lebel clr-red">{{ $websiteLang->where('id', 455)->first()->custom_text }}</span>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                            @if ($listing->reviews->where('status', 1)->count() > 0)
                                                @php
                                                    $qty = $listing->reviews->where('status', 1)->count();
                                                    $total = $listing->reviews->where('status', 1)->sum('rating');
                                                    $avg = $total / $qty;
                                                    $intAvg = intval($avg);
                                                    $nextVal = $intAvg + 1;
                                                    $reviewPoint = $intAvg;
                                                    $halfReview = false;
                                                    if ($intAvg < $avg && $avg < $nextVal) {
                                                        $reviewPoint = $intAvg + 0.5;
                                                        $halfReview = true;
                                                    }
                                                @endphp

                                                <div class="wt-rating-section">
                                                    <span class="wt-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $reviewPoint)
                                                                <i class="fa fa-star"></i>
                                                            @elseif ($i > $reviewPoint)
                                                                @if ($halfReview == true)
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    @php
                                                                        $halfReview = false;
                                                                    @endphp
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    </span>
                                                    <span class="wt-rating-conting">({{ $qty }}
                                                        {{ $websiteLang->where('id', 9)->first()->custom_text }})</span>
                                                </div>
                                            @else
                                                <div class="wt-rating-section">
                                                    <span class="wt-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fa fa-star-o"></i>
                                                        @endfor
                                                    </span>
                                                    <span class="wt-rating-conting">(0
                                                        {{ $websiteLang->where('id', 9)->first()->custom_text }})</span>
                                                </div>
                                            @endif
                                            <h4 class="listing-place-name"><a
                                                    href="{{ route('listing.show', $listing->slug) }}">{{ $listing->title }}</a>
                                            </h4>
                                            <span class="listing-cat-address"><i
                                                    class="sl-icon-location"></i>{{ $listing->address }}</span>
                                        </div>
                                    </div>
                                </div>
                            @elseif($listing->expired_date > date('Y-m-d'))
                                <div class="item">
                                    <div class="listing-cat-box">
                                        <div class="listing-cat-media"><img src="{{ asset($listing->thumbnail_image) }}"
                                                alt=""></div>
                                        @php
                                            
                                            if ($index % 4 == 0) {
                                                $colorId = 1;
                                            }
                                            $color = '';
                                            if ($colorId == 1) {
                                                $color = 'clr-blue';
                                            } elseif ($colorId == 2) {
                                                $color = 'clr-voilet';
                                            } elseif ($colorId == 3) {
                                                $color = 'clr-red';
                                            } elseif ($colorId == 4) {
                                                $color = 'clr-cyan';
                                            }
                                        @endphp
                                        <span
                                            class="listing-category-name color-lebel {{ $color }}">{{ $listing->listingCategory->name }}</span>
                                        <div class="wt-listing-view-section">
                                            <ul>
                                                @guest
                                                    <li>
                                                        <a href="javascript::void" class="listing-cat-preview"
                                                            data-toggle="modal" data-target=".sign-in-modal">
                                                            <i class="fa fa-heart fill-add-to-fav "></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('user.add.to.wishlist', $listing->id) }}"
                                                            class="listing-cat-preview">
                                                            <i class="fa fa-heart fill-add-to-fav "></i>
                                                        </a>
                                                    </li>
                                                @endguest
                                                <li>
                                                    <a href="javascript::void" class="listing-cat-preview"
                                                        data-toggle="modal"
                                                        data-target=".preview-place-{{ $listing->id }}">
                                                        <i class="fa fa-eye "></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="listing-cat-text">
                                            <div class="listing-logo-outer d-flex justify-content-between">
                                                <div class="listing-place-logo"><img src="{{ asset($listing->logo) }}"
                                                        alt=""></div>
                                                @if ($listing->listingSchedule->count() > 0)
                                                    @php
                                                        
                                                        $today = date('l');
                                                        $today = $days->where('day', $today)->first();
                                                        $schedule = $listing->listingSchedule->where('day_id', $today->id)->first();
                                                    @endphp
                                                    @if ($schedule)
                                                        @if ($schedule->status == 1)
                                                            @php
                                                                $start_time = date('Y-m-d') . $schedule->start_time;
                                                                $start_time = strtotime($start_time);
                                                                
                                                                $end_time = date('Y-m-d') . $schedule->end_time;
                                                                $end_time = strtotime($end_time);
                                                                $current_time = Carbon\Carbon::now()->timestamp;
                                                            @endphp

                                                            @if ($start_time <= $current_time && $current_time <= $end_time)
                                                                <div class="listing-place-timing"><span
                                                                        class="color-lebel clr-green">{{ $websiteLang->where('id', 8)->first()->custom_text }}</span>
                                                                </div>
                                                            @else
                                                                <div class="listing-place-timing"><span
                                                                        class="color-lebel clr-red">{{ $websiteLang->where('id', 455)->first()->custom_text }}</span>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                            @if ($listing->reviews->where('status', 1)->count() > 0)
                                                @php
                                                    $qty = $listing->reviews->where('status', 1)->count();
                                                    $total = $listing->reviews->where('status', 1)->sum('rating');
                                                    $avg = $total / $qty;
                                                    $intAvg = intval($avg);
                                                    $nextVal = $intAvg + 1;
                                                    $reviewPoint = $intAvg;
                                                    $halfReview = false;
                                                    if ($intAvg < $avg && $avg < $nextVal) {
                                                        $reviewPoint = $intAvg + 0.5;
                                                        $halfReview = true;
                                                    }
                                                @endphp

                                                <div class="wt-rating-section">
                                                    <span class="wt-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $reviewPoint)
                                                                <i class="fa fa-star"></i>
                                                            @elseif ($i > $reviewPoint)
                                                                @if ($halfReview == true)
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    @php
                                                                        $halfReview = false;
                                                                    @endphp
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    </span>
                                                    <span class="wt-rating-conting">({{ $qty }}
                                                        {{ $websiteLang->where('id', 9)->first()->custom_text }})</span>
                                                </div>
                                            @else
                                                <div class="wt-rating-section">
                                                    <span class="wt-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fa fa-star-o"></i>
                                                        @endfor
                                                    </span>
                                                    <span class="wt-rating-conting">(0
                                                        {{ $websiteLang->where('id', 9)->first()->custom_text }})</span>
                                                </div>
                                            @endif
                                            <h4 class="listing-place-name"><a
                                                    href="{{ route('listing.show', $listing->slug) }}">{{ $listing->title }}</a>
                                            </h4>
                                            <span class="listing-cat-address"><i
                                                    class="sl-icon-location"></i>{{ $listing->address }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @php
                                $colorId++;
                            @endphp
                        @endforeach

                    </div>

                </div>

            </div>
            <!-- EXCLUSIVE LISTING  SECTION END -->
        @endif

        @php
            $listing_package_section = $section->where('id', 7)->first();
            $listingPackages = $listingPackages->take($listing_package_section->content_quantity);
        @endphp
        @if ($listing_package_section->show_homepage == 1)
            <!-- PRICING TABLE SECTION START -->
            <div class="section-full p-t80 p-b50 bg-white">
                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head text-center">
                        <span class="wt-separator-icon"><i class="{{ $listing_package_section->icon }}"></i></span>
                        <h2>{{ $listing_package_section->header }}</h2>
                        <div class="wt-separator sep-gradient-light"></div>
                        <p>{{ $listing_package_section->description }}</p>
                    </div>
                    <!-- TITLE END-->

                    <div class="section-content">
                        <div class="pricingtable-row m-b30">
                            <div class="row d-flex justify-content-center">
                                @foreach ($listingPackages as $index => $listingPackage)
                                    <div class="col-lg-4 col-md-6 col-sm-12 m-b100">
                                        <div class="pricingtable-wrapper pricingtable-highlight-outer">
                                            <div class="pricingtable-inner pricingtable-highlight dot2-left-top-img">
                                                <div class="pricing-table-top-section">
                                                    <div class="pricingtable-title">
                                                        <h4>{{ $listingPackage->package_name }}</h4>
                                                    </div>

                                                    @php
                                                        $unlimited = $websiteLang->where('id', 425)->first()->custom_text;
                                                    @endphp

                                                    <div class="pricingtable-price">
                                                        <span class="pricingtable-bx"><sup
                                                                class="pricingtable-sign">{{ $currency->currency_icon }}</sup>{{ $listingPackage->price }}</span>
                                                        <span
                                                            class="pricingtable-type">{{ $listingPackage->number_of_days == -1 ? $unlimited : $listingPackage->number_of_days }}
                                                            {{ $websiteLang->where('id', 14)->first()->custom_text }}</span>
                                                    </div>

                                                </div>

                                                <ul class="pricingtable-features">
                                                    <li>{{ $listingPackage->number_of_listing == -1 ? $unlimited : $listingPackage->number_of_listing }}
                                                        {{ $websiteLang->where('id', 15)->first()->custom_text }}</li>
                                                    @if ($listingPackage->number_of_days != -1)
                                                        <li>{{ $listingPackage->number_of_days }}
                                                            {{ $websiteLang->where('id', 16)->first()->custom_text }}</li>
                                                    @else
                                                        <li>{{ $unlimited }}
                                                            {{ $websiteLang->where('id', 16)->first()->custom_text }}</li>
                                                    @endif

                                                    <li>{{ $listingPackage->number_of_aminities == -1 ? $unlimited : $listingPackage->number_of_aminities }}
                                                        {{ $websiteLang->where('id', 17)->first()->custom_text }}</li>
                                                    <li>{{ $listingPackage->number_of_photo == -1 ? $unlimited : $listingPackage->number_of_photo }}
                                                        {{ $websiteLang->where('id', 18)->first()->custom_text }}</li>
                                                    <li>{{ $listingPackage->number_of_video == -1 ? $unlimited : $listingPackage->number_of_video }}
                                                        {{ $websiteLang->where('id', 19)->first()->custom_text }}</li>
                                                    @if ($listingPackage->is_featured == 1)
                                                        <li>{{ $websiteLang->where('id', 20)->first()->custom_text }}</li>
                                                        <li>{{ $listingPackage->number_of_feature_listing == -1 ? $unlimited : $listingPackage->number_of_feature_listing }}
                                                            {{ $websiteLang->where('id', 21)->first()->custom_text }}</li>
                                                    @else
                                                        <li>{{ $websiteLang->where('id', 441)->first()->custom_text }}
                                                        </li>
                                                        <li>0 {{ $websiteLang->where('id', 21)->first()->custom_text }}
                                                        </li>
                                                    @endif
                                                </ul>

                                                <div class="pricingtable-footer">
                                                    @auth
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target=".confirmation-modal-{{ $listingPackage->id }}"
                                                            class="site-button-secondry  site-button-gradient">{{ $websiteLang->where('id', 13)->first()->custom_text }}</a>
                                                    @else
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target=".sign-in-modal"
                                                            class="site-button-secondry  site-button-gradient">{{ $websiteLang->where('id', 13)->first()->custom_text }}</a>
                                                    @endauth

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach





                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRICING TABLE SECTION END -->
        @endif

        @php
            $blog_section = $section->where('id', 8)->first();
            $blogs = $blogs->take($blog_section->content_quantity);
        @endphp
        @if ($blog_section->show_homepage == 1)
            <!-- OUR BLOG START -->
            <div class="section-full  p-t80 p-b40 bg-orange-light blog-post-outer-3 ">
                <div class="container">

                    <!-- TITLE START-->
                    <div class="section-head text-center">
                        <span class="wt-separator-icon"><i class="{{ $blog_section->icon }}"></i></span>
                        <h2>{{ $blog_section->header }}</h2>
                        <div class="wt-separator sep-gradient-light"></div>
                        <p>{{ $blog_section->description }}</p>
                    </div>
                    <!-- TITLE END-->

                    <!-- BLOG SECTION START -->
                    <div class="section-content">
                        <div class="row d-flex justify-content-center">
                            @php
                                $colorId = 1;
                            @endphp
                            @foreach ($blogs as $index => $blog)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="blog-post latest-blog-1 overlay-wraper post-overlay  large-date bg-cover bg-no-repeat bg-top-center"
                                        style="background-image:url({{ $blog->thumbnail_image ? url($blog->thumbnail_image) : '' }})">
                                        <div class="overlay-main overlay-gradient"></div>
                                        @php
                                            
                                            if ($index % 4 == 0) {
                                                $colorId = 1;
                                            }
                                            $color = '';
                                            if ($colorId == 1) {
                                                $color = 'clr-blue';
                                            } elseif ($colorId == 2) {
                                                $color = 'clr-voilet';
                                            } elseif ($colorId == 3) {
                                                $color = 'clr-red';
                                            } elseif ($colorId == 4) {
                                                $color = 'clr-cyan';
                                            }
                                        @endphp
                                        <div class="blog-category"><span
                                                class="{{ $color }}">{{ $blog->category->name }}</span></div>
                                        <div class="wt-post-info text-white">
                                            <div class="post-overlay-position">
                                                <div class="post-content-outer p-a30">

                                                    <div class="wt-post-title ">
                                                        <h4 class="post-title"><a
                                                                href="{{ route('blog.details', $blog->slug) }}"
                                                                class="text-white text-capitalize">{{ $blog->title }}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="wt-post-meta ">
                                                        <ul>
                                                            <li class="post-date  site-text-secondry">
                                                                {{ $blog->created_at->format('M d Y') }}</li>
                                                            @if ($currency->text_direction == 'RTL')
                                                                <li class="post-author"> {{ $blog->admin->name }}
                                                                    {{ $websiteLang->where('id', 22)->first()->custom_text }}
                                                                </li>
                                                            @else
                                                                <li class="post-author">
                                                                    {{ $websiteLang->where('id', 22)->first()->custom_text }}
                                                                    {{ $blog->admin->name }} </li>
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
                    </div>
                </div>

            </div>
            <!-- OUR BLOG END -->
        @endif


        @php
            $subscribe_section = $section->where('id', 9)->first();
        @endphp
        @if ($subscribe_section->show_homepage == 1)
            <!-- NEWSLETTER SECTION START -->
            <div class="section-full p-t0 p-b80 bg-orange-light">
                <div class="container ">

                    <div class="section-content home-subscribe-bg site-bg-secondry radius-md bg-no-repeat bg-top-right">
                        <div class="newsletter-section  text-white  p-a40">
                            <div class="row d-flex align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="newsletter-title">
                                        <h3 class="m-t0">{{ $subscribe_section->header }}</h3>
                                        <span>{{ $subscribe_section->description }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="newsletter-input">

                                        <form id="subscribeForm">
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-envelope-o "></i></span>
                                                </div>
                                                <input id="subscribe_email" type="text" class="form-control"
                                                    name="email"
                                                    placeholder="{{ $websiteLang->where('id', 24)->first()->custom_text }}">
                                                <div class="input-group-append">
                                                    <button type="button" id="subscribeBtn"
                                                        class="input-group-text nl-search-btn text-white site-bg-primary">
                                                        <i id="subscribe-spinner"
                                                            class="loading-icon fa fa-spin fa-spinner d-none mr-2"></i>
                                                        {{ $websiteLang->where('id', 23)->first()->custom_text }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- NEWSLETTER TABLE SECTION END -->
        @endif

        @php
            $testimonial_section = $section->where('id', 10)->first();
            $testimonials = $testimonials->take($testimonial_section->content_quantity);
        @endphp
        @if ($testimonial_section->show_homepage == 1)
            <!-- TESTIMONIAL SECTION START -->
            <div class="section-full  p-t80 p-b80 site-bg-primary dot-left-top-bg-dark">
                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head text-center text-white">
                        <span class="wt-separator-icon"><i class="{{ $testimonial_section->icon }}"></i></span>
                        <h2>{{ $testimonial_section->header }}</h2>
                        <div class="wt-separator sep-gradient-dark"></div>
                        <p>{{ $testimonial_section->description }}</p>
                    </div>
                    <!-- TITLE END-->
                    <div class="section-content">
                        <div class="owl-carousel testimonial-home dark-next-prev">
                            @foreach ($testimonials as $testimonial)
                                <div class="item">
                                    <div class="testimonial-2  bg-white corner-radius">
                                        <div class="testimonial-pic radius shadow"><img
                                                src="{{ asset($testimonial->image) }}" width="100" height="100"
                                                alt=""></div>
                                        <div class="testimonial-content  p-a30">
                                            <div class="testimonial-text">
                                                <p>{{ $testimonial->description }}</p>
                                            </div>
                                            <div class="testimonial-detail clearfix">
                                                <div class="testimonial-info">
                                                    <h4 class="testimonial-name">{{ $testimonial->name }}</h4>
                                                    <span
                                                        class="testimonial-position site-text-secondry">{{ $testimonial->designation }}</span>
                                                    <div class="client-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $testimonial->rating)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <span class="fa fa-quote-right"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
            <!-- TESTIMONIAL SECTION END -->
        @endif


    </div>
    <!-- CONTENT END -->
@endsection
