@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')
    <div class="page-content">
        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center"    style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
            <div class="overlay-main bg-black opacity-05"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="text-white">{{ $menus->where('id',2)->first()->navbar }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                        <div>
                            <ul class="wt-breadcrumb breadcrumb-style-2">
                                <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                                <li>{{ $menus->where('id',2)->first()->navbar }}</li>
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
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12">
                        <div class="shadow p-a30 side-bar-opposite">
                            <div class="wt-listing-filter-bar2">


                                <div class="row">
                                    <div class="col-md-6 col-sm-6">

                                        @php
                                            $search_url = request()->fullUrl();
                                            $get_url = substr($search_url, strpos($search_url, "?") + 1);

                                            $grid_url='';
                                            $list_url='';
                                            $isSortingId=0;

                                            $page_type=request()->get('page_type') ;
                                            if($page_type=='list_view'){
                                                $grid_url=str_replace('page_type=list_view','page_type=grid_view',$search_url);
                                                $list_url=str_replace('page_type=list_view','page_type=list_view',$search_url);
                                            }else if($page_type=='grid_view'){
                                                $grid_url=str_replace('page_type=grid_view','page_type=grid_view',$search_url);
                                                $list_url=str_replace('page_type=grid_view','page_type=list_view',$search_url);
                                            }


                                            if(request()->has('sorting_id')){
                                                $isSortingId=1;
                                            }

                                        @endphp

                                        <div class="wt-listviewbtn-wrap">
                                            <a href="{{ $list_url }}" class="wt-listview-btn"><i class="fa fa-list site-text-secondry"></i></a>

                                            <a href="{{ $grid_url }}" class="wt-listview-btn"><i class="fa fa-th-large site-text-secondry"></i></a>
                                        </div>
                                    </div>
                                    @if ($isSortingId==1)
                                    <div class="col-md-6 col-sm-6">
                                        <div class="wt-sortby-wrap">
                                            <div class="wt-sortby-select">
                                                <select class="selectpicker bs-select-hidden" id="sortingId">
                                                <option {{ request()->get('sorting_id')==6 ? 'selected' : '' }} value="6"> {{ $websiteLang->where('id',62)->first()->custom_text }}</option>
                                                    <option {{ request()->get('sorting_id')==1 ? 'selected' : '' }} value="1">{{ $websiteLang->where('id',63)->first()->custom_text }}</option>
                                                    <option {{ request()->get('sorting_id')==2 ? 'selected' : '' }} value="2">{{ $websiteLang->where('id',10)->first()->custom_text }}</option>
                                                    <option {{ request()->get('sorting_id')==3 ? 'selected' : '' }} value="3">{{ $websiteLang->where('id',11)->first()->custom_text }}</option>
                                                    <option {{ request()->get('sorting_id')==4 ? 'selected' : '' }} value="4">{{ $websiteLang->where('id',64)->first()->custom_text }}</option>
                                                    <option {{ request()->get('sorting_id')==5 ? 'selected' : '' }} value="5">{{ $websiteLang->where('id',65)->first()->custom_text }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="col-md-6 col-sm-6">
                                    <div class="wt-sortby-wrap">
                                        <div class="wt-sortby-select">
                                            <select class="selectpicker bs-select-hidden" id="sortingId">
                                            <option value="6"> {{ $websiteLang->where('id',62)->first()->custom_text }}</option>
                                                <option value="1">{{ $websiteLang->where('id',63)->first()->custom_text }}</option>
                                                <option value="2">{{ $websiteLang->where('id',10)->first()->custom_text }}</option>
                                                <option value="3">{{ $websiteLang->where('id',11)->first()->custom_text }}</option>
                                                <option value="4">{{ $websiteLang->where('id',64)->first()->custom_text }}</option>
                                                <option value="5">{{ $websiteLang->where('id',65)->first()->custom_text }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                </div>
                            </div>
                            <div class="wt-searchReasult-divider"></div>

                            <div class="wt-listing-container" id="showSearchResult">
                                @if ($page_type=='grid_view')
                                    @if ($listingAminities->count()>0)
                                    <div class="row">
                                        @php
                                            $colorId=1;
                                        @endphp
                                        @foreach ($listingAminities as $index => $listingAminity)
                                            @if ($listingAminity->listing->expired_date==null)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="listing-cat-box m-b30">
                                                    <div class="listing-cat-media"><img src="{{ asset($listingAminity->listing->thumbnail_image) }}" alt=""></div>
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
                                                    <span class="listing-category-name color-lebel {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listingAminity->listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listingAminity->listing->listingCategory->name }}</a></span>
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
                                                                    <a href="{{ route('user.add.to.wishlist',$listingAminity->listing->id) }}" class="listing-cat-preview">
                                                                        <i class="fa fa-heart fill-add-to-fav "></i>
                                                                    </a>
                                                                </li>
                                                                @endguest
                                                                <li>
                                                                    <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".preview-place-{{ $listingAminity->listing->id }}">
                                                                        <i class="fa fa-eye "></i>
                                                                    </a>
                                                                </li>
                                                        </ul>
                                                    </div>
                                                    <div class="listing-cat-text">
                                                        <div class="listing-logo-outer d-flex justify-content-between">
                                                            <div class="listing-place-logo"><img src="{{ asset($listingAminity->listing->logo) }}" alt=""></div>
                                                            @if ($listingAminity->listing->listingSchedule->count()> 0)
                                                                @php

                                                                    $today=date('l');
                                                                    $today=$days->where('day',$today)->first();
                                                                    $schedule=$listingAminity->listing->listingSchedule->where('day_id',$today->id)->first();
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
                                                        @if ($listingAminity->listing->reviews->where('status',1)->count() > 0)

                                                            @php
                                                                $qty=$listingAminity->listing->reviews->where('status',1)->count();
                                                                $total=$listingAminity->listing->reviews->where('status',1)->sum('rating');
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
                                                        <h4 class="listing-place-name"><a href="{{ route('listing.show',$listingAminity->listing->slug) }}">{{ $listingAminity->listing->title }}</a></h4>
                                                        <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listingAminity->listing->address }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @elseif($listingAminity->listing->expired_date > date('Y-m-d'))
                                            <div class="col-lg-6 col-md-6">
                                                <div class="listing-cat-box m-b30">
                                                    <div class="listing-cat-media"><img src="{{ asset($listingAminity->listing->thumbnail_image) }}" alt=""></div>
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
                                                    <span class="listing-category-name color-lebel {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listingAminity->listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listingAminity->listing->listingCategory->name }}</a></span>
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
                                                                    <a href="{{ route('user.add.to.wishlist',$listingAminity->listing->id) }}" class="listing-cat-preview">
                                                                        <i class="fa fa-heart fill-add-to-fav "></i>
                                                                    </a>
                                                                </li>
                                                                @endguest
                                                                <li>
                                                                    <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".preview-place-{{ $listingAminity->listing->id }}">
                                                                        <i class="fa fa-eye "></i>
                                                                    </a>
                                                                </li>
                                                        </ul>
                                                    </div>
                                                    <div class="listing-cat-text">
                                                        <div class="listing-logo-outer d-flex justify-content-between">
                                                            <div class="listing-place-logo"><img src="{{ asset($listingAminity->listing->logo) }}" alt=""></div>
                                                            @if ($listingAminity->listing->listingSchedule->count()> 0)
                                                                @php

                                                                    $today=date('l');
                                                                    $today=$days->where('day',$today)->first();
                                                                    $schedule=$listingAminity->listing->listingSchedule->where('day_id',$today->id)->first();
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
                                                        @if ($listingAminity->listing->reviews->count() > 0)

                                                            @php
                                                                $qty=$listingAminity->listing->reviews->where('status',1)->count();
                                                                $total=$listingAminity->listing->reviews->where('status',1)->sum('rating');
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
                                                        <h4 class="listing-place-name"><a href="{{ route('listing.show',$listingAminity->listing->slug) }}">{{ $listingAminity->listing->title }}</a></h4>
                                                        <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listingAminity->listing->address }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @php
                                                $colorId++;
                                            @endphp

                                        @endforeach
                                    </div>
                                    @else
                                        <h4 class="text-danger py-5 text-center">{{ $websiteLang->where('id',396)->first()->custom_text }}</h4>
                                    @endif
                            @else
                                @if ($listingAminities->count()>0)
                                @php
                                    $colorId=1;
                                @endphp
                                @foreach ($listingAminities as $index => $listingAminity)
                                @if ($listingAminity->listing->expired_date==null)
                                <div class="wt-listing-container">
                                    <div class="list-item-container m-b30 clearfix">
                                        <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ $listingAminity->listing->thumbnail_image ? asset($listingAminity->listing->thumbnail_image) : '' }})">
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
                                            <span class="listing-category-name color-lebel {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listingAminity->listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listingAminity->listing->listingCategory->name }}</a></span>
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
                                                        <a href="{{ route('user.add.to.wishlist',$listingAminity->listing->id) }}" class="listing-cat-preview">
                                                            <i class="fa fa-heart fill-add-to-fav "></i>
                                                        </a>
                                                    </li>
                                                    @endguest
                                                    <li>
                                                        <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".preview-place-{{ $listingAminity->listing->id }}">
                                                            <i class="fa fa-eye "></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="listing-place-logo"><img src="{{ $listingAminity->listing->logo ? asset($listingAminity->listing->logo) : '' }}" alt=""></div>
                                        </div>

                                        <div class="list-category-content">
                                            <div class="listing-logo-outer">
                                                @if ($listingAminity->listing->listingSchedule->count()> 0)
                                                    @php

                                                        $today=date('l');
                                                        $today=$days->where('day',$today)->first();
                                                        $schedule=$listingAminity->listing->listingSchedule->where('day_id',$today->id)->first();
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

                                            @if ($listingAminity->listing->reviews->where('status',1)->count() > 0)

                                                @php
                                                    $qty=$listingAminity->listing->reviews->where('status',1)->count();
                                                    $total=$listingAminity->listing->reviews->where('status',1)->sum('rating');
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
                                            <h4 class="listing-place-name"><a href="{{ route('listing.show',$listingAminity->listing->slug) }}">{{ $listingAminity->listing->title }}</a></h4>
                                            <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listingAminity->listing->address }}</span>
                                            <div class="list-category-label">
                                                @if ($listingAminity->listing->is_featured==1)
                                                    <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                                @endif

                                                @if ($listingAminity->listing->verified==1)
                                                <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($listingAminity->listing->expired_date > date('Y-m-d'))
                                <div class="wt-listing-container">
                                    <div class="list-item-container m-b30 clearfix">
                                        <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ $listingAminity->listing->thumbnail_image ? asset($listingAminity->listing->thumbnail_image) : '' }})">
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
                                            <span class="listing-category-name color-lebel {{ $color }}"><a href="{{ route('listings',['category_slug'=>$listingAminity->listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $listingAminity->listing->listingCategory->name }}</a></span>
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
                                                        <a href="{{ route('user.add.to.wishlist',$listingAminity->listing->id) }}" class="listing-cat-preview">
                                                            <i class="fa fa-heart fill-add-to-fav "></i>
                                                        </a>
                                                    </li>
                                                    @endguest
                                                    <li>
                                                        <a href="javascript:;" class="listing-cat-preview" data-toggle="modal" data-target=".preview-place-{{ $listingAminity->listing->id }}">
                                                            <i class="fa fa-eye "></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="listing-place-logo"><img src="{{ $listingAminity->listing->logo ? asset($listingAminity->listing->logo) : '' }}" alt=""></div>
                                        </div>

                                        <div class="list-category-content">
                                            <div class="listing-logo-outer">
                                                @if ($listingAminity->listing->listingSchedule->count()> 0)
                                                    @php

                                                        $today=date('l');
                                                        $today=$days->where('day',$today)->first();
                                                        $schedule=$listingAminity->listing->listingSchedule->where('day_id',$today->id)->first();
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

                                            @if ($listingAminity->listing->reviews->where('status',1)->count() > 0)

                                                @php
                                                    $qty=$listingAminity->listing->reviews->where('status',1)->count();
                                                    $total=$listingAminity->listing->reviews->where('status',1)->sum('rating');
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
                                            <h4 class="listing-place-name"><a href="{{ route('listing.show',$listingAminity->listing->slug) }}">{{ $listingAminity->listing->title }}</a></h4>
                                            <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listingAminity->listing->address }}</span>
                                            <div class="list-category-label">
                                                @if ($listingAminity->listing->is_featured==1)
                                                    <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                                @endif

                                                @if ($listingAminity->listing->verified==1)
                                                <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @php
                                    $colorId++;
                                @endphp
                                @endforeach
                                @else
                                    <h4 class="text-danger py-5 text-center">{{ $websiteLang->where('id',396)->first()->custom_text }}</h4>
                                @endif
                            @endif
                            </div>

                            <div class="pagination-bx clearfix">
                                  {{ $listingAminities->links() }}
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-lg-12 col-md-12">
                        <div class="side-bar right shadow p-a30">
                            <div class="wt-listing-sidebar-form ">
                                <form action="{{ route('search-listing') }}" method="GET">
                                    <div class="form-group filter-destination">
                                        <input type="text"  class="form-control" name="search" placeholder="{{ $websiteLang->where('id',1)->first()->custom_text }}" value="{{ request()->has('search') ? request()->get('search') : '' }}">
                                    </div>
                                    <div class="form-group filter-choose-category">

                                        <select class="form-control select2" name="category_id">
                                            <option value="">{{ $websiteLang->where('id',2)->first()->custom_text }}</option>
                                            @foreach ($listingCategories as $category)
                                                @if (request()->has('category_id'))
                                                <option {{ request()->get('category_id') == $category->id ? 'selected' : ''  }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @elseif (isset($categoryId))
                                                    <option {{ $categoryId == $category->id ? 'selected' : ''  }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group filter-address-inputs">
                                        <select class="form-control select2" name="location">
                                            <option value="">{{ $websiteLang->where('id',3)->first()->custom_text }}</option>
                                            @foreach ($locationsForSearch as $location)
                                                @if (request()->has('location'))
                                                <option {{ request()->get('location') == $location->id ? 'selected' : ''  }} value="{{ $location->id }}">{{ $location->location }}</option>
                                                @elseif (isset($locationId))
                                                <option {{ $locationId == $location->id ? 'selected' : ''  }} value="{{ $location->id }}">{{ $location->location }}</option>
                                                @else
                                                <option value="{{ $location->id }}">{{ $location->location }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <div class="form-group filter-address-inputs">
                                        <div class="form-group">
                                            <div>Longitude/Latitude</div>
                                            <input id="keyword-value" type="text" class="form-control" name="longlat" value="{{ request()->has('longlat') ? request()->get('longlat') : '' }}" />
                                        </div>
                                    </div>

                                    <div class="form-group filter-address-inputs">
                                        <div style="position: relative;">
                                            <div class="form-group" style="margin-bottom:0;">
                                                <input id="input-keyword" type="text" name="maplocation" class="form-control" placeholder="Choose Location" value="{{ request()->has('maplocation') ? request()->get('maplocation') : '' }}" />
                                            </div>
                                            <div id="keyword-search-box">
                                                <div class="list-group">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group filter-address-inputs">
                                        <div class="form-group">
                                            <select class="form-control select2" name="radius">
                                                <option value="">Radius</option>
                                                @if (request()->has('radius'))
                                                    <option {{ request()->get('radius') ? 'selected' : ''  }} value="{{ request()->get('radius') }}">{{ request()->get('radius') }} KM</option>
                                                @else
                                                    <option value="1">1 KM</option>
                                                    <option value="5">5 KM</option>
                                                    <option value="10">10 KM</option>
                                                    <option value="50">50 KM</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <script>
                                        function debounce(func, timeout = 300) {
                                            let timer;
                                            return (...args) => {
                                                clearTimeout(timer);
                                                timer = setTimeout(() => {
                                                    func.apply(this, args);
                                                }, timeout);
                                            };
                                        }
        
                                        $('#input-keyword').on('keyup', debounce(function() {
                                            var settings = {
                                                "url": "/gmap/textsearch/" + $('#input-keyword').val().replace(' ', '-'),
                                                "method": "GET",
                                                "timeout": 0,
                                            };
                                            var keywordSearchBox = document.querySelector("#keyword-search-box .list-group");
        
                                            keywordSearchBox.innerHTML = '';
        
                                            if ($('#input-keyword').val().length == 0) {
                                                keywordSearchBox.style = '';
                                            }
        
        
                                            $.ajax(settings).done(function(response) {
                                                var data = JSON.parse(response);
                                                data.results.forEach(function(item) {
                                                    keywordSearchBox.innerHTML += `
                                                            <div style="cursor:pointer;" onclick="assignSearch('${item.geometry.location.lat},${item.geometry.location.lng}', '${item.name}, ${item.formatted_address}')" class="list-group-item list-group-item-action">
                                                                ${item.name}, ${item.formatted_address}    
                                                            </div>
                                                        `;
                                                });
                                                if ($('#input-keyword').val().length > 0) {
                                                    keywordSearchBox.style = 'height: 300px; overflow-y:scroll;';
                                                }
                                            });
                                        }));
        
                                        function assignSearch(e, i) {
                                            document.querySelector("#keyword-value").value = e;
                                            document.querySelector('#input-keyword').value = i;
                                            document.querySelector("#keyword-search-box .list-group").style="display: none;";
                                        }
                                    </script>

                                    <div class="form-group">
                                        <div class="text-left m-b30">
                                            <h4 class="widget-title">{{ $websiteLang->where('id',355)->first()->custom_text }}</h4>
                                            <div class="wt-separator sep-gradient-light"></div>
                                        </div>
                                        <div class="wt-filter-features-wrap">
                                            @php
                                                $searhAminities=request()->get('aminity') ;

                                            @endphp

                                            @if (request()->has('aminity'))
                                                @foreach ($aminities as $aminity)
                                                    @php
                                                        $isChecked=false;
                                                    @endphp
                                                    @foreach ($searhAminities as $searhAminity)
                                                        @if ($searhAminity==$aminity->id)
                                                            @php
                                                                $isChecked=true;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <div class="checkbox wt-radio-checkbox">
                                                        <input {{ $isChecked ? 'checked' : '' }} id="{{ $aminity->slug }}" name="aminity[]" value="{{ $aminity->id }}" type="checkbox">
                                                        <label for="{{ $aminity->slug }}">{{ $aminity->aminity }}</label>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach ($aminities as $aminity)
                                                    <div class="checkbox wt-radio-checkbox">
                                                        <input id="{{ $aminity->slug }}" name="aminity[]" value="{{ $aminity->id }}" type="checkbox">
                                                        <label for="{{ $aminity->slug }}">{{ $aminity->aminity }}</label>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>

                                    @php
                                        $page_type=request()->get('page_type') ;
                                    @endphp
                                    <input type="hidden" id="page_type" name="page_type" value="{{ $page_type }}">
                                   <div class="form-group">
                                           <button type="submit" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',4)->first()->custom_text }}</button>
                                   </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- SECTION CONTENT END  -->
    </div>
    <!-- CONTENT END -->


    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#sortingId").on("change",function(){
                $(".pagination-bx").addClass('d-none')
                var id=$(this).val();

                var isSortingId='<?php echo $isSortingId; ?>'
                var query_url='<?php echo $search_url; ?>';

                if(isSortingId==0){
                    var sorting_id="&sorting_id="+id;
                    query_url += sorting_id;
                }else{
                     var href = new URL(query_url);
                    href.searchParams.set('sorting_id', id);
                    query_url=href.toString()
                }

                window.location.href = query_url;
            })

        });

        })(jQuery);
    </script>





@endsection


