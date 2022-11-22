@extends('layouts.user.layout')
@section('title')
    <title>{{ $user->name }}</title>
@endsection


@section('user-content')
        <!-- CONTENT START -->
        <div class="page-content bg-white">

            <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url({{ $user->banner_image ? asset($user->banner_image) : asset($image->image) }});">
            <div class="overlay-main bg-black opacity-05"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="text-white">{{ $user->name }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $user->name }}</li>
                        </ul>
                    </div>

                    <!-- BREADCRUMB ROW END -->
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->

			<div class="section-full p-tb50">
            	<div class="container">
                    <!-- provider info -->
                        <div class="wt-list-single-info-bar wt-list-panel bg-white">
                        	<div class="wt-list-single-info-box-top">
                                <div class="row">

                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="wt-list-single-info-box ">
                                        		<div class="wt-list-single-site-info clearfix">
                                                    <div class="listing-place-logo"><img src="{{ $user->image ? asset($user->image) : asset($default_image->image) }}" alt=""></div>
                                                    <div class="wt-list-single-info-detail">
                                                        <h3 class="wt-list-single-title">{{ $user->name }}</h3>
                                                        <p><span><i class="fa fa-envelope site-text-secondry"></i></span> {{ $user->email }}</p>

                                                        @if ($user->phone)
                                                        <p><span><i class="fa fa-phone site-text-secondry"></i></span> {{ $user->phone }}</p>
                                                        @endif

                                                        @if ($user->about)
                                                        <p>{{ $user->about }}</p>
                                                        @endif


                                                    </div>
                                                </div>




                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="wt-list-single3-location-info">
                                            <ul class="list-unstyled m-b0">
                                                @if ($user->address)
                                                <li><span><i class="fa fa-map-marker site-text-secondry"></i></span><p>{{ $user->address }}</p></li>
                                                @endif

                                                @if ($user->website)
                                                <li><span><i class="fa fa-globe site-text-secondry"></i></span><p><a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a></p></li>
                                                @endif

                                            </ul>


                                            <ul class="social-icons social-square social-md listing-detail">
                                                @if ($user->facebook)
                                                <li>
                                                    <a target="_blank" href="{{ $user->facebook }}" class="fab fa-facebook icon"></a>
                                                </li>
                                                @endif
                                                @if ($user->twitter)
                                                <li>
                                                    <a target="_blank" href="{{ $user->twitter }}" class="fab fa-twitter icon"></a>
                                                </li>
                                                @endif
                                                @if ($user->linkedin)
                                                <li>
                                                    <a target="_blank" href="{{ $user->linkedin }}" class="fab fa-linkedin icon"></a>
                                                </li>
                                                @endif
                                                @if ($user->whatsapp)
                                                <li>
                                                    <a target="_blank" href="{{ $user->whatsapp }}" class="fab fa-whatsapp icon"></a>
                                                </li>
                                                @endif
                                                @if ($user->youtube)
                                                <li>
                                                    <a target="_blank" href="{{ $user->youtube }}" class="fab fa-youtube icon"></a>
                                                </li>
                                                @endif
                                                @if ($user->pinterest)
                                                <li>
                                                    <a target="_blank" href="{{ $user->pinterest }}" class="fab fa-pinterest icon"></a>
                                                </li>
                                                @endif
                                                @if ($user->instagram)
                                                <li>
                                                    <a target="_blank" href="{{ $user->instagram }}" class="fab fa-instagram icon"></a>
                                                </li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <!--provider info End -->
                </div>
            </div>

            <!-- SECTION CONTENT START -->
        <div class="section-full small-device bg-white">
            <div class="container">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="shadow p-a30 side-bar-opposite">
                            <div class="wt-listing-container" id="showSearchResult">
                                <div class="row">
                                    @php
                                        $colorId=1;
                                    @endphp
                                    @foreach ($listings as $index => $listing)
                                    @if ($listing->expired_date==null)
                                    <div class="col-lg-4 col-md-4">
                                        <div class="listing-cat-box m-b30">
                                            <div class="listing-cat-media"><img src="{{ asset($listing->thumbnail_image) }}" alt=""></div>
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
                                            <span class="listing-category-name color-lebel {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listing->listingCategory->name }}</a></span>
                                            <div class="wt-listing-view-section">
                                                <ul>
                                                    @guest
                                                        <li>
                                                            <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".sign-in-modal">
                                                                <i class="fa fa-heart fill-add-to-fav "></i>
                                                            </a>
                                                        </li>
                                                        @else
                                                        <li>
                                                            <a href="{{ route('user.add.to.wishlist',$listing->id) }}" class="listing-cat-preview">
                                                                <i class="fa fa-heart fill-add-to-fav "></i>
                                                            </a>
                                                        </li>
                                                        @endguest
                                                        <li>
                                                            <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".preview-place-{{ $listing->id }}">
                                                                <i class="fa fa-eye "></i>
                                                            </a>
                                                        </li>
                                                </ul>
                                            </div>
                                            <div class="listing-cat-text">
                                                <div class="listing-logo-outer d-flex justify-content-between">
                                                    <div class="listing-place-logo"><img src="{{ asset($listing->logo) }}" alt=""></div>
                                                    @if ($listing->listingSchedule->count()> 0)
                                                        @php

                                                            $today=date('l');
                                                            $today=$days->where('day',$today)->first();
                                                            $schedule=$listing->listingSchedule->where('day_id',$today->id)->first();
                                                        @endphp
                                                        @if ($schedule)

                                                            @if ($schedule->status==1)
                                                                @php
                                                                    $start_time=date('Y-m-d').$schedule->start_time;
                                                                    $start_time=strtotime($start_time);

                                                                    $end_time=date('Y-m-d').$schedule->end_time;
                                                                    $end_time=strtotime($end_time);
                                                                    $current_time=Carbon\Carbon::now()->timestamp;
                                                                @endphp

                                                                @if ($start_time <= $current_time && $current_time <= $end_time)
                                                                    <div class="listing-place-timing"><span class="color-lebel clr-green">{{ $websiteLang->where('id',8)->first()->custom_text }}</span></div>

                                                                @else
                                                                    <div class="listing-place-timing"><span class="color-lebel clr-red">{{ $websiteLang->where('id',455)->first()->custom_text }}</span></div>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                                @if ($listing->reviews->where('status',1)->count() > 0)

                                                    @php
                                                        $qty=$listing->reviews->where('status',1)->count();
                                                        $total=$listing->reviews->where('status',1)->sum('rating');
                                                        $avg=$total/$qty;
                                                        $intAvg=intval($avg);
                                                        $nextVal=$intAvg+1;
                                                        $reviewPoint=$intAvg;
                                                        $halfReview=false;
                                                        if($intAvg < $avg && $avg < $nextVal){
                                                            $reviewPoint= $intAvg + 0.5;
                                                            $halfReview=true;
                                                        }
                                                    @endphp

                                                    <div class="wt-rating-section">
                                                        <span class="wt-rating">
                                                            @for ($i = 1; $i <=5; $i++)
                                                                        @if ($i <= $reviewPoint)
                                                                            <i class="fa fa-star"></i>
                                                                        @elseif ($i> $reviewPoint )
                                                                            @if ($halfReview==true)
                                                                                <i class="fa fa-star-half-o"></i>
                                                                                @php
                                                                                    $halfReview=false
                                                                                @endphp
                                                                            @else
                                                                                <i class="fa fa-star-o"></i>
                                                                            @endif
                                                                        @endif
                                                                    @endfor
                                                        </span>
                                                        <span class="wt-rating-conting">({{ $qty }} {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                                    </div>
                                                    @else
                                                    <div class="wt-rating-section">
                                                        <span class="wt-rating">
                                                            @for ($i = 1; $i <=5; $i++)
                                                                <i class="fa fa-star-o"></i>
                                                            @endfor
                                                        </span>
                                                        <span class="wt-rating-conting">(0 {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                                    </div>
                                                @endif
                                                <h4 class="listing-place-name"><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a></h4>
                                                <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listing->address }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($listing->expired_date> date('Y-m-d'))
                                    <div class="col-lg-4 col-md-4">
                                        <div class="listing-cat-box m-b30">
                                            <div class="listing-cat-media"><img src="{{ asset($listing->thumbnail_image) }}" alt=""></div>
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
                                            <span class="listing-category-name color-lebel {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listing->listingCategory->name }}</a></span>
                                            <div class="wt-listing-view-section">
                                                <ul>
                                                    @guest
                                                        <li>
                                                            <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".sign-in-modal">
                                                                <i class="fa fa-heart fill-add-to-fav "></i>
                                                            </a>
                                                        </li>
                                                        @else
                                                        <li>
                                                            <a href="{{ route('user.add.to.wishlist',$listing->id) }}" class="listing-cat-preview">
                                                                <i class="fa fa-heart fill-add-to-fav "></i>
                                                            </a>
                                                        </li>
                                                        @endguest
                                                        <li>
                                                            <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".preview-place-{{ $listing->id }}">
                                                                <i class="fa fa-eye "></i>
                                                            </a>
                                                        </li>
                                                </ul>
                                            </div>
                                            <div class="listing-cat-text">
                                                <div class="listing-logo-outer d-flex justify-content-between">
                                                    <div class="listing-place-logo"><img src="{{ asset($listing->logo) }}" alt=""></div>
                                                    @if ($listing->listingSchedule->count()> 0)
                                                        @php

                                                            $today=date('l');
                                                            $today=$days->where('day',$today)->first();
                                                            $schedule=$listing->listingSchedule->where('day_id',$today->id)->first();
                                                        @endphp
                                                        @if ($schedule)

                                                            @if ($schedule->status==1)
                                                                @php
                                                                    $start_time=date('Y-m-d').$schedule->start_time;
                                                                    $start_time=strtotime($start_time);

                                                                    $end_time=date('Y-m-d').$schedule->end_time;
                                                                    $end_time=strtotime($end_time);
                                                                    $current_time=Carbon\Carbon::now()->timestamp;
                                                                @endphp

                                                                @if ($start_time <= $current_time && $current_time <= $end_time)
                                                                    <div class="listing-place-timing"><span class="color-lebel clr-green">{{ $websiteLang->where('id',8)->first()->custom_text }}</span></div>

                                                                @else
                                                                    <div class="listing-place-timing"><span class="color-lebel clr-red">{{ $websiteLang->where('id',455)->first()->custom_text }}</span></div>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                                @if ($listing->reviews->where('status',1)->count() > 0)

                                                    @php
                                                        $qty=$listing->reviews->where('status',1)->count();
                                                        $total=$listing->reviews->where('status',1)->sum('rating');
                                                        $avg=$total/$qty;
                                                        $intAvg=intval($avg);
                                                        $nextVal=$intAvg+1;
                                                        $reviewPoint=$intAvg;
                                                        $halfReview=false;
                                                        if($intAvg < $avg && $avg < $nextVal){
                                                            $reviewPoint= $intAvg + 0.5;
                                                            $halfReview=true;
                                                        }
                                                    @endphp

                                                    <div class="wt-rating-section">
                                                        <span class="wt-rating">
                                                            @for ($i = 1; $i <=5; $i++)
                                                                        @if ($i <= $reviewPoint)
                                                                            <i class="fa fa-star"></i>
                                                                        @elseif ($i> $reviewPoint )
                                                                            @if ($halfReview==true)
                                                                                <i class="fa fa-star-half-o"></i>
                                                                                @php
                                                                                    $halfReview=false
                                                                                @endphp
                                                                            @else
                                                                                <i class="fa fa-star-o"></i>
                                                                            @endif
                                                                        @endif
                                                                    @endfor
                                                        </span>
                                                        <span class="wt-rating-conting">({{ $qty }} {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                                    </div>
                                                    @else
                                                    <div class="wt-rating-section">
                                                        <span class="wt-rating">
                                                            @for ($i = 1; $i <=5; $i++)
                                                                <i class="fa fa-star-o"></i>
                                                            @endfor
                                                        </span>
                                                        <span class="wt-rating-conting">(0 {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                                    </div>
                                                @endif
                                                <h4 class="listing-place-name"><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }}</a></h4>
                                                <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listing->address }}</span>
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

                            <div class="pagination-bx clearfix">
                                  {{ $listings->links() }}
                            </div>
                        </div>
                    </div>




                </div>

            </div>


        </div>
        <!-- SECTION CONTENT END  -->

        </div>
        <!-- CONTENT END -->
        <br>



@endsection


