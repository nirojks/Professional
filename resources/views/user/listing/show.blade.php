@extends('layouts.user.layout')
@section('title')
    <title>{{ $listing->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $listing->seo_description }}">
@endsection

@section('user-content')
        <!-- CONTENT START -->
        <div class="page-content bg-white">

            <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url({{ $listing->banner_image ? asset($listing->banner_image) : '' }});">
            <div class="overlay-main bg-black opacity-05"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="text-white">{{ $listing->title }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li><a href="{{ route('listings',['page_type'=>'list_view']) }}">{{ $menus->where('id',2)->first()->navbar }}</a></li>
                            <li>{{ $listing->title }}</li>
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
                                                    <div class="listing-place-logo"><img src="{{ asset($listing->logo) }}" alt=""></div>
                                                    <div class="wt-list-single-info-detail">
                                                        <h3 class="wt-list-single-title">{{ $listing->title }}</h3>
                                                        @if ($listing->user_type==1)
                                                        <span class="hosted-by"> {{ $websiteLang->where('id',22)->first()->custom_text }} <a href="{{ route('user-profile',['user_type'=>1,'slug'=>$listing->admin->slug]) }}"><strong>{{ $listing->admin->name }}</strong></a> </span>
                                                        @else
                                                        <span class="hosted-by"> {{ $websiteLang->where('id',22)->first()->custom_text }}<strong><a href="{{ route('user-profile',['user_type'=>0,'slug'=>$listing->user->slug]) }}"><strong>{{ $listing->user->name }}</strong></a></strong></span>
                                                        @endif

                                                        @if ($reviews->where('status',1)->count()>0)
                                                        @php
                                                            $qty=$reviews->where('status',1)->count();
                                                            $total=$reviews->where('status',1)->sum('rating');
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
                                                        <div class="wt-list-single-ratings">
                                                            <div class="star-rating-input text-yellow">
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
                                                            </div>
                                                            <span class="star-rating-counts">{{ sprintf("%.1f", $reviewPoint) }}</span>
                                                            <label>({{ $reviews->where('status',1)->count() }} {{ $websiteLang->where('id',9)->first()->custom_text }})</label>
                                                        </div>
                                                        @else
                                                        <div class="wt-list-single-ratings">
                                                            <div class="star-rating-input text-yellow">
                                                                @for ($i = 1; $i <=5; $i++)
                                                                <i class="fa fa-star-o"></i>
                                                                @endfor
                                                            </div>
                                                            <span class="star-rating-counts">0.0</span>
                                                            <label>(0 {{ $websiteLang->where('id',9)->first()->custom_text }})</label>
                                                        </div>

                                                        @endif
                                                    </div>
                                                </div>

                                            <div class="wt-list-single-info-box-btns">

                                                @if ($listing->verified==1)
                                                    <button class="site-button-small"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</button>
                                                @else
                                                <button data-toggle="modal" data-target=".claime-modal" class="site-button-small"> {{ $websiteLang->where('id',457)->first()->custom_text }}</button>

                                                @endif


                                                @guest
                                                    <button data-toggle="modal" data-target=".sign-in-modal" class="site-button-small"><i class="fa fa-heart"></i> {{ $websiteLang->where('id',28)->first()->custom_text }}</button>
                                                @else
                                                    @php
                                                        $user=Auth::guard('web')->user();
                                                        $isWishlist=false;
                                                        foreach ($wishlists as $key => $wishlist) {
                                                            if($wishlist->listing_id== $listing->id && $wishlist->user_id==$user->id){
                                                                $isWishlist=true;
                                                            }
                                                        }

                                                    @endphp
                                                    @if ($isWishlist)
                                                        <button class="site-button-small"><i class="fa fa-heart"></i> {{ $websiteLang->where('id',436)->first()->custom_text }}</button>
                                                    @else
                                                    <a href="{{ route('user.add.to.wishlist',$listing->id) }}">
                                                        <button class="site-button-small"><i class="fa fa-heart"></i> {{ $websiteLang->where('id',28)->first()->custom_text }}</button>
                                                    </a>
                                                    @endif
                                                @endguest


                                                <button class="site-button-small"><i class="fa fa-eye"></i> {{ $listing->views }}</button>


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
                                                        <button class="site-button-small bg-success text-white"> {{ $websiteLang->where('id',8)->first()->custom_text }}</button>
                                                        @else
                                                        <button class="site-button-small bg-danger text-white"> {{ $websiteLang->where('id',455)->first()->custom_text }}</button>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            </div>



                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="wt-list-single3-location-info">
                                            <ul class="list-unstyled m-b0">
                                                <li><span><i class="fa fa-map-marker site-text-secondry"></i></span><p>{{ $listing->address }}</p></li>
                                                @if ($listing->phone)
                                                <li><span><i class="fa fa-phone site-text-secondry"></i></span><p>{{ $listing->phone }}  </p></li>
                                                @endif
                                                @if ($listing->email)
                                                <li><span><i class="fa fa-envelope site-text-secondry"></i></span><p>{{ $listing->email }}</p></li>
                                                @endif

                                                @if ($listing->website)
                                                <li><span><i class="fa fa-globe site-text-secondry"></i></span><p>{{ $listing->website }}</p></li>
                                                @endif

                                            </ul>


                                            <ul class="social-icons social-square social-md listing-detail">
                                                @if ($listing->facebook)
                                                <li>
                                                    <a target="_blank" href="{{ $listing->facebook }}" class="fab fa-facebook icon"></a>
                                                </li>
                                                @endif


                                                @if ($listing->twitter)
                                                <li>
                                                    <a target="_blank" href="{{ $listing->twitter }}" class="fab fa-twitter icon"></a>
                                                </li>
                                                @endif
                                                @if ($listing->linkedin)
                                                <li>
                                                    <a target="_blank" href="{{ $listing->linkedin }}" class="fab fa-linkedin icon"></a>
                                                </li>
                                                @endif
                                                @if ($listing->whatsapp)
                                                <li>
                                                    <a target="_blank" href="{{ $listing->whatsapp }}" class="fab fa-whatsapp icon"></a>
                                                </li>
                                                @endif
                                                @if ($listing->youtube)
                                                <li>
                                                    <a target="_blank" href="{{ $listing->youtube }}" class="fab fa-youtube icon"></a>
                                                </li>
                                                @endif
                                                @if ($listing->pinterest)
                                                    <li>
                                                        <a target="_blank" href="{{ $listing->pinterest }}" class="fab fa-pinterest icon"></a>
                                                    </li>
                                                @endif
                                                @if ($listing->instagram)
                                                <li>
                                                    <a target="_blank" href="{{ $listing->instagram }}" class="fab fa-instagram icon"></a>
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

            <div class="section-full p-b50">
                <div class="container">

                      <div class="row">
                      		<div class="col-lg-8 col-md-12">


                            <!-- About Detail-->
                                <div class="wt-list-panel m-b30  p-a20 bg-white shadow">
                                    <div class="wt-list-single-about-detail">

                                        {!! clean($listing->description) !!}

                                        @if ($listing->file)
                                        <div class="text-left m-t30	">
                                            <a class="site-button-secondry site-btn-effect" href="{{ route('download-listing-file',$listing->file) }}">{{ $websiteLang->where('id',29)->first()->custom_text }}<i class="ml-2 fa fa-file-pdf"></i></a>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                             <!-- About Detail End-->

                             @if ($listing->listingImages->count() > 0)
                             <!--Gallery-->
                            	<div  class="wt-list-panel m-b30  p-a20 bg-white shadow">
                                    <div class="m-b30 text-left">
                                        <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',30)->first()->custom_text }}</h4>
                                        <div class="wt-separator sep-gradient-light"></div>
                                    </div>
									<div class="wt-box wt-product-gallery on-show-slider">

                                        <div id="sync1" class="owl-carousel owl-theme owl-btn-vertical-center m-b5">
                                            @foreach ($listing->listingImages as $image)
                                            <div class="item">
                                                <div class="mfp-gallery">
                                                    <div class="wt-box">
                                                        <div class="wt-thum-bx wt-img-overlay1 ">
                                                            <img src="{{ asset($image->image) }}" alt="">
                                                            <div class="overlay-bx">
                                                                <div class="overlay-icon">
                                                                    <a class="mfp-link" href="{{ asset($image->image) }}">
                                                                        <i class="fa fa-arrows-alt wt-icon-box-xs site-bg-secondry"></i>
                                                                    </a>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <div id="sync2" class="owl-carousel owl-theme">
                                            @foreach ($listing->listingImages as $image)
                                            <div class="item">
                                                <div class="wt-media">
                                                    <img src="{{ asset($image->image) }}" alt="">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            <!--Gallery -->
                            @endif

                            @if ($listing->listingAminities->count()>0)
                            <!-- Amenities -->
                                <div class="wt-list-panel m-b30  p-a20 bg-white shadow">
                                    <div class="wt-list-single-amenities">
                                    	<div class="m-b30 text-left">
                                            <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',31)->first()->custom_text }}</h4>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>
                                            <ul class="wt-single-amenities-list clearfix  equal-wraper">
                                                @foreach ($listing->listingAminities as $aminity)
                                                <li class="equal-col">
                                                	<div class="amen-outer"><div class="ameni-icon"> <span class="features-icon"><i class="{{ $aminity->aminity->icon }}"></i></span></div> <strong> {{ $aminity->aminity->aminity }}</strong></div>
                                                </li>
                                                @endforeach
                                            </ul>
                                    </div>
                                </div>
                             <!-- Amenities End-->
                             @endif


                             @if ($listing->listingVideos->count()>0)
                             <input type="hidden" value="{{ $listing->listingVideos->count() }}" id="videoSliderQty">
                             <!--Video-->
                            	<div class="wt-list-panel m-b30  p-a20 bg-white shadow">
                                    <div class="m-b30 text-left">
                                        <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',19)->first()->custom_text }}</h4>
                                        <div class="wt-separator sep-gradient-light"></div>
                                    </div>
                                    <div class="list-single-gallery-slider1 mfp-gallery owl-carousel owl-btn-vertical-center">
                                        @foreach ($listing->listingVideos as $video)
                                            <div class="item">
                                                <div class="list-single-gallery-slide-wrap ">
                                                    @php
                                                        $video_id=explode("=",$video->video_link);
                                                    @endphp
                                                    <div class="list-single-gallery-slide-thum"
                                                    style="background-image:url(https://img.youtube.com/vi/{{ $video_id[1] }}/0.jpg)"></div>
                                                    <div class="list-single-gallery-slide-overlay"></div>
                                                    <a class="mfp-video video-play-btn" href="{{ $video->video_link }}">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            <!--Video -->
                            @endif


                            <!-- Location -->
                                <div  class="wt-list-panel m-b30  p-a20 bg-white shadow ">
                                    <div class="m-b30 text-left">
                                        <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',32)->first()->custom_text }}</h4>
                                        <div class="wt-separator sep-gradient-light"></div>
                                    </div>
                                    <div class="wt-list-single-map">
                                        {!! $listing->google_map_embed_code !!}
                                   </div>
                                </div>
                            <!-- Location End-->
                            @if ($reviews->where('status',1)->count() >0)
                             <!--Review-->
                            	<div id="wt-list-provider-reviews" class="wt-list-panel m-b30  p-a20 bg-white shadow">
                                    @if ($reviews->where('status',1)->count() >0)
                                    <div class="m-b30 text-left">
                                        <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',9)->first()->custom_text }}</h4>
                                        <div class="wt-separator sep-gradient-light"></div>
                                    </div>
                                        @php
                                            $qty=$reviews->where('status',1)->count();
                                            $total=$reviews->where('status',1)->sum('rating');
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
                                    <div class="review-overview clearfix">
                                        <div class="review-rate-box">
                                            <span class="rating-rate-box-total">{{ sprintf("%.1f", $reviewPoint) }}</span>
                                            <span class="rating-rate-box-percent">{{ $websiteLang->where('id',33)->first()->custom_text }} 5.0</span>
                                            <div class="star-Rating-input">
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
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="wt-list-single-comment">
                                        <ul class="wt-single-filter-list">
                                            @foreach ($reviews as $review)
                                            <li class="comment">
                                                <div class="comment-body bg-orange-light">
                                                    <div class="comment-meta">
                                                        <div class="comment-by m-b10">{{ $review->user->name }}</div>
                                                        <div class="comment-date">{{ $review->created_at->format('M d,Y') }}</div>
                                                    </div>
                                                    <div class="ratting">
                                                        <div class="wt-reviews-star text-yellow">
                                                            @for ($i = 1; $i <=5 ; $i++)
                                                                @if ($i <= $review->rating)
                                                                <i class="fa fa-star"></i>
                                                                @else
                                                                <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endfor


                                                        </div>
                                                    </div>
                                                    <div class="comment-author">
                                                        <img class="avatar photo" src="{{ $review->user->image ? asset($review->user->image) : asset($default_image->image) }}">
                                                    </div>
                                                    <p>{{ $review->comment }}</p>

                                                </div>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>

                                    @auth
                                    @php
                                    $authUser=Auth::guard('web')->user();
                                @endphp
                                @if ($listing->user_id !=$authUser->id)
                                 <!--Review-->
                            	<div id="wt-list-provider-reviews" class="wt-list-panel m-b30  p-a20 bg-white shadow">
                                    <div class="comment-reply-wrap">
                                        <div class="m-b30 text-left">
                                            <h4 class="comment-reply-title sf-pro-title" id="reply-title">{{ $websiteLang->where('id',45)->first()->custom_text }}</h4>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>
                                        <form class="comment-form" method="post" action="{{ route('user.store-review') }}">
                                            @csrf
                                        	<div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group wt-input-icon">
                                                            <div class="input-group">
                                                                <i class="input-group-addon fa fa-star"></i>
                                                                <select name="rating" id="" class="form-control">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                               </div>
                                           </div>

                                           <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                            <div class="comment-form-comment">
                                                <div class="form-group wt-input-icon">
                                                    <div class="input-group">
                                                        <i class="input-group-addon fa fa-pencil v-align-t "></i>
                                                        <textarea placeholder="{{ $websiteLang->where('id',46)->first()->custom_text }}" aria-required="true" rows="8" cols="45" name="comment" id="comment" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-submit m-t10">
                                                <button class="site-button-secondry site-btn-effect" type="submit">{{ $websiteLang->where('id',456)->first()->custom_text }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                                    @endauth
                                </div>
                            <!--Review-->

                            @else
                                @auth
                                @php
                                    $authUser=Auth::guard('web')->user();
                                @endphp
                                @if ($listing->user_id !=$authUser->id)
                                 <!--Review-->
                            	<div id="wt-list-provider-reviews" class="wt-list-panel m-b30  p-a20 bg-white shadow">
                                    <div class="comment-reply-wrap">
                                        <div class="m-b30 text-left">
                                            <h4 class="comment-reply-title sf-pro-title" id="reply-title">{{ $websiteLang->where('id',45)->first()->custom_text }}</h4>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>
                                        <form class="comment-form" method="post" action="{{ route('user.store-review') }}">
                                            @csrf
                                        	<div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group wt-input-icon">
                                                            <div class="input-group">
                                                                <i class="input-group-addon fa fa-star"></i>
                                                                <select name="rating" id="" class="form-control">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                               </div>
                                           </div>

                                           <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                            <div class="comment-form-comment">
                                                <div class="form-group wt-input-icon">
                                                    <div class="input-group">
                                                        <i class="input-group-addon fa fa-pencil v-align-t "></i>
                                                        <textarea placeholder="{{ $websiteLang->where('id',46)->first()->custom_text }}" aria-required="true" rows="8" cols="45" name="comment" id="comment" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-submit m-t10">
                                                <button class="site-button-secondry site-btn-effect" type="submit">{{ $websiteLang->where('id',456)->first()->custom_text }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                                @endauth
                            <!--Review-->
                            @endif
                        </div>

                        	<div class="col-lg-4 col-md-12">

                            <!-- Opening Hour-->
                                @php
                                    $isSchedules=App\ListingSchedule::where(['listing_id'=>$listing->id,'status'=>1])->get();
                                @endphp
                                @if ($isSchedules->count() >0)
                                <div class="wt-list-panel  p-a20 bg-white m-b30 shadow">
                                    <div class="wt-list-single-about-detail">
                                    	<div class="m-b30 text-left">
                                            <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',34)->first()->custom_text }}</h4>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>
                                        <ul class="list-unstyled wt-list-working-hours m-b0">
                                            @foreach ($isSchedules as $isSchedule)
                                                <li><span><i class="fa fa-circle"></i>{{ $isSchedule->day->custom_day }}</span><span>{{ $isSchedule->start_time." - ".$isSchedule->end_time }}</span></li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>

                                @endif
                             <!-- Opening Hour End-->


                             <!-- Get in touch-->
                                <div class="wt-list-panel bg-white p-a20 m-b30 shadow">
                                    <div class="wt-list-single-about-detail">
                                    	<div class="m-b30 text-left">
                                            <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',36)->first()->custom_text }}</h4>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>

                                        <div class="wt-list-single-message-box">
                                             <form id="listingAuthContactForm">
                                                @csrf
                                             	<div class="form-group">
                                             		<input aria-required="true" size="30" value="{{ old('name') }}" name="name"  type="text" class="form-control" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }} *">
                                                </div>
                                                <input type="hidden" name="user_type" value="{{ $listing->user_type }}">
                                                @if ($listing->user_type==1)
                                                <input type="hidden" name="admin_id" value="{{ $listing->admin_id }}">
                                                @else
                                                <input type="hidden" name="user_id" value="{{ $listing->user_id }}">
                                                @endif

                                             	<div class="form-group">
                                             		<input aria-required="true" size="30" value="{{ old('email') }}" name="email"  type="text" class="form-control" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }} *">
                                                </div>
                                             	<div class="form-group">
                                             		<input class="form-control" type="text" placeholder="{{ $websiteLang->where('id',39)->first()->custom_text }} " name="phone" value="{{ old('phone') }}">
                                                </div>
                                                <div class="form-group">
                                             		<input class="form-control" type="text" placeholder="{{ $websiteLang->where('id',40)->first()->custom_text }} *" name="subject" value="{{ old('subject') }}">
                                                </div>

                                             	<div class="form-group">
                                             		<textarea class="form-control" name="message" placeholder="{{ $websiteLang->where('id',41)->first()->custom_text }} *" rows="4" cols="40">{{ old('message') }}</textarea>
                                                </div>
                                                @if($contactSetting->allow_captcha==1)
                                                    <div class="form-group">
                                                        <div class="g-recaptcha" data-sitekey="{{ $contactSetting->captcha_key }}"></div>
                                                    </div>

                                                @endif
                                            <div class="text-center m-t20">
                                                <button id="listingAuthorContctBtn" class="site-button-secondry site-btn-effect" type="button"> <i id="listcontact-spinner" class="loading-icon fa fa-spin fa-spinner mr-3 d-none"></i> {{ $websiteLang->where('id',42)->first()->custom_text }}</button>
                                            </div>
                                        </form>
                                        </div>

                                    </div>
								</div>
                             <!-- Get in touch End-->


                             @if ($similarListings->count() > 0)
                             <!-- Similar Listing-->
                                <div class="wt-list-panel  bg-white p-a20 m-b30 shadow">
                                    <div class="wt-list-single-about-detail">
                                    	<div class="m-b30 text-left">
                                            <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',43)->first()->custom_text }}</h4>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>

                                        <div class="wt-similar-listing">

                                            @foreach ($similarListings->take(5) as $similarListing)

                                                @if ($similarListing->expired_date==null)
                                                    <div class="wt-similar-listing-box clearfix">
                                                        <div class="wt-similar-listing-media">
                                                            <img src="{{ $similarListing->thumbnail_image ? asset($similarListing->thumbnail_image) : ''}}" alt="">
                                                        </div>
                                                        <div class="wt-similar-listing-info">
                                                            <div class="wt-similar-listing-header">
                                                                <a href="{{ route('listing.show',$similarListing->slug) }}"><h6 class="wt-similar-listing-title">{{ $similarListing->title }}</h6></a>
                                                            </div>
                                                            <div class="wt-similar-listing-meta">
                                                                <ul>
                                                                    <li class="wt-similar-listing-date">{{ $similarListing->created_at->format('M d, Y') }}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($similarListing->expired_date> date('Y-m-d'))
                                                    <div class="wt-similar-listing-box clearfix">
                                                        <div class="wt-similar-listing-media">
                                                            <img src="{{ $similarListing->thumbnail_image ? asset($similarListing->thumbnail_image) : ''}}" alt="">
                                                        </div>
                                                        <div class="wt-similar-listing-info">
                                                            <div class="wt-similar-listing-header">
                                                                <a href="{{ route('listing.show',$similarListing->slug) }}"><h6 class="wt-similar-listing-title">{{ $similarListing->title }}</h6></a>
                                                            </div>
                                                            <div class="wt-similar-listing-meta">
                                                                <ul>
                                                                    <li class="wt-similar-listing-date">{{ $similarListing->created_at->format('M d, Y') }}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                             <!-- Similar Listing End-->
                             @endif

                             @if ($recentListings->count()>0)

                             <!-- Recently Added -->
                                <div class="wt-list-panel  p-a20 bg-white m-b30 shadow">
                                    <div class="wt-list-single-about-detail">
                                    	<div class="m-b30 text-left">
                                            <h4 class="wt-list-panel-title m-t0">{{ $websiteLang->where('id',44)->first()->custom_text }}</h4>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>

                                        @foreach ($recentListings->where('status',1) as $recentListing)
                                        @if ($recentListing->expired_date==null)
                                            <div class="listing-cat-box m-b30">
                                                <div class="listing-cat-media"><img src="{{ $recentListing->thumbnail_image ? asset($recentListing->thumbnail_image) : "" }}" alt=""></div>
                                                <span class="listing-category-name color-lebel clr-voilet"><a href="{{ route('listings',['category_slug'=>$recentListing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $recentListing->listingCategory->name }}</a>
                                                </span>
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
                                                            <a href="{{ route('user.add.to.wishlist',$recentListing->id) }}" class="listing-cat-preview">
                                                                <i class="fa fa-heart fill-add-to-fav "></i>
                                                            </a>
                                                        </li>
                                                        @endguest

                                                        <li>
                                                            <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".preview-place-{{ $recentListing->id }}">
                                                                <i class="fa fa-eye "></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="listing-cat-text">
                                                    <div class="listing-logo-outer d-flex justify-content-between">
                                                        <div class="listing-place-logo"><img src="{{ $recentListing->logo ? asset($recentListing->logo) : '' }}" alt=""></div>

                                                        @if ($recentListing->listingSchedule->count()> 0)
                                                            @php

                                                                $today=date('l');
                                                                $today=$days->where('day',$today)->first();
                                                                $schedule=$recentListing->listingSchedule->where('day_id',$today->id)->first();
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
                                                                @else
                                                                    <div class="listing-place-timing"><span class="color-lebel clr-red">{{ $websiteLang->where('id',455)->first()->custom_text }}</span></div>
                                                                @endif
                                                            @else

                                                            <div class="listing-place-timing"><span class="color-lebel clr-red">{{ $websiteLang->where('id',455)->first()->custom_text }}</span></div>
                                                            @endif


                                                            @else
                                                                <div class="listing-place-timing"><span class="color-lebel clr-red">{{ $websiteLang->where('id',455)->first()->custom_text }}</span></div>
                                                            @endif
                                                    </div>

                                                    @if ($recentListing->reviews->where('status',1)->count() > 0)

                                                    @php
                                                        $qty=$recentListing->reviews->where('status',1)->count();
                                                        $total=$recentListing->reviews->where('status',1)->sum('rating');
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


                                                    <h4 class="listing-place-name"><a href="{{ route('listing.show',$recentListing->slug) }}">{{ $recentListing->title }}</a></h4>
                                                    <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $recentListing->address }}</span>
                                                </div>
                                            </div>
                                        @elseif($recentListing->expired_date> date('Y-m-d'))
                                        <div class="listing-cat-box m-b30">
                                            <div class="listing-cat-media"><img src="{{ $recentListing->thumbnail_image ? asset($recentListing->thumbnail_image) : "" }}" alt=""></div>
                                            <span class="listing-category-name color-lebel clr-voilet"><a href="{{ route('listings',['category_slug'=>$recentListing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $recentListing->listingCategory->name }}</a>
                                            </span>
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
                                                        <a href="{{ route('user.add.to.wishlist',$recentListing->id) }}" class="listing-cat-preview">
                                                            <i class="fa fa-heart fill-add-to-fav "></i>
                                                        </a>
                                                    </li>
                                                    @endguest

                                                    <li>
                                                        <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".preview-place-{{ $recentListing->id }}">
                                                            <i class="fa fa-eye "></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="listing-cat-text">
                                                <div class="listing-logo-outer d-flex justify-content-between">
                                                    <div class="listing-place-logo"><img src="{{ $recentListing->logo ? asset($recentListing->logo) : '' }}" alt=""></div>

                                                    @if ($recentListing->listingSchedule->count()> 0)
                                                        @php

                                                            $today=date('l');
                                                            $today=$days->where('day',$today)->first();
                                                            $schedule=$recentListing->listingSchedule->where('day_id',$today->id)->first();
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
                                                            @else
                                                                <div class="listing-place-timing"><span class="color-lebel clr-red">{{ $websiteLang->where('id',455)->first()->custom_text }}</span></div>
                                                            @endif
                                                        @else

                                                        <div class="listing-place-timing"><span class="color-lebel clr-red">{{ $websiteLang->where('id',455)->first()->custom_text }}</span></div>
                                                        @endif


                                                        @else
                                                            <div class="listing-place-timing"><span class="color-lebel clr-red">{{ $websiteLang->where('id',455)->first()->custom_text }}</span></div>
                                                        @endif
                                                </div>

                                                @if ($recentListing->reviews->where('status',1)->count() > 0)

                                                @php
                                                    $qty=$recentListing->reviews->where('status',1)->count();
                                                    $total=$recentListing->reviews->where('status',1)->sum('rating');
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


                                                <h4 class="listing-place-name"><a href="{{ route('listing.show',$recentListing->slug) }}">{{ $recentListing->title }}</a></h4>
                                                <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $recentListing->address }}</span>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach



                                    </div>
                                </div>
                             <!-- Recently Added End-->
                             @endif
                            </div>
                      </div>

                </div>
            </div>



            {{-- claime modal box --}}

