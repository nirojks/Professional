@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',73)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix print-header">
            <h2>{{ $websiteLang->where('id',73)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',73)->first()->custom_text }}</span></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 bg-white">

                <div class="dashboard-my-listing-tabs dashboard-badge">
                    <div class="prescription">
                        <div class="top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="logo"><img class="mb-2" src="{{ asset($logo->logo) }}" alt="Logo"></div>
                                    <div class="name">
                                        {{ $order->user->name }}
                                    </div>
                                    <div class="email">
                                        {{ $order->user->email }}
                                    </div>
                                    @if ($order->user->phone)
                                    <div class="phone">
                                        {{ $order->user->phone }}
                                    </div>
                                    @endif

                                </div>
                                <div class="col-md-6">
                                    <div class="right">
                                        <div>
                                            {{ $websiteLang->where('id',151)->first()->custom_text }}: {{ date('d F, Y',strtotime($order->purchase_date)) }}
                                        </div>
                                        <div>
                                            {{ $websiteLang->where('id',152)->first()->custom_text }}: {{ $order->expired_date== null ? $websiteLang->where('id',425)->first()->custom_text : date('d F, Y',strtotime($order->expired_date)) }}
                                        </div>
                                        @if ($order->listingPackage->package_type==1)
                                            @if ($order->status==1)
                                                <div>{{ $websiteLang->where('id',427)->first()->custom_text }}: <span class="badge badge-success">{{ $websiteLang->where('id',428)->first()->custom_text }}</span></div>
                                            @else
                                                <div>{{ $websiteLang->where('id',427)->first()->custom_text }}: <span class="badge badge-danger">{{ $websiteLang->where('id',81)->first()->custom_text }}</span></div>
                                            @endif
                                        @else
                                        <div>{{ $websiteLang->where('id',427)->first()->custom_text }}: <span class="badge badge-danger">{{ $websiteLang->where('id',429)->first()->custom_text }}</span></div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th width="10%">{{ $websiteLang->where('id',86)->first()->custom_text }}</th>
                                    <th width="15%">{{ $websiteLang->where('id',151)->first()->custom_text }}</th>
                                    <th width="15%">{{ $websiteLang->where('id',152)->first()->custom_text }}</th>
                                    <th width="10%">{{ $websiteLang->where('id',153)->first()->custom_text }}</th>
                                    <th width="20%">{{ $websiteLang->where('id',154)->first()->custom_text }}</th>
                                    <th width="15%">{{ $websiteLang->where('id',155)->first()->custom_text }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{ $order->listingPackage->package_name }}
                                    </td>
                                    <td>{{ $order->purchase_date }}</td>
                                    <td>{{ $order->expired_date == null ? $websiteLang->where('id',425)->first()->custom_text :$order->expired_date }}</td>
                                    <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{!! clean(nl2br(e($order->transaction_id))) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                    </div>

                </div>
            </div>
        </div>

        <br>
        <button type="button"  class="site-button-secondry site-btn-effect print-btn" onclick="printOrder()">{{ $websiteLang->where('id',430)->first()->custom_text }}</button>

    </div>


    <script>
        function printOrder(){
            setTimeout(function(){
                window.print()
            }, 1000);
        }
    </script>

</div>
@endsection
