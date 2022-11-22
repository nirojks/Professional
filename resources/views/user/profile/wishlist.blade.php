@extends('layouts.user.profile.layout')

@section('title')
    <title>{{ $websiteLang->where('id',71)->first()->custom_text }}</title>
@endsection

@section('user-dashboard')

 <!-- Page Content Holder -->
 <div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ $websiteLang->where('id',71)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',71)->first()->custom_text }}</span></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 bg-white">

                <div class="dashboard-my-listing-tabs dashboard-badge">
                        @php
                            $colorId=1;
                        @endphp
                        @foreach ($wishlists as $index => $wishlist)
                        @if ($wishlist->listing->expired_date==null)
                            <div class="wt-listing-container dashboard-my-listing">
                                <div class="list-item-container m-b30 clearfix">
                                    <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ asset($wishlist->listing->thumbnail_image) }})">

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

                                        <span class="listing-category-name color-lebel {{ $color }}"><a href="{{ route('listings',['category_slug'=>$wishlist->listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $wishlist->listing->listingCategory->name }}</a></span>
                                        <div class="listing-place-logo"><img src="{{ asset($wishlist->listing->logo) }}" alt=""></div>
                                    </div>

                                    <div class="list-category-content">
                                        <div class="listing-logo-outer">

                                            @if ($wishlist->listing->listingSchedule->count()> 0)
                                            @php

                                                $today=date('l');
                                                $today=$days->where('day',$today)->first();
                                                $schedule=$wishlist->listing->listingSchedule->where('day_id',$today->id)->first();
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
                                        @if ($wishlist->listing->reviews->count() > 0)

                                                            @php
                                                                $qty=$wishlist->listing->reviews->count();
                                                                $total=$wishlist->listing->reviews->sum('rating');
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
                                        <h4 class="listing-place-name"><a href="{{ route('listing.show',$wishlist->listing->slug) }}">{{ $wishlist->listing->title }}</a></h4>
                                        <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $wishlist->listing->address }}</span>
                                        <div class="list-category-label">
                                            @if ($wishlist->listing->is_featured==1)
                                                <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                            @endif

                                            @if ($wishlist->listing->verified==1)
                                                <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                            @endif
                                        </div>
                                        <div class="list-category-edit text-right">
                                            <a href="{{ route('user.delete.wishlist',$wishlist->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($wishlist->listing->expired_date > date('Y-m-d'))
                        <div class="wt-listing-container dashboard-my-listing">
                            <div class="list-item-container m-b30 clearfix">
                                <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ asset($wishlist->listing->thumbnail_image) }})">

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

                                    <span class="listing-category-name color-lebel {{ $color }}"><a href="{{ route('listings',['category_slug'=>$wishlist->listing->listingCategory->slug, 'page_type' => 'list_view']) }}">{{ $wishlist->listing->listingCategory->name }}</a></span>
                                    <div class="listing-place-logo"><img src="{{ asset($wishlist->listing->logo) }}" alt=""></div>
                                </div>

                                <div class="list-category-content">
                                    <div class="listing-logo-outer">

                                        @if ($wishlist->listing->listingSchedule->count()> 0)
                                        @php

                                            $today=date('l');
                                            $today=$days->where('day',$today)->first();
                                            $schedule=$wishlist->listing->listingSchedule->where('day_id',$today->id)->first();
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
                                    @if ($wishlist->listing->reviews->count() > 0)

                                                        @php
                                                            $qty=$wishlist->listing->reviews->count();
                                                            $total=$wishlist->listing->reviews->sum('rating');
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
                                    <h4 class="listing-place-name"><a href="{{ route('listing.show',$wishlist->listing->slug) }}">{{ $wishlist->listing->title }}</a></h4>
                                    <span class="listing-cat-address"><i class="sl-icon-location"></i>{{ $wishlist->listing->address }}</span>
                                    <div class="list-category-label">
                                        @if ($wishlist->listing->is_featured==1)
                                            <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                        @endif

                                        @if ($wishlist->listing->verified==1)
                                            <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                        @endif
                                    </div>
                                    <div class="list-category-edit text-right">
                                        <a href="{{ route('user.delete.wishlist',$wishlist->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a>
                                    </div>
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
        </div>

    </div>

@endsection
