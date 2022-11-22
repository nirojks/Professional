@php
    $setting=App\Setting::first();
    $userInfo=Auth::guard('web')->user();
    $websiteLang=App\ManageText::all();
    $defaultImage=App\BannerImage::where('id',15)->first();
@endphp


@include('layouts.user.profile.header')
<body>

	<div class="page-wraper">

        <header id="header-admin-wrap" class="header-admin-fixed">

            <!-- Header Start -->
            <div id="header-admin">
                <div class="container">

                    <!-- Left Side Content -->
                    <div class="header-left">
                        <div class="nav-btn-wrap">
                            <a class="nav-btn-admin" id="sidebarCollapse">
                                <span class="sl-icon-arrow-left-circle"></span>
                            </a>
                        </div>
                    </div>
                    <!-- Left Side Content End -->
                    <!-- Right Side Content -->
                    <div class="header-right">
                        <ul class="header-widget-wrap">
                            <li class="header-widget">
								<div class="listing-user-outer dashboard-user-section">
                                	<div class="listing-user">
                                        <div class="user-name text-black"><span><img src="{{ $userInfo->image ? asset($userInfo->image) : asset($defaultImage->image) }}" alt=""></span>{{ $userInfo->name }}</div>
                                        <ul>
                                            <li><a href="{{ route('user.my-profile') }}"><i class="sl-icon-user "></i> {{ $websiteLang->where('id',72)->first()->custom_text }}</a></li>
                                            <li><a href="{{ route('user.create.listing') }}"><i class="sl-icon-layers"></i> {{ $websiteLang->where('id',70)->first()->custom_text }}</a></li>
                                            <li><a href="{{ route('user.review') }}"><i class="sl-icon-star "></i> {{ $websiteLang->where('id',9)->first()->custom_text }}</a></li>
                                            <li><a href="{{ route('logout') }}"><i class="sl-icon-logout "></i> {{ $websiteLang->where('id',74)->first()->custom_text }}</a></li>
                                        </ul>
                                    </div>
                               </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Right Side Content End -->

                </div>
            </div>
            <!-- Header End -->

        </header>

        <!-- Sidebar Holder -->
        <nav id="sidebar-admin-wraper">
            <div class="page-logo">
                <a href="{{ route('home') }}"><img src="{{ $setting->logo ? asset($setting->logo) : '' }}" alt="website logo"></a>
            </div>

            <div class="admin-nav">
                <ul class="">
                    <li class="{{ Route::is('user.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('user.dashboard') }}"><i class="sl-icon-speedometer"></i><span class="admin-nav-text">{{ $websiteLang->where('id',68)->first()->custom_text }}</span></a>
                    </li>

                    <li class="{{ Route::is('user.my.listing') || Route::is('user.listing.edit') || Route::is('user.listing.schedule.index') || Route::is('user.schedule.create') || Route::is('user.listing.schedule.edit') ? 'active' : '' }}">
                        <a href="{{ route('user.my.listing') }}"><i class="sl-icon-layers "></i><span class="admin-nav-text">{{ $websiteLang->where('id',69)->first()->custom_text }}</span></a>
                    </li>
                    <li class="{{ Route::is('user.create.listing') ? 'active' : '' }}">
                        <a href="{{ route('user.create.listing') }}"><i class="sl-icon-plus "></i><span class="admin-nav-text">{{ $websiteLang->where('id',70)->first()->custom_text }}</span></a>
                    </li>
                    <li class="{{ Route::is('user.review') ? 'active' : '' }}">
                        <a href="{{ route('user.review') }}"><i class="sl-icon-star "></i><span class="admin-nav-text">{{ $websiteLang->where('id',9)->first()->custom_text }}</span></a>
                    </li>
                    <li class="{{ Route::is('user.my-wishlist') ? 'active' : '' }}" >
                        <a href="{{ route('user.my-wishlist') }}"><i class="sl-icon-heart "></i><span class="admin-nav-text">{{ $websiteLang->where('id',71)->first()->custom_text }}</span></a>
                    </li>

                    <li class="{{ Route::is('user.my-profile') ? 'active' : '' }}">
                        <a href="{{ route('user.my-profile') }}"><i class="sl-icon-user "></i><span class="admin-nav-text">{{ $websiteLang->where('id',72)->first()->custom_text }}</span></a>
                    </li>
                    <li class="{{ Route::is('user.my-order') || Route::is('user.order.details') ? 'active' : '' }}">
                        <a href="{{ route('user.my-order') }}"><i class="sl-icon-doc "></i><span class="admin-nav-text">{{ $websiteLang->where('id',73)->first()->custom_text }}</span></a>
                    </li>
                    <li class="{{ Route::is('user.package') ? 'active' : '' }}">
                        <a href="{{ route('user.package') }}"><i class="sl-icon-doc "></i><span class="admin-nav-text">{{ $websiteLang->where('id',86)->first()->custom_text }}</span></a>
                    </li>

                    <li>
                        <a href="{{ route('logout') }}"><i class="sl-icon-logout "></i><span class="admin-nav-text">{{ $websiteLang->where('id',74)->first()->custom_text }}</span></a>
                    </li>

                </ul>
            </div>
        </nav>

        @yield('user-dashboard')


	</div>
@include('layouts.user.profile.footer')
