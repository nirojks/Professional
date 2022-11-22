@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',73)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ $websiteLang->where('id',73)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',73)->first()->custom_text }}</span></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 bg-white">

                <div class="dashboard-my-listing-tabs dashboard-badge">
                    <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th width="10%">{{ $websiteLang->where('id',86)->first()->custom_text }}</th>
                                <th width="15%">{{ $websiteLang->where('id',151)->first()->custom_text }}</th>
                                <th width="15%">{{ $websiteLang->where('id',152)->first()->custom_text }}</th>
                                <th width="10%">{{ $websiteLang->where('id',153)->first()->custom_text }}</th>
                                <th width="10%">{{ $websiteLang->where('id',154)->first()->custom_text }}</th>
                                <th width="15%">{{ $websiteLang->where('id',155)->first()->custom_text }}</th>
                                <th width="5%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                            <tr>
                                <td>
                                    {{ $order->listingPackage->package_name }}
                                    @if ($order->status==1)
                                        @if ($order->payment_status==1)
                                            @if ($order->expired_date==null)
                                                <span class="badge badge-success">{{ $websiteLang->where('id',426)->first()->custom_text }}</span>
                                            @else
                                                @if (date('Y-m-d') < $order->expired_date)
                                                    <span class="badge badge-success">{{ $websiteLang->where('id',426)->first()->custom_text }}</span>
                                                @endif
                                            @endif

                                        @endif
                                    @endif


                                </td>
                                <td>{{ $order->purchase_date }}</td>
                                <td>{{ $order->expired_date == null ? $websiteLang->where('id',425)->first()->custom_text :$order->expired_date }}</td>
                                <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td> {!! clean(nl2br(e($order->transaction_id))) !!} </td>
                                <td>
                                    <a href="{{ route('user.order.details',$order->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $orders->links() }}
                </div>


            </div>
        </div>

    </div>

</div>

@endsection
