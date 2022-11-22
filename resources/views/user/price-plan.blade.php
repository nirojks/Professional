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
                        <h2 class="text-white">{{ $menus->where('id',5)->first()->navbar }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $menus->where('id',5)->first()->navbar }}</li>
                        </ul>
                    </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- SECTION CONTENTG START -->



    @php
        $package_section=$sections->where('id',1)->first();
        $listingPackages=$listingPackages->take($package_section->content_quantity);
    @endphp
    @if ($package_section->show_homepage==1)
    <!-- PRICING TABLE SECTION START -->
    <div class="section-full p-t80 p-b50 bg-white">
        <div class="container">
            <!-- TITLE START-->
            <div class="section-head text-center">
                <span class="wt-separator-icon"><i class="{{ $package_section->icon }}"></i></span>
                <h2>{{ $package_section->header }}</h2>
                <div class="wt-separator sep-gradient-light"></div>
                <p>{{ $package_section->description }}</p>
            </div>
            <!-- TITLE END-->
            <div class="section-content">
                <div class="pricingtable-row m-b30">
                    <div class="row d-flex justify-content-center">
                        @foreach ($listingPackages as $index=> $listingPackage)
                            <div class="col-lg-4 col-md-6 col-sm-12 m-b100">
                                <div class="pricingtable-wrapper pricingtable-highlight-outer">
                                    <div class="pricingtable-inner pricingtable-highlight dot2-left-top-img">
                                        <div class="pricing-table-top-section">
                                            <div class="pricingtable-title">
                                                <h4>{{ $listingPackage->package_name }}</h4>
                                            </div>

                                            @php
                                                $unlimited=$websiteLang->where('id',425)->first()->custom_text;
                                            @endphp

                                            <div class="pricingtable-price">
                                                <span class="pricingtable-bx"><sup class="pricingtable-sign">{{ $currency->currency_icon }}</sup>{{ $listingPackage->price }}</span>
                                                <span class="pricingtable-type">{{ $listingPackage->number_of_days == -1 ? $unlimited : $listingPackage->number_of_days }} {{ $websiteLang->where('id',14)->first()->custom_text }}</span>
                                            </div>

                                        </div>
                                        <ul class="pricingtable-features">
                                            <li>{{ $listingPackage->number_of_listing==-1 ? $unlimited : $listingPackage->number_of_listing  }} {{ $websiteLang->where('id',15)->first()->custom_text }}</li>
                                            @if ($listingPackage->number_of_days != -1)
                                            <li>{{ $listingPackage->number_of_days }} {{ $websiteLang->where('id',16)->first()->custom_text }}</li>
                                            @else
                                            <li>{{ $unlimited }} {{ $websiteLang->where('id',16)->first()->custom_text }}</li>
                                            @endif

                                            <li>{{ $listingPackage->number_of_aminities== -1 ? $unlimited : $listingPackage->number_of_aminities }} {{ $websiteLang->where('id',17)->first()->custom_text }}</li>
                                            <li>{{ $listingPackage->number_of_photo == -1 ? $unlimited : $listingPackage->number_of_photo }} {{ $websiteLang->where('id',18)->first()->custom_text }}</li>
                                            <li>{{ $listingPackage->number_of_video ==-1 ? $unlimited : $listingPackage->number_of_video }} {{ $websiteLang->where('id',19)->first()->custom_text }}</li>
                                            @if ($listingPackage->is_featured ==1)
                                            <li>{{ $websiteLang->where('id',20)->first()->custom_text }}</li>
                                            <li>{{ $listingPackage->number_of_feature_listing == -1 ? $unlimited : $listingPackage->number_of_feature_listing }} {{ $websiteLang->where('id',21)->first()->custom_text }}</li>
                                            @else
                                            <li>{{ $websiteLang->where('id',441)->first()->custom_text }}</li>
                                            <li>0 {{ $websiteLang->where('id',21)->first()->custom_text }}</li>
                                            @endif
                                        </ul>

                                        <div class="pricingtable-footer">
                                            @auth
                                                <a href="javascript:;" data-toggle="modal" data-target=".confirmation-modal-{{ $listingPackage->id }}" class="site-button-secondry  site-button-gradient">{{ $websiteLang->where('id',13)->first()->custom_text }}</a>
                                            @else
                                                <a href="javascript:;" data-toggle="modal" data-target=".sign-in-modal" class="site-button-secondry  site-button-gradient">{{ $websiteLang->where('id',13)->first()->custom_text }}</a>
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
    $subscribe_section=$sections->where('id',2)->first();
@endphp
@if ($subscribe_section->show_homepage==1)


    <!-- NEWSLETTER SECTION START -->
    <div class="section-full p-t0 p-b80">
        <div class="container ">

            <div class="section-content site-bg-secondry radius-md bg-no-repeat bg-top-right home-subscribe-bg">
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
                                            <span class="input-group-text"><i class="fa fa-envelope-o "></i></span>
                                        </div>
                                        <input id="subscribe_email" type="text" class="form-control" name="email" placeholder="{{ $websiteLang->where('id',24)->first()->custom_text }}">
                                        <div class="input-group-append">
                                            <button type="button" id="subscribeBtn" class="input-group-text nl-search-btn text-white site-bg-primary"> <i id="subscribe-spinner" class="loading-icon fa fa-spin fa-spinner d-none mr-2"></i> {{ $websiteLang->where('id',23)->first()->custom_text }}</button>
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
    <!-- SECTION CONTENT END -->

</div>
<!-- CONTENT END -->
@endsection
