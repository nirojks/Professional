@php
    $setting=App\Setting::first();
    $topbar_contact=App\ContactUs::first();
    $menus=App\Navigation::all();
    $customPages=App\CustomPage::where('status',1)->get();
@endphp



<!DOCTYPE html>
@if ($setting->text_direction=='RTL')
<html lang="en" dir="rtl">
@else
<html lang="en">
@endif
<head>

    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{  $setting->favicon ? asset( $setting->favicon) : '' }}" />

    @yield('title')
    @yield('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap.min.css') }}">
     <!-- Custom fonts for this template-->
     <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

     <link rel="stylesheet" type="text/css" href="{{ asset('user/css/fontawesome/css/font-awesome.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/range-slider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/m-custom-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/loader.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/select2/select2.min.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.css') }}">
    @if ($setting->text_direction=="RTL")
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/rtl.css') }}">
    @endif


    <link rel="stylesheet" href="{{ asset('user/css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/flaticon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/cluster-css.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/custom-preloader.css') }}">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">



    <script src="{{ asset('user/js/jquery-2.2.0.min.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    {{-- select2 css and js --}}
    <script src="{{ asset('user/select2/select2.min.js') }}"></script>

    <script src="{{ asset('user/js/sweetalert.min.js') }}"></script>

</head>

