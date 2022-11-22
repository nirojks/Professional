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
                            <h2 class="text-white">{{ $menus->where('id',6)->first()->navbar }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $menus->where('id',6)->first()->navbar }}</li>
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
                    @php
                        $colorId=1;
                    @endphp
                    @foreach ($listingCategories as $index => $category)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 m-b30">
                        <div class="featured-cat-box bg-cover bg-no-repeat v-icon-effect" style="background-image:url({{ url($category->image) }})">
                            <div class="featured-cat-text clearfix">
                                <div class="f-cat-icon {{ $category->icon }} v-icon"></div>
                                <div class="featured-cat-name-outer">
                                    <h4 class="featured-cat-name">{{ $category->name }}</h4>
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


                                        $activeListings=$category->listings->where('status',1);
                                        $qty=0;
                                        foreach ($activeListings as $key => $listing) {
                                            if($listing->expired_date==null){
                                                $qty+=1;
                                            }elseif($listing->expired_date > date('Y-m-d')){
                                                $qty+=1;
                                            }
                                        }

                                    @endphp

                                    <span class="featured-cat-user color-lebel {{ $color }}">{{ $qty }} {{ $websiteLang->where('id',56)->first()->custom_text }}</span>
                                </div>
                            </div>
                            <div class="featured-cat-overlay"></div>
                            <a href="{{ route('listings',['category_slug'=>$category->slug, 'page_type' => 'list_view']) }}" class="featured-cat-linking"></a>
                        </div>
                    </div>
                    @php
                        $colorId++;
                    @endphp
                    @endforeach
                </div>
            </div>

            {{ $listingCategories->links() }}
        </div>
        <!-- TOP ACTIVITIES SECTION START -->

        </div>






    </div>
    <!-- CONTENT END -->
@endsection
