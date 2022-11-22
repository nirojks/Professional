@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',70)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">

        <form action="{{ route('user.post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ $websiteLang->where('id',528)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',70)->first()->custom_text }}</span></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',89)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 p-b0 bg-white m-b30">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >{{ $websiteLang->where('id',90)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="title" id="title" type="text" value="{{ old('title') }}">
                                    <i class="fs-input-icon fa fa-edit"></i>

                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >{{ $websiteLang->where('id',91)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" id="slug" name="slug" type="text" value="{{ old('slug') }}">
                                    <i class="fs-input-icon fa fa-edit"></i>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-12">
                            <div class="form-group city-outer-bx has-feedback">
                                <label>{{ $websiteLang->where('id',56)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <select class="wt-select-box selectpicker" name="listing_id" data-live-search="true" id="listing_id" data-bv-field="city">
                                        <option class="bs-title-option" value="">{{ $websiteLang->where('id',529)->first()->custom_text }}</option>
                                        @foreach ($listings as $listing)
                                        <option {{ old('listing_id')==$listing->id ? 'selected' : '' }} value="{{ $listing->id }}" class="bs-title-option" value="">{{ $listing->title }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fs-input-icon fa fa-edit custom-align"></i>


                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',121)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',121)->first()->custom_text }} <span class="text-danger">*</span></label>
                            <div class="ls-inputicon-box">
                                <input class="form-control-file wt-form-control" name="image" type="file">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',103)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">
                <div>
                    <label>{{ $websiteLang->where('id',103)->first()->custom_text }} <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="5" name="description">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>


        <div class="text-left">
            <button type="submit" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
        </div>
    </form>
    </div>

</div>



<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $("#title").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

        });

    })(jQuery);

    function convertToSlug(Text)
            {
                return Text
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-');
            }


</script>

@endsection