<body>
<div class="page-wraper">
       <!-- HEADER START -->
       <header class="site-header header-style-2 mobile-sider-drawer-menu">

        <div class="top-bar site-bg-primary">
            <div class="container">

                <div class="d-flex justify-content-between">
                    <div class="wt-topbar-left d-flex flex-wrap align-content-center">
                        <ul class="wt-topbar-info e-p-bx site-text-secondry">
                            @if ($topbar_contact->topbar_email)
                                <li><i class="fa fa-envelope text-white"></i>{{ $topbar_contact->topbar_email }}</li>
                            @endif

                            @if ($topbar_contact->topbar_phone)
                            <li><i class="fa fa-phone text-white"></i>{{ $topbar_contact->topbar_phone }}</li>
                            @endif


                        </ul>
                    </div>

                    <div class="wt-topbar-right d-flex flex-wrap align-content-center">
                        <ul class="social-bx list-inline d-flex site-text-white">
                            @if ($topbar_contact->facebook)
                            <li>
                                <a href="{{ $topbar_contact->facebook }}" class="fab fa-facebook"></a>
                            </li>
                            @endif
                           @if ($topbar_contact->twitter)
                            <li>
                                <a href="{{ $topbar_contact->twitter }}" class="fab fa-twitter"></a>
                            </li>
                           @endif
                           @if ($topbar_contact->linkedin)
                           <li>
                            <a href="{{ $topbar_contact->linkedin }}" class="fab fa-linkedin"></a>
                        </li>
                           @endif
                           @if ($topbar_contact->youtube)
                            <li>
                                <a href="{{ $topbar_contact->youtube }}" class="fab fa-youtube"></a>
                            </li>
                           @endif
                           @if ($topbar_contact->instagram)
                            <li>
                                <a href="{{ $topbar_contact->instagram }}" class="fab fa-instagram"></a>
                            </li>
                           @endif

                        </ul>

                        @php
                            $isLogin=$menus->where('id',12)->first();
                            $dashboard=$menus->where('id',10)->first();
                        @endphp
                        @if ($isLogin->status==1)

                        @guest
                        <ul class="list-unstyled e-p-bx login-controls">

                            @if ($setting->text_direction=="RTL")
                            <li><a href="javascript:;" class="sign-up-btn" data-toggle="modal" data-target=".sign-in-modal">{{ $isLogin->navbar }} <i class="sl-icon-logout m-l10"></i></a></li>
                            @else
                            <li><a href="javascript:;" class="sign-up-btn" data-toggle="modal" data-target=".sign-in-modal"><i class="sl-icon-login m-r10"></i>{{ $isLogin->navbar }}</a></li>
                            @endif



                        </ul>
                        @else
                        <ul class="list-unstyled e-p-bx login-controls">
                            <li><a href="{{ route('user.dashboard') }}" class="sign-up-btn"><i class="sl-icon-login m-r10"></i>{{ $dashboard->navbar }}</a></li>
                        </ul>
                        @endguest

                        @endif


                    </div>
                </div>

            </div>
        </div>

        <div class=" main-bar-wraper  navbar-expand-lg">
            <div class="main-bar">
                <div class="container">
                    <div class="logo-header">
                        <div class="logo-header-inner logo-header-one">
                            <a href="{{ route('home') }}">
                                <img src="{{ $setting->logo ? asset($setting->logo) : '' }}" alt="" />
                            </a>
                        </div>
                    </div>
                    <!-- NAV Toggle Button -->

                    <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar icon-bar-first"></span>
                        <span class="icon-bar icon-bar-two"></span>
                        <span class="icon-bar icon-bar-three"></span>
                    </button>

                    @php
                        $isNewListing=$menus->where('id',9)->first();
                    @endphp
                    @if ($isNewListing->status==1)
                    @auth
                    <a href="{{ route('user.create.listing') }}">
                        <div class="extra-nav header-2-nav">
                            <div class="extra-cell">
                                <div class="addlisting-btn-block">
                                    <div class="addlisting-btn-content">
                                        <div class="addlisting-btn"><i class="sl-icon-plus"></i>{{ $isNewListing->navbar }}</div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @else
                    <div class="extra-nav header-2-nav" data-toggle="modal" data-target=".sign-in-modal">
                        <div class="extra-cell">
                            <div class="addlisting-btn-block">
                                <div class="addlisting-btn-content">
                                    <div class="addlisting-btn"><i class="sl-icon-plus"></i>{{ $isNewListing->navbar }}</div>


                                </div>
                            </div>
                        </div>
                    </div>
                    @endauth

                    @endif

                    <!-- MAIN Vav -->
                    <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-center">

                        <ul class=" nav navbar-nav">
                            @php
                                $isHomePage=$menus->where('id',1)->first();
                            @endphp
                            @if ($isHomePage->status==1)
                                <li><a href="{{ route('home') }}">{{ $isHomePage->navbar }}</a></li>
                            @endif

                            @php
                                $isListing=$menus->where('id',2)->first();
                            @endphp
                           @if ($isListing->status==1)
                           <li><a href="{{ route('listings',['page_type'=>'list_view']) }}">{{ $isListing->navbar }}</a></li>
                           @endif



                           @php
                                $isPages=$menus->where('id',3)->first();
                            @endphp
                           @if ($isPages->status==1)
                            <li>
                                <a href="javascript:;">{{ $isPages->navbar }}</a>
                                <ul class="sub-menu">
                                    @php
                                        $isAboutUs=$menus->where('id',4)->first();
                                    @endphp
                                    @if ($isAboutUs->status==1)
                                    <li><a href="{{ route('about.us') }}">{{ $isAboutUs->navbar }}</a></li>
                                    @endif

                                    @php
                                        $isPricing=$menus->where('id',5)->first();
                                    @endphp
                                    @if ($isPricing->status==1)
                                    <li><a href="{{ route('pricing.plan') }}">{{ $isPricing->navbar }}</a></li>
                                    @endif

                                    @php
                                        $isListingCategory=$menus->where('id',6)->first();
                                    @endphp
                                    @if ($isListingCategory->status==1)
                                    <li><a href="{{ route('listing.category') }}">{{ $isListingCategory->navbar }}</a></li>
                                    @endif

                                    @if ($customPages->count()>0)
                                        @foreach ($customPages as $customPage)
                                            <li><a href="{{ route('custom.page',$customPage->slug) }}">{{ $customPage->page_name }}</a></li>
                                        @endforeach

                                    @endif
                                </ul>
                            </li>
                           @endif

                           @php
                                $isBlog=$menus->where('id',7)->first();
                            @endphp
                            @if ($isBlog->status==1)
                            <li><a href="{{ route('blog') }}">{{ $isBlog->navbar }}</a></li>
                            @endif

                            @php
                                $isPost=$menus->where('id',17)->first();
                            @endphp
                            @if ($isPost->status==1)
                            <li><a href="{{ route('post') }}">{{ $isPost->navbar }}</a></li>
                            @endif

                            @php
                                $isContact=$menus->where('id',8)->first();
                            @endphp
                            @if ($isContact->status==1)
                            <li><a href="{{ route('contact.us') }}">{{ $isContact->navbar }}</a></li>
                            @endif

                        </ul>

                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- HEADER END -->
