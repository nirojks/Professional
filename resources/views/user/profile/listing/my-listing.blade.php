@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',69)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ $websiteLang->where('id',69)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',69)->first()->custom_text }}</span></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',79)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 bg-white">
                @php
                    $currentlyActive=0;
                    $currentlyInActive=0;

                    if($activeQty != -2){
                        if($activeQty==-1){
                            foreach ($listings as $index => $listing) {
                                if($listing->status==1){
                                    $currentlyActive +=1;
                                }
                            }
                        }else{
                            foreach ($listings->take($activeQty) as $index => $listing) {
                                if($listing->status==1){
                                    $currentlyActive +=1;
                                }
                            }
                        }
                    }

                    if($activeQty == -2){
                        $currentlyInActive=$listings->count()-$currentlyActive;
                    }else if($activeQty==-1){
                        foreach ($listings as $index => $listing) {
                            if($listing->status==0){
                                $currentlyInActive +=1;
                            }
                        }
                    }else{
                        $activeListings=$listings->take($activeQty)->where('status',1);
                        $arr=array();
                        foreach ($activeListings as $index => $listing) {
                            $arr[]=$listing->id;
                        }

                        $pendingListings=$allListings->whereNotIn('id',$arr);

                        foreach ($pendingListings as $index => $listing) {
                            $currentlyInActive +=1;
                        }
                    }

                @endphp
                <div class="dashboard-my-listing-tabs dashboard-badge">
                    <div class="wt-tabs tabs-default">
                        <ul class="nav nav-tabs">
                            <li><a class="active" data-toggle="tab" href="#web-design-1"> {{ $websiteLang->where('id',140)->first()->custom_text }} <span class="nav-tag green">{{ $currentlyActive }}</span></a></li>
                            <li><a  data-toggle="tab" href="#graphic-design-1">{{ $websiteLang->where('id',141)->first()->custom_text }} <span class="nav-tag blue">{{ $currentlyInActive }}</span></a></li>
                        </ul>
                        <div class="tab-content">


                            <div id="web-design-1" class="tab-pane active">
                                @if ($currentlyActive==0)
                                <h3 class="text-danger">{{ $websiteLang->where('id',396)->first()->custom_text }}</h3>
                                @else
                                @php
                                    $colorId=1;
                                @endphp
                                @if ($activeQty ==-2)
                                    <h3 class="text-danger">{{ $websiteLang->where('id',396)->first()->custom_text }}</h3>

                                @elseif($activeQty==-1)
                                    @foreach ($listings->where('status',1) as $index => $listing)
                                        <div class="wt-listing-container dashboard-my-listing">
                                            <div class="list-item-container m-b30 clearfix">
                                                <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }})">
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
                                                            <li>
                                                                <a href="{{ route('user.add.to.wishlist',$listing->id) }}" class="listing-cat-preview">
                                                                    <i class="fa fa-heart-o fill-add-to-fav "></i>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="listing-place-logo"><img src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt=""></div>
                                                </div>

                                                <div class="list-category-content">
                                                    <div class="listing-logo-outer">

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
                                                    @endif
                                                    <h4 class="listing-place-name"><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }} </a></h4>
                                                    <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listing->address }}</span>
                                                    <div class="list-category-label">
                                                        @if ($listing->is_featured==1)
                                                            <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                                        @endif

                                                        @if ($listing->verified==1)
                                                        <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="list-category-edit text-right">
                                                        <a href="{{ route('user.listing.schedule.index',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-plus"></i> {{ $websiteLang->where('id',83)->first()->custom_text }} </a>
                                                        <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a>
                                                        <a href="{{ route('user.listing.edit',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-edit"></i> {{ $websiteLang->where('id',84)->first()->custom_text }} </a>
                                                        @if($listing->posts->count()>0)
                                                        <a href="{{ route('user.post.index',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-list"></i> {{ $websiteLang->where('id',527)->first()->custom_text }} </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $colorId++;
                                        @endphp
                                    @endforeach
                                @else
                                    @foreach ($listings->take($activeQty)->where('status',1) as $index => $listing)
                                        <div class="wt-listing-container dashboard-my-listing">
                                            <div class="list-item-container m-b30 clearfix">
                                                <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }})">
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
                                                            <li>
                                                                <a href="{{ route('user.add.to.wishlist',$listing->id) }}" class="listing-cat-preview">
                                                                    <i class="fa fa-heart-o fill-add-to-fav "></i>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="listing-place-logo"><img src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt=""></div>
                                                </div>

                                                <div class="list-category-content">
                                                    <div class="listing-logo-outer">

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
                                                    @endif
                                                    <h4 class="listing-place-name"><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }} </a></h4>
                                                    <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listing->address }}</span>
                                                    <div class="list-category-label">
                                                        @if ($listing->is_featured==1)
                                                            <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                                        @endif

                                                        @if ($listing->verified==1)
                                                        <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="list-category-edit text-right">
                                                        <a href="{{ route('user.listing.schedule.index',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-plus"></i> {{ $websiteLang->where('id',83)->first()->custom_text }} </a>
                                                        <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a>
                                                        <a href="{{ route('user.listing.edit',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-edit"></i> {{ $websiteLang->where('id',84)->first()->custom_text }} </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $colorId++;
                                        @endphp
                                    @endforeach
                                @endif
                                @endif



                            </div>

                            <div id="graphic-design-1" class="tab-pane">
                                @if ($currentlyInActive==0)
                                    <h3 class="text-danger">{{ $websiteLang->where('id',396)->first()->custom_text }}</h3>
                                @else
                                @php
                                    $colorId=1;
                                @endphp
                                @if ($activeQty ==-2)
                                    @foreach ($listings as $index =>  $listing)
                                        <div class="wt-listing-container dashboard-my-listing">
                                            <div class="list-item-container m-b30 clearfix">
                                                <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }})">

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
                                                            <li>
                                                                <a href="{{ route('user.add.to.wishlist',$listing->id) }}" class="listing-cat-preview">
                                                                    <i class="fa fa-heart-o fill-add-to-fav "></i>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="listing-place-logo"><img src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt=""></div>
                                                </div>

                                                <div class="list-category-content">
                                                    <div class="listing-logo-outer">

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
                                                    @endif
                                                    <h4 class="listing-place-name"><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }} </a></h4>
                                                    <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listing->address }}</span>
                                                    <div class="list-category-label">
                                                        @if ($listing->is_featured==1)
                                                            <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                                        @endif

                                                        @if ($listing->verified==1)
                                                        <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="list-category-edit text-right">
                                                        <a href="{{ route('user.listing.schedule.index',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-plus"></i> {{ $websiteLang->where('id',83)->first()->custom_text }} </a>
                                                        <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a>
                                                        <a href="{{ route('user.listing.edit',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-edit"></i> {{ $websiteLang->where('id',84)->first()->custom_text }} </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $colorId++;
                                        @endphp
                                    @endforeach
                                @elseif($activeQty==-1)
                                    @foreach ($listings->where('status',0) as $index =>  $listing)
                                        <div class="wt-listing-container dashboard-my-listing">
                                            <div class="list-item-container m-b30 clearfix">
                                                <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }})">

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
                                                            <li>
                                                                <a href="{{ route('user.add.to.wishlist',$listing->id) }}" class="listing-cat-preview">
                                                                    <i class="fa fa-heart-o fill-add-to-fav "></i>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="listing-place-logo"><img src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt=""></div>
                                                </div>

                                                <div class="list-category-content">
                                                    <div class="listing-logo-outer">

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
                                                    @endif
                                                    <h4 class="listing-place-name"><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }} </a></h4>
                                                    <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listing->address }}</span>
                                                    <div class="list-category-label">
                                                        @if ($listing->is_featured==1)
                                                            <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                                        @endif

                                                        @if ($listing->verified==1)
                                                        <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="list-category-edit text-right">
                                                        <a href="{{ route('user.listing.schedule.index',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-plus"></i> {{ $websiteLang->where('id',83)->first()->custom_text }} </a>
                                                        <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a>
                                                        <a href="{{ route('user.listing.edit',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-edit"></i> {{ $websiteLang->where('id',84)->first()->custom_text }} </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $colorId++;
                                        @endphp
                                    @endforeach
                                @else
                                    @php
                                        $activeListings=$listings->take($activeQty)->where('status',1);
                                        $arr=array();
                                        foreach ($activeListings as $index => $listing) {
                                            $arr[]=$listing->id;
                                        }

                                        $pendingListings=$allListings->whereNotIn('id',$arr);
                                    @endphp

                                    @foreach ($pendingListings as $index =>  $listing)
                                        <div class="wt-listing-container dashboard-my-listing">
                                            <div class="list-item-container m-b30 clearfix">
                                                <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }})">

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
                                                            <li>
                                                                <a href="{{ route('user.add.to.wishlist',$listing->id) }}" class="listing-cat-preview">
                                                                    <i class="fa fa-heart-o fill-add-to-fav "></i>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="listing-place-logo"><img src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt=""></div>
                                                </div>

                                                <div class="list-category-content">
                                                    <div class="listing-logo-outer">

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
                                                    @endif
                                                    <h4 class="listing-place-name"><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }} </a></h4>
                                                    <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $listing->address }}</span>
                                                    <div class="list-category-label">
                                                        @if ($listing->is_featured==1)
                                                            <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                                        @endif

                                                        @if ($listing->verified==1)
                                                        <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="list-category-edit text-right">
                                                        <a href="{{ route('user.listing.schedule.index',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-plus"></i> {{ $websiteLang->where('id',83)->first()->custom_text }} </a>
                                                        <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a>
                                                        <a href="{{ route('user.listing.edit',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-edit"></i> {{ $websiteLang->where('id',84)->first()->custom_text }} </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $colorId++;
                                        @endphp
                                    @endforeach
                                @endif
                                @endif
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>

    </div>

</div>
@endsection
