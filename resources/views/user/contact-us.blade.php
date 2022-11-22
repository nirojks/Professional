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
    <div class="wt-bnr-inr overlay-wraper bg-center"   style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="overlay-main bg-black opacity-05"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="text-white">{{ $menus->where('id',8)->first()->navbar }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $menus->where('id',8)->first()->navbar }}</li>
                        </ul>
                    </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->


    <!-- SECTION CONTENTG START -->
    <div class="section-full  p-t80">
        <div class="container">
            <!-- LOCATION BLOCK-->
            <div class="section-content">
                <div class="gmap-outline">
                    {!! $contact->map_embed_code !!}
                </div>
            </div>
        </div>

   </div>
       <!-- GOOGLE MAP & CONTACT FORM -->
     <div class="section-full  p-t80 p-b80">
        <div class="section-content">
            <div class="container">
                <div class="contact-one   shadow radius-md   p-a30">
                    <!-- CONTACT FORM-->
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12  m-b30">
                            <form  method="post" action="{{ route('contact.message') }}">
                                @csrf
                                <!-- TITLE START -->
                                <div class="section-head text-left">
                                    <h2 class="m-t0">{{ $websiteLang->where('id',36)->first()->custom_text }}</h2>
                                    <div class="wt-separator sep-gradient-light"></div>
                                </div>
                                <!-- TITLE END -->

                                <div class="row">
                                   <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }}" value="{{ old('name') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                           <input name="email" type="text" class="form-control" value="{{ old('email') }}" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input name="phone" type="text" class="form-control" value="{{ old('phone') }}" placeholder="{{ $websiteLang->where('id',39)->first()->custom_text }}">
                                         </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                             <input name="subject" type="text" class="form-control" value="{{ old('subject') }}" placeholder="{{ $websiteLang->where('id',40)->first()->custom_text }}">
                                         </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <textarea name="message" class="form-control" rows="4" placeholder="{{ $websiteLang->where('id',41)->first()->custom_text }}">{{ old('message') }}</textarea>
                                         </div>
                                    </div>
                                    @if($contactSetting->allow_captcha==1)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ $contactSetting->captcha_key }}"></div>
                                            </div>
                                        </div>

                                    @endif
                                   <div class="col-md-12">
                                        <button type="submit" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',42)->first()->custom_text }} </button>
                                    </div>

                                </div>
                           </form>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="contact-info">
                                <div class="contact-info-inner">

                                    <!-- TITLE START-->
                                    <div class="section-head text-left">
                                        <h2 class="m-t0">{{ $contact->header }}</h2>
                                        <div class="wt-separator sep-gradient-light"></div>
                                    </div>
                                    <!-- TITLE END-->
                                    <div class="contact-info-section contact-form-bg text-white">

                                        <div class="wt-icon-box-wraper left m-b30">
                                            <div class="icon-xs"><i class="fa fa-phone site-text-secondry"></i></div>
                                            <div class="icon-content">
                                                <h4 class="m-t0">{{ $websiteLang->where('id',39)->first()->custom_text }}</h4>
                                                <p>
                                                    {!! clean(nl2br($contact->phones)) !!}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="wt-icon-box-wraper left m-b30">
                                            <div class="icon-xs"><i class="fa fa-envelope site-text-secondry"></i></div>
                                            <div class="icon-content">
                                                <h4 class="m-t0">{{ $websiteLang->where('id',38)->first()->custom_text }}</h4>
                                                <p>{!! clean(nl2br($contact->emails)) !!}</p>
                                            </div>
                                        </div>

                                        <div class="wt-icon-box-wraper left">
                                            <div class="icon-xs"><i class="sl-icon-location site-text-secondry"></i></div>
                                            <div class="icon-content">
                                                <h4 class="m-t0">{{ $websiteLang->where('id',55)->first()->custom_text }}</h4>
                                                <p>{!! clean(nl2br($contact->address)) !!}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
