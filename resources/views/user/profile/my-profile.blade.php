@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',72)->first()->custom_text }}</title>
@endsection

@section('user-dashboard')

<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ $websiteLang->where('id',72)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',72)->first()->custom_text }}</span></div>
        </div>



        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',89)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">
                <form method="POST" action="{{ route('user.update.profile') }}" enctype="multipart/form-data">
                    @csrf
                <div class="row">

                      <div class="col-lg-12 col-md-12">
                            <div class="dashboard-profile-section clearfix">
                                <div class="dashboard-profile-pic">
                                    <div class="dashboard-profile-photo">
                                        <img src="{{ $user->image ? asset($user->image) : asset($defaultProfile) }}" alt="{{ $websiteLang->where('id',147)->first()->custom_text }}">
                                        <div class="upload-btn-wrapper">
                                          <button class="site-button-secondry site-btn-effect button-sm">{{ $websiteLang->where('id',146)->first()->custom_text }}</button>
                                          <input type="file" name="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="dasboard-profile-form overflow-hide">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>{{ $websiteLang->where('id',37)->first()->custom_text }}</label>
                                                <div class="ls-inputicon-box">
                                                    <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                                                    <i class="fs-input-icon sl-icon-user "></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>{{ $websiteLang->where('id',39)->first()->custom_text }}</label>
                                                <div class="ls-inputicon-box">
                                                    <input class="form-control" name="phone" type="text" value="{{ $user->phone }}">
                                                    <i class="fs-input-icon sl-icon-phone"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>{{ $websiteLang->where('id',38)->first()->custom_text }}</label>
                                                <div class="ls-inputicon-box">
                                                    <input class="form-control" name="email" type="email" value="{{ $user->email }}" readonly>
                                                    <i class="fs-input-icon fa fa-envelope-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ $websiteLang->where('id',145)->first()->custom_text }}</label>
                                                <textarea class="form-control" name="about" rows="3">{{ $user->about }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',106)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="facebook" value="{{ $user->facebook }}" type="text" >
                                    <i class="fs-input-icon fa fa-facebook"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',107)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="twitter" type="text" value="{{ $user->twitter }}">
                                    <i class="fs-input-icon fa fa-twitter"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',108)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="linkedin" value="{{ $user->linkedin }}" type="text" >
                                    <i class="fs-input-icon fa fa-linkedin"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',109)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="whatsapp" type="text" value="{{ $user->whatsapp }}">
                                    <i class="fs-input-icon fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',110)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="instagram" type="text" value="{{ $user->instagram }}">
                                    <i class="fs-input-icon fa fa-instagram"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',111)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="pinterest" type="text" value="{{ $user->pinterest }}">
                                    <i class="fs-input-icon fa fa-pinterest"></i>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',113)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="youtube" type="text" value="{{ $user->youtube }}">
                                    <i class="fs-input-icon fa fa-youtube"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',55)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="address" type="text" value="{{ $user->address }}">
                                    <i class="fs-input-icon sl-icon-location"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',93)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="website" type="text" value="{{ $user->website }}">
                                    <i class="fs-input-icon sl-icon-globe"></i>
                                </div>
                            </div>
                        </div>



                       <div class="col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                            </div>
                        </div>

                </div>
               </form>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',148)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 bg-white">
                <form method="POST" action="{{ route('user.update.password') }}">
                    @csrf
                <div class="row">


                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',149)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="current_password" type="password">
                                    <i class="fs-input-icon sl-icon-lock "></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',150)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="password" type="password">
                                    <i class="fs-input-icon sl-icon-lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',67)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="password_confirmation" type="password" placeholder="">
                                    <i class="fs-input-icon sl-icon-lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                            </div>
                        </div>

                </div>
              </form>
            </div>
        </div>

        <div class="panel panel-default mt-4">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',438)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 bg-white">
                <form method="POST" action="{{ route('user.update.profile.banner') }}" enctype="multipart/form-data">
                    @csrf
                <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('id',283)->first()->custom_text }}</label>
                                @if ($user->banner_image)
                                <div class="user-my-profile-banner-image">
                                    <img src="{{ asset($user->banner_image) }}" alt="">
                                </div>
                                 @else
                                 <div class="user-my-profile-banner-image">
                                    <img src="{{ asset($image->image) }}" alt="">
                                </div>
                                @endif

                                <label class="mt-1">{{ $websiteLang->where('id',168)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control-file wt-form-control" name="banner_image" type="file">
                                </div>
                            </div>
                        </div>




                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="text-left">
                                <button type="submit" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                            </div>
                        </div>

                </div>
              </form>
            </div>
        </div>




    </div>

</div>

@endsection
