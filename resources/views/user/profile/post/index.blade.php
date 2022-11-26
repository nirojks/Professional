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
                <h4 class="panel-tittle m-a0">{{ __('Posts') }}</h4>
            </div>

            <div class="panel-body wt-panel-body p-a20 bg-white">
            <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',528)->first()->custom_text }}</a>

                <div class="dashboard-my-listing-tabs dashboard-badge">
                    <div class="wt-tabs tabs-default">
                       
                        <div class="tab-content">


                            <div id="web-design-1" class="tab-pane active">
                               
                                    @foreach ($posts as $index => $listing)
                                        <div class="wt-listing-container dashboard-my-listing">
                                            <div class="list-item-container posts-list m-b30 clearfix">
                                                <h4 class="listing-place-name"><a href="{{ route('listing.show',$listing->slug) }}">{{ $listing->title }} </a></h4>

                                                <div class="list-image-box post-image bg-cover bg-no-repeat" style="background-image:url({{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }})">
                                                   
                                                   
                                                    <!-- <img src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt=""> -->
                                                </div>
                                                <p class="post-text">Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p> Read more..

                                                <div class="list-category-content">
                                                    <div class="listing-logo-outer">
                                                    </div>
                                                    
                                                    <div class="list-category-edit text-right">
                                                        <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.delete',$listing->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a>
                                                        <a href="{{ route('user.listing.edit',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-edit"></i> {{ $websiteLang->where('id',84)->first()->custom_text }} </a>
                                                        <a href="{{ route('user.post.index',$listing->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-list"></i> {{ __('Listings') }} </a>
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
        </div>

    </div>

</div>
@endsection
