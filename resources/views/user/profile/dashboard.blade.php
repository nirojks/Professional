@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',68)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">
    <div class="content-admin-main">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body wt-panel-body gradi-1 dashboard-card text-white p-tb60 p-lr30 radius-md">
                        <div class="wt-card-wrap">
                            <div class="wt-card-icon"><i class="sl-icon-location"></i></div>
                            <div class="wt-card-right wt-total-active-listing counter ">{{ $listings->count() }}</div>
                            <div class="wt-card-bottom ">
                                <h4 class="m-b0">{{ $websiteLang->where('id',75)->first()->custom_text }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body wt-panel-body gradi-2 dashboard-card text-white p-tb60 p-lr30 radius-md">
                        <div class="wt-card-wrap">
                            <div class="wt-card-icon"><i class="sl-icon-chart"></i></div>
                            <div class="wt-card-right  wt-total-listing-view counter ">{{ $listings->sum('views') }}</div>
                            <div class="wt-card-bottom">
                                <h4 class="m-b0">{{ $websiteLang->where('id',76)->first()->custom_text }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body wt-panel-body gradi-3 dashboard-card text-white p-tb60 p-lr30 radius-md">
                        <div class="wt-card-wrap">
                            <div class="wt-card-icon"><i class="sl-icon-people"></i></div>
                            <div class="wt-card-right wt-total-listing-review counter ">{{ $reviews }}</div>
                            <div class="wt-card-bottom">
                                <h4 class="m-b0">{{ $websiteLang->where('id',77)->first()->custom_text }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body wt-panel-body gradi-4 dashboard-card text-white p-tb60 p-lr30 radius-md">
                        <div class="wt-card-wrap">
                            <div class="wt-card-icon"><i class="sl-icon-heart"></i></div>
                            <div class="wt-card-right wt-total-listing-bookmarked counter ">{{ $wishlists->count() }}</div>
                            <div class="wt-card-bottom">
                                <h4 class="m-b0">{{ $websiteLang->where('id',78)->first()->custom_text }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($activeOrder)
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default mt-5">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',435)->first()->custom_text }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body  bg-white">

                        @php
                            $unlimited=$websiteLang->where('id',425)->first()->custom_text;
                        @endphp

                       <div class="px-2 py-2">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',343)->first()->custom_text }}</td>
                                    <td width="50%">{{ $activeOrder->listingPackage->package_name }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',153)->first()->custom_text }}</td>
                                    <td width="50%">{{ $currency->currency_icon  }}{{ $activeOrder->listingPackage->price }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',151)->first()->custom_text }}</td>
                                    <td width="50%">{{ date('d F, Y',strtotime($activeOrder->purchase_date)) }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',152)->first()->custom_text }}</td>
                                    <td width="50%">{{ $activeOrder->expired_date== null ? $websiteLang->where('id',425)->first()->custom_text : date('d F, Y',strtotime($activeOrder->expired_date)) }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',431)->first()->custom_text }}</td>
                                    <td width="50%">{{ $activeOrder->listingPackage->number_of_listing==-1 ? $unlimited : $activeOrder->listingPackage->number_of_listing  }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',434)->first()->custom_text }}</td>
                                    <td width="50%">{{ $activeOrder->listingPackage->number_of_aminities== -1 ? $unlimited : $activeOrder->listingPackage->number_of_aminities }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',432)->first()->custom_text }}</td>
                                    <td width="50%">{{ $activeOrder->listingPackage->number_of_photo == -1 ? $unlimited : $activeOrder->listingPackage->number_of_photo }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',433)->first()->custom_text }}</td>
                                    <td width="50%">{{ $activeOrder->listingPackage->number_of_video ==-1 ? $unlimited : $activeOrder->listingPackage->number_of_video }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">{{ $websiteLang->where('id',20)->first()->custom_text }}</td>
                                    <td width="50%">{{ $activeOrder->listingPackage->is_featured ==1 ? $websiteLang->where('id',123)->first()->custom_text : $websiteLang->where('id',124)->first()->custom_text }}</td>
                                </tr>
                                @if ($activeOrder->listingPackage->is_featured==1)
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('id',351)->first()->custom_text }}</td>
                                        <td width="50%">{{ $activeOrder->listingPackage->number_of_feature_listing == -1 ? $unlimited : $activeOrder->listingPackage->number_of_feature_listing }}</td>
                                    </tr>
                                @endif



                            </table>
                       </div>
                    </div>
                </div>
            </div>
        </div>

        @endif
    </div>



</div>
@endsection
