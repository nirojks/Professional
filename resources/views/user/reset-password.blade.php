@extends('layouts.user.layout')
@section('title')
    <title>{{ $menus->where('id',14)->first()->navbar }}</title>
@endsection
@section('user-content')

<!-- CONTENT START -->
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center"   style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="overlay-main bg-black opacity-05"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="text-white">{{ $menus->where('id',14)->first()->navbar }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $menus->where('id',14)->first()->navbar }}</li>
                        </ul>
                    </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

       <!-- GOOGLE MAP & CONTACT FORM -->
     <div class="section-full  p-t80 p-b80">
        <div class="section-content">
            <div class="container">
                <div class="contact-one   shadow radius-md   p-a30">
                    <!-- CONTACT FORM-->
                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6 m-b30">
                            <h3 class="text-center">{{ $menus->where('id',14)->first()->navbar }}</h3>
                            <form  method="post" action="{{ route('store.reset.password',$token) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <input name="email" type="text" class="form-control" value="{{ $user->email }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control" placeholder="{{ $websiteLang->where('id',61)->first()->custom_text }}">
                                         </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <input name="password_confirmation" type="password" class="form-control" placeholder="{{ $websiteLang->where('id',67)->first()->custom_text }}">
                                         </div>
                                    </div>
                                    @if($setting->allow_captcha==1)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ $setting->captcha_key }}"></div>
                                            </div>
                                        </div>
                                    @endif
                                   <div class="col-md-12">
                                        <button type="submit" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',66)->first()->custom_text }}</button>
                                    </div>

                                </div>
                           </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <!-- SECTION CONTENT END -->

</div>
<!-- CONTENT END -->

@endsection