<div class="modal fade claime-modal" role="dialog">
    <div class="modal-dialog">
        <!-- MODAL CONTENT-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="text-center text-center">{{ $websiteLang->where('id',459)->first()->custom_text }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="claimeFormId" action="{{ route('send-claim') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('id',37)->first()->custom_text }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('id',38)->first()->custom_text }} <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('id',457)->first()->custom_text }} <span class="text-danger">*</span></label>
                        <textarea required name="comment" class="form-control" cols="30" rows="5"></textarea>
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                    </div>
                    <div class="login-btn-bx text-right">

                        <button type="button" class="site-button-secondry  site-button-gradient" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>

                        <button id="claimSubmitBtn" type="button" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',460)->first()->custom_text }}</button>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


{{-- end claime modal box --}}


        </div>
        <!-- CONTENT END -->

        <script>
            (function($) {
            "use strict";
            $(document).ready(function () {
                $("#listingAuthorContctBtn").on('click',function(e) {

                    // project demo mode check
                    var isDemo="{{ env('PROJECT_MODE') }}"
                    var demoNotify="{{ env('NOTIFY_TEXT') }}"
                    if(isDemo==0){
                        toastr.error(demoNotify);
                        return;
                    }
                    // end

                    e.preventDefault();
                    $("#listcontact-spinner").removeClass('d-none')
                    $("#listingAuthorContctBtn").addClass('custom-opacity')
                    $("#listingAuthorContctBtn").attr('disabled',true);
                    $("#listingAuthorContctBtn").removeClass('site-btn-effect')

                    $.ajax({
                        url: "{{ route('user.contact.message') }}",
                        type:"post",
                        data:$('#listingAuthContactForm').serialize(),
                        success:function(response){
                            if(response.success){
                                $("#listingAuthContactForm").trigger("reset");
                                toastr.success(response.success)
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }
                            if(response.error){
                                toastr.error(response.error)
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')

                            }
                        },
                        error:function(response){
                            if(response.responseJSON.errors.name){
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')

                                toastr.error(response.responseJSON.errors.name[0])

                            }

                            if(response.responseJSON.errors.email){
                                toastr.error(response.responseJSON.errors.email[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')

                            }

                            if(response.responseJSON.errors.phone){
                                toastr.error(response.responseJSON.errors.phone[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }

                            if(response.responseJSON.errors.subject){
                                toastr.error(response.responseJSON.errors.subject[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }

                            if(response.responseJSON.errors.message){
                                toastr.error(response.responseJSON.errors.message[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }

                            if(response.responseJSON.errors.g-recaptcha-response){
                                toastr.error(response.responseJSON.errors.g-recaptcha-response[0])
                                $("#listcontact-spinner").addClass('d-none')
                                $("#listingAuthorContctBtn").removeClass('custom-opacity')
                                $("#listingAuthorContctBtn").attr('disabled',false);
                                $("#listingAuthorContctBtn").addClass('site-btn-effect')
                            }


                        }

                    });


                })



                $("#claimSubmitBtn").on('click',function(e) {

                    // project demo mode check
                    var isDemo="{{ env('PROJECT_MODE') }}"
                    var demoNotify="{{ env('NOTIFY_TEXT') }}"
                    if(isDemo==0){
                        toastr.error(demoNotify);
                        return;
                    }
                    // end

                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('send-claim') }}",
                        type:"post",
                        data:$('#claimeFormId').serialize(),
                        success:function(response){
                            if(response.success){
                                $(".claime-modal").modal('hide');
                                $("#claimeFormId").trigger("reset");
                                toastr.success(response.success)
                            }
                            if(response.error){
                                toastr.error(response.error)
                            }
                        },
                        error:function(response){
                            if(response.responseJSON.errors.email){
                                toastr.error(response.responseJSON.errors.email[0])
                            }

                            if(response.responseJSON.errors.name){
                                toastr.error(response.responseJSON.errors.name[0])
                            }

                            if(response.responseJSON.errors.comment){
                                toastr.error(response.responseJSON.errors.comment[0])
                            }


                        }

                    });


                })

            });

            })(jQuery);
        </script>
@endsection


