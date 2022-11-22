@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',69)->first()->custom_text }}</title>
@endsection

@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <form action="{{ route('user.listing.update',$listing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ $websiteLang->where('id',69)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',69)->first()->custom_text }}</span></div>
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
                                    <input class="form-control wt-form-control" name="title" id="title" type="text" value="{{ $listing->title }}">
                                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                                    <i class="fs-input-icon fa fa-edit"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >{{ $websiteLang->where('id',91)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" id="slug" name="slug" type="text" value="{{ $listing->slug }}">
                                    <i class="fs-input-icon fa fa-edit"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group city-outer-bx has-feedback">
                                <label>{{ $websiteLang->where('id',92)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <select class="wt-select-box selectpicker" name="category" data-live-search="true" id="category" data-bv-field="city">
                                        <option class="bs-title-option" value="">{{ $websiteLang->where('id',119)->first()->custom_text }}</option>
                                        @foreach ($listingCategories as $category)
                                        <option {{ $listing->listing_category_id==$category->id ? 'selected' : '' }} value="{{ $category->id }}" class="bs-title-option" value="">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fs-input-icon fa fa-edit custom-align"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group city-outer-bx has-feedback">
                                <label>{{ $websiteLang->where('id',125)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <select class="wt-select-box selectpicker" name="location" data-live-search="true" id="location" data-bv-field="city">
                                        <option class="bs-title-option" value="">{{ $websiteLang->where('id',120)->first()->custom_text }}</option>
                                        @foreach ($locations as $location)
                                        <option {{ $listing->location_id==$location->id ? 'selected' : '' }} class="" value="{{ $location->id }}">{{ $location->location }}</option>
                                        @endforeach

                                    </select>
                                    <i class="fs-input-icon sl-icon-location custom-align"></i>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label >{{ $websiteLang->where('id',55)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="address" type="text" value="{{ $listing->address }}">
                                    <i class="fs-input-icon sl-icon-location"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',39)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="phone" type="text" value="{{ $listing->phone }}">
                                    <i class="fs-input-icon sl-icon-phone"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',38)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="email" type="text" value="{{ $listing->email }}">
                                    <i class="fs-input-icon fa fa-envelope-o"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>{{ $websiteLang->where('id',93)->first()->custom_text }}</label>
                                <div class="ls-inputicon-box">
                                    <input class="form-control wt-form-control" name="website" type="text" value="{{ $listing->website }}">
                                    <i class="fs-input-icon sl-icon-globe"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group city-outer-bx has-feedback">
                                <label>{{ $websiteLang->where('id',254)->first()->custom_text }} <span class="text-danger">*</span></label>
                                <div class="ls-inputicon-box">
                                    <textarea class="form-control" rows="5" name="google_map_embed_code">{{ $listing->google_map_embed_code }}</textarea>
                                    <i class="fs-input-icon sl-icon-location"></i>
                                </div>
                            </div>
                        </div>


                    </div>
            </div>
        </div>




        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <label for="">{{ $websiteLang->where('id',383)->first()->custom_text }}</label>
                        @if ($listing->listingImages->count()>0)
                        <table class="table-bordered">
                            @foreach ($listing->listingImages as $image)
                                <tr>
                                    <td width="90%"><img class="old_image_class" src="{{ $image->image ? asset($image->image) : '' }}" alt="" ></td>
                                    <td width="10%"><a href="{{ route('user.delete-listing-image',$image->id) }}" onclick="return confirm('{{ $notify }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                        <table class="table-bordered">
                            <tr>
                                <td><h5 class="text-danger text-center">{{ $websiteLang->where('id',384)->first()->custom_text }}</h5></td>
                            </tr>
                        </table>
                        @endif
                    </div>


                        <div class="col-lg-6 col-md-6">
                            <label for="">{{ $websiteLang->where('id',127)->first()->custom_text }}</label>
                            @if ($listing->listingVideos->count()>0)
                            <table class="table-bordered">
                                @foreach ($listing->listingVideos as $video)
                                    <tr>
                                        @php
                                            $video_id=explode("=",$video->video_link);
                                        @endphp

                                        <td width="90%"><iframe width="420" height="315"
                                            src="https://www.youtube.com/embed/{{ $video_id[1] }}">
                                            </iframe></td>

                                        <td width="10%">
                                            <a href="{{ route('user.listing-video-delete',$video->id) }}" onclick="return confirm('{{ $notify }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @else
                                <table class="table-bordered">
                                    <tr>
                                        <td><h5 class="text-danger text-center">{{ $websiteLang->where('id',386)->first()->custom_text }}</h5></td>
                                    </tr>
                                </table>

                            @endif
                        </div>

                    @php
                        $existImage=$listing->listingImages->count();
                        $packageImage=$package->number_of_photo;
                        $availableImage=$packageImage - $existImage ;

                        $existVideo=$listing->listingVideos->count();
                        $packageVideo=$package->number_of_video;
                        $availableVideo=$packageVideo - $existVideo;
                    @endphp

                    @if ($package->number_of_photo==-1)
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <h4>{{ $websiteLang->where('id',121)->first()->custom_text }} <span class="text-danger qty-alert">({{ $websiteLang->where('id',425)->first()->custom_text }})</span></h4>
                                <div class="ls-inputicon-box unlimited_input_fields_vimeo">
                                    <input class="form-control wt-form-control" name="image[]" type="file">
                                </div>
                                <div class="text-right m-tb10">
                                    <button class="add_unlimited_field_file site-button-secondry button-sm site-btn-effect">{{ $websiteLang->where('id',100)->first()->custom_text }}</button>
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $existImage=$listing->listingImages->count();
                            $packageImage=$package->number_of_photo;
                            $availableImage=$packageImage - $existImage ;
                        @endphp
                        @if ($availableImage > 0)
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <h4>{{ $websiteLang->where('id',121)->first()->custom_text }} <span class="text-danger qty-alert">({{ $websiteLang->where('id',432)->first()->custom_text }}-{{ $availableImage }})</span></h4>
                                <div class="ls-inputicon-box input_fields_vimeo">
                                    <input class="form-control wt-form-control" name="image[]" type="file">
                                </div>
                                <div class="text-right m-tb10">
                                    <button class="add_field_file site-button-secondry button-sm site-btn-effect">{{ $websiteLang->where('id',100)->first()->custom_text }}</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif

                    @if ($package->number_of_video==-1)
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <h4>{{ $websiteLang->where('id',122)->first()->custom_text }} <span class="text-danger qty-alert">({{  $websiteLang->where('id',425)->first()->custom_text  }})</span></h4>
                            <div class="ls-inputicon-box unlimited_input_fields_youtube">
                                <input class="form-control wt-form-control" name="video[]" type="text">
                                <i class="fs-input-icon fa fa-youtube"></i>
                            </div>

                            <div class="text-right m-tb10">
                                <button class="add_more_unlimited_youtube site-button-secondry button-sm site-btn-effect">{{ $websiteLang->where('id',100)->first()->custom_text }}</button>
                            </div>
                        </div>
                    </div>
                @else
                @php
                    $existVideo=$listing->listingVideos->count();
                    $packageVideo=$package->number_of_video;
                    $availableVideo=$packageVideo - $existVideo;
                @endphp

                @if ($availableVideo >0)
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <h4>{{ $websiteLang->where('id',122)->first()->custom_text }} <span class="text-danger qty-alert">({{ $websiteLang->where('id',433)->first()->custom_text }}-{{ $availableVideo }})</span></h4>
                            <div class="ls-inputicon-box input_fields_youtube">
                                <input class="form-control wt-form-control" name="video[]" type="text">
                                <i class="fs-input-icon fa fa-youtube"></i>
                            </div>
                            <div class="text-right m-tb10">
                                <button class="add_more_youtube site-button-secondry button-sm site-btn-effect">{{ $websiteLang->where('id',100)->first()->custom_text }}</button>
                            </div>
                        </div>
                    </div>
                @endif

            @endif


                </div>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',437)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">

                <div class="row">

                    @if ($listing->file)
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">{{ $websiteLang->where('id',440)->first()->custom_text }} : </label>

                                <div>
                                    <a href="{{ route('download-listing-file',$listing->file) }}">{{ $listing->file }}</a> <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.delete-file',$listing->id) }}" class="text-danger ml-3"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',99)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control-file wt-form-control" name="file" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',128)->first()->custom_text }}</label>
                            <div class="mb-3 listing-edit-logo">
                                <img src="{{ $listing->logo ? asset($listing->logo) : '' }}" alt="">
                            </div>
                            <label>{{ $websiteLang->where('id',97)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control-file wt-form-control" name="logo" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',129)->first()->custom_text }}</label>
                            <div class="mb-3">
                                <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="" class="banner_custom_w">
                            </div>
                            <label>{{ $websiteLang->where('id',98)->first()->custom_text }} </label>
                            <div class="ls-inputicon-box">
                                <input class="form-control-file wt-form-control" name="thumbnail_image" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',283)->first()->custom_text }}</label>
                            <div class="mb-3 banner-image">
                                <img  src="{{ $listing->banner_image ? asset($listing->banner_image) : '' }}" alt="" class="banner_custom_w">
                            </div>
                            <label>{{ $websiteLang->where('id',168)->first()->custom_text }} </label>
                            <div class="ls-inputicon-box">
                                <input class="form-control-file wt-form-control" name="banner_image" type="file">
                            </div>
                        </div>
                    </div>




                </div>

            </div>
        </div>



        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',101)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">
                <div>
                    <label>{{ $websiteLang->where('id',102)->first()->custom_text }}</label>
                    <textarea class="form-control" rows="5" name="sort_description">{{ $listing->sort_description }}</textarea>
                </div>

                <div class="mt-3">
                    <label>{{ $websiteLang->where('id',103)->first()->custom_text }}</label>
                    <textarea class="summernote" name="description">{{ $listing->description }}</textarea>
                </div>

            </div>


        </div>

        @if ($package->number_of_aminities==-1)
        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',104)->first()->custom_text }} <small class="text-danger qty-alert" >({{ $websiteLang->where('id',425)->first()->custom_text }})</small></h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">
                <div class="dashboard-amenities equal-wraper">
                    <ul class="clearfix">
                        @foreach ($aminities as $aminity)
                                @php
                                    $isChecked=false;
                                @endphp
                                @foreach ($listing->listingAminities as $old_aminity)
                                    @if ($aminity->id==$old_aminity->aminity_id)
                                        @php
                                            $isChecked=true;
                                        @endphp
                                    @endif
                                @endforeach
                                <li>
                                    <div class="dashboard-amenities-wrap equal-col">
                                        <div class="checkbox wt-radio-checkbox">
                                            <input {{ $isChecked ? 'checked' :'' }} id="unlim-aminity-{{ $aminity->id }}" name="aminities[]" value="{{ $aminity->id }}" type="checkbox" class="is-check">
                                            <label for="unlim-aminity-{{ $aminity->id }}">{{ $aminity->aminity }}</label>
                                        </div>
                                        <i class="amenities-icon {{ $aminity->icon }}"></i>
                                    </div>
                                </li>


                        @endforeach

                    </ul>

                    @php
                        $aminityList=[];
                        foreach ($aminities as $index => $aminity) {
                            $aminityList[]=$aminity->id;
                        }
                    @endphp
                </div>

            </div>
        </div>
        @else
        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',104)->first()->custom_text }} <small class="text-danger qty-alert" >({{ $websiteLang->where('id',434)->first()->custom_text }}-{{ $package->number_of_aminities }})</small></h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">
                <div class="dashboard-amenities equal-wraper">
                    <ul class="clearfix">
                        @foreach ($aminities as $aminity)
                                @php
                                    $isChecked=false;
                                @endphp
                                @foreach ($listing->listingAminities as $old_aminity)
                                    @if ($aminity->id==$old_aminity->aminity_id)
                                        @php
                                            $isChecked=true;
                                        @endphp
                                    @endif
                                @endforeach
                                <li>
                                    <div class="dashboard-amenities-wrap equal-col">
                                        <div class="checkbox wt-radio-checkbox">
                                            <input {{ $isChecked ? 'checked' :'' }} id="aminity-{{ $aminity->id }}" name="aminities[]" value="{{ $aminity->id }}" type="checkbox" class="is-check">
                                            <label for="aminity-{{ $aminity->id }}">{{ $aminity->aminity }}</label>
                                        </div>
                                        <i class="amenities-icon {{ $aminity->icon }}"></i>
                                    </div>
                                </li>


                        @endforeach

                    </ul>

                    @php
                        $aminityList=[];
                        foreach ($aminities as $index => $aminity) {
                            $aminityList[]=$aminity->id;
                        }
                    @endphp
                </div>

            </div>
        </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',105)->first()->custom_text }}</h4>
            </div>
            <div class="panel-body wt-panel-body p-a20 p-b0 m-b30 bg-white">

                <div class="row">

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',106)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="facebook" type="text" value="{{ $listing->facebook }}">
                                <i class="fs-input-icon fa fa-facebook"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',107)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="twitter" value="{{ $listing->twitter }}" type="text">
                                <i class="fs-input-icon fa fa-twitter"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',108)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="linkedin" type="text" value="{{ $listing->linkedin }}">
                                <i class="fs-input-icon fa fa-linkedin"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',109)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="whatsapp" type="text"  value="{{ $listing->whatsapp }}">
                                <i class="fs-input-icon fa fa-whatsapp"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',110)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="instagram" type="text" value="{{ $listing->instagram }}">
                                <i class="fs-input-icon fa fa-instagram"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',111)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="pinterest" type="text" value="{{ $listing->pinterest }}">
                                <i class="fs-input-icon fa fa-pinterest"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',112)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="tumblr" type="text" value="{{ $listing->tumblr }}">
                                <i class="fs-input-icon fa fa-tumblr"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',113)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="youtube" type="text" value="{{ $listing->youtube }}">
                                <i class="fs-input-icon fa fa-youtube"></i>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 p-b0 m-b30 bg-white">

                <div class="row">
                    @if ($package->is_featured)
                        @if ($package->number_of_feature_listing==-1)
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>{{ $websiteLang->where('id',114)->first()->custom_text }}</label>
                                    <select name="feature" id="" class="form-control">
                                        <option value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                        @elseif ($package->number_of_feature_listing >= $existingFeaturedListing)
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>{{ $websiteLang->where('id',114)->first()->custom_text }}</label>
                                    <select name="feature" id="" class="form-control">
                                        <option value="1">{{ $websiteLang->where('id',123)->first()->custom_text }}</option>
                                        <option value="0">{{ $websiteLang->where('id',124)->first()->custom_text }}</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                    @endif


                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',115)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control wt-form-control" name="seo_title" type="text" value="{{ $listing->seo_title }}">
                                <i class="fs-input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>{{ $websiteLang->where('id',116)->first()->custom_text }}</label>
                            <div class="ls-inputicon-box">
                                <textarea name="seo_description" class="form-control" cols="30" rows="5">{{ $listing->seo_description }}</textarea>
                                <i class="fs-input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="text-left">
            <button type="submit"  class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
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

            $('.summernote').summernote();




            //start handle aminity
            $(".is-check").on("click",function(e){
                var ids = [];
                var aminityList=<?= json_encode($aminityList)?>;
                var maxAminity= <?= $package->number_of_aminities ?>;

                $('input[name="aminities[]"]:checked').each(function() {
                    ids.push(this.value);
                });
                var idsLenth=ids.length;


                var checkedIds = ids.map((i) => Number(i));
                var unCheckedIds=aminityList.filter(d => !checkedIds.includes(d))


                if( maxAminity > idsLenth){
                    for(var j=0; j< unCheckedIds.length ; j++){
                        $("#aminity-"+unCheckedIds[j]).prop("disabled", false);
                    }
                }else{
                    for(var j=0; j< unCheckedIds.length ; j++){
                        $("#aminity-"+unCheckedIds[j]).prop("disabled", true);
                    }
                }

            })
            //end handle aminity


            var existImage="{{  $listing->listingImages->count() }}"
            var packageMaxImage='{{ $package->number_of_photo }}'
            var max_image      =packageMaxImage - existImage ;
            var img=1;

            var existVideo="{{ $listing->listingVideos->count() }}"
            var packageMaxVideo='{{ $package->number_of_video }}'
            var max_video=packageMaxVideo - existVideo;
            var video=1;
            $(".add_field_file").on("click",function(e){
                e.preventDefault();
                if(img < max_image){
                    img++;
                    $(".input_fields_vimeo").append('<div class="ls-inputicon-box"><input class="form-control m-tb10 wt-form-control" name="image[]" type="file"><a href="#" class="remove_field"><i class="fa fa-close"></i></a></div>');
                }

            })

            $(".input_fields_vimeo").on("click",".remove_field", function(e){
                e.preventDefault(); $(this).parent('div').remove(); img--;
            })


            // for unlimited image
            $(".add_unlimited_field_file").on("click",function(e){
                e.preventDefault();
                $(".unlimited_input_fields_vimeo").append('<div class="ls-inputicon-box"><input class="form-control m-tb10 wt-form-control" name="image[]" type="file"><a href="#" class="remove_field"><i class="fa fa-close"></i></a></div>');

            })

            $(".unlimited_input_fields_vimeo").on("click",".remove_field", function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            })


            // end unlimited image


            // for video

            $(".add_more_youtube").on("click",function(e){
                e.preventDefault();
                if(video < max_video){
                    video++;
                    $(".input_fields_youtube").append('<div class="ls-inputicon-box"><input class="form-control wt-form-control m-tb10" name="video[]" type="text"><i class="fs-input-icon fa fa-youtube"></i><a href="#" class="remove_field"><i class="fa fa-close"></i></a></div>');
                }
            });

            $(".input_fields_youtube").on("click",".remove_field", function(e){
                e.preventDefault(); $(this).parent('div').remove(); video--;
            })


            // for unlimited video
            $(".add_more_unlimited_youtube").on("click",function(e){
                    e.preventDefault();
                    $(".unlimited_input_fields_youtube").append('<div class="ls-inputicon-box"><input class="form-control wt-form-control m-tb10" name="video[]" type="text"><i class="fs-input-icon fa fa-youtube"></i><a href="#" class="remove_field"><i class="fa fa-close"></i></a></div>');
                });

                $(".unlimited_input_fields_youtube").on("click",".remove_field", function(e){
                    e.preventDefault(); $(this).parent('div').remove();
                })
            // end unlimited vidoe


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
