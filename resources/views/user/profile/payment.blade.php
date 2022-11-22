@extends('layouts.user.layout')
@section('title')
    <title>{{ $websiteLang->where('id',220)->first()->custom_text }}</title>
@endsection

@section('user-content')
     <!-- INNER PAGE BANNER -->
     <div class="wt-bnr-inr overlay-wraper bg-center"    style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="overlay-main bg-black opacity-07"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="text-white">{{ $websiteLang->where('id',220)->first()->custom_text }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li>{{ $websiteLang->where('id',220)->first()->custom_text }}</li>
                        </ul>
                    </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- ABOUT SECTION START -->
    <div class="section-full p-t80 p-b50">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-12">
                            <!-- About Detail-->
                            <div class="wt-list-panel m-b30  p-a20 bg-white shadow">
                            <div class="wt-list-single-about-detail">
                                <div class="payment-select">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                        @if ($paymentSetting->stripe_status==1)
                                            <a class="nav-link active" id="stripe-tab" data-toggle="tab" href="#stripe" role="tab" aria-controls="stripe" aria-selected="true">{{ $websiteLang->where('id',221)->first()->custom_text }}</a>
                                            </li>
                                        @endif


                                        @if ($paymentSetting->paypal_status==1)
                                            <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="paypal-tab" data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal" aria-selected="false">{{ $websiteLang->where('id',222)->first()->custom_text }}</a>
                                            </li>
                                        @endif

                                        @if ($razorpay->razorpay_status==1)
                                            <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="razorpay-tab" data-toggle="tab" href="#razorpay" role="tab" aria-controls="razorpay" aria-selected="false">{{ $websiteLang->where('id',484)->first()->custom_text }}</a>
                                            </li>
                                        @endif

                                        @if ($flutterwave->status==1)
                                            <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="flutterwave-tab" data-toggle="tab" href="#flutterwave" role="tab" aria-controls="flutterwave" aria-selected="false">{{ $websiteLang->where('id',500)->first()->custom_text }}</a>
                                            </li>
                                        @endif

                                        @if ($paystack->paystack_status==1)
                                            <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="paystack-tab" data-toggle="tab" href="#paystack" role="tab" aria-controls="paystack" aria-selected="false">{{ $websiteLang->where('id',504)->first()->custom_text }}</a>
                                            </li>
                                        @endif

                                        @if ($mollie->mollie_status==1)
                                            <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="mollie-tab" data-toggle="tab" href="#mollie" role="tab" aria-controls="mollie" aria-selected="false">{{ $websiteLang->where('id',511)->first()->custom_text }}</a>
                                            </li>
                                        @endif

                                        @if ($instamojo->status==1)
                                            <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="instamojo-tab" data-toggle="tab" href="#instamojo" role="tab" aria-controls="instamojo" aria-selected="false">{{ $websiteLang->where('id',513)->first()->custom_text }}</a>
                                            </li>
                                        @endif

                                        @if ($paymongo->status==1)
                                            <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="paymongo-tab" data-toggle="tab" href="#paymongo" role="tab" aria-controls="paymongo" aria-selected="false">{{ $websiteLang->where('id',522)->first()->custom_text }}</a>
                                            </li>
                                        @endif




                                        @if ($paymentSetting->bank_status==1)
                                            <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">{{ $websiteLang->where('id',485)->first()->custom_text }}</a>
                                            </li>
                                        @endif



                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @if ($paymentSetting->stripe_status==1)
                                            <div class="tab-pane fade show active mt-5" id="stripe" role="tabpanel" aria-labelledby="stripe-tab">
                                                <div class="payment-select-group">
                                                    <form role="form" action="{{ route('user.stripe.payment',$id) }}" method="post" class="require-validation"
                                                    data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ $stripe->stripe_key }}"
                                                    id="payment-form">
                                                    @csrf
                                                    <div class='form-row row mt_30'>
                                                        <div class='col-sm-6 col-12 form-group required'>
                                                            <label class='control-label'>{{ $websiteLang->where('id',225)->first()->custom_text }}</label> <input
                                                                autocomplete='off' class='form-control card-number' size='20'
                                                                type='text' name="card_digit">
                                                        </div>


                                                        <div class='col-sm-6 col-12 form-group cvc required'>
                                                            <label class='control-label'>{{ $websiteLang->where('id',226)->first()->custom_text }}</label> <input autocomplete='off'
                                                                class='form-control card-cvc' size='4'
                                                                type='text'>
                                                        </div>

                                                        <div class='col-sm-6 col-12 form-group expiration required'>
                                                            <label class='control-label'>{{ $websiteLang->where('id',227)->first()->custom_text }}</label> <input
                                                                class='form-control card-expiry-month' size='2'
                                                                type='text'>
                                                        </div>

                                                        <div class='col-sm-6 col-12 form-group expiration required'>
                                                            <label class='control-label'>{{ $websiteLang->where('id',228)->first()->custom_text }}</label> <input
                                                                class='form-control card-expiry-year'  size='4'
                                                                type='text'>
                                                        </div>
                                                    </div>
                                                    <div class='form-row row'>
                                                        <div class='col-md-12 error form-group hide d-none'>
                                                            <div class='alert-danger alert'>{{ $websiteLang->where('id',229)->first()->custom_text }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="payment-order-button col-3">
                                                        <button class="razorpay-payment-button razorpay-payment-button" type="submit">{{ $websiteLang->where('id',223)->first()->custom_text }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        @endif

                                        @if ($paymentSetting->paypal_status==1)
                                            <div class="tab-pane fade mt-5" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                                                <form action="{{ route('user.paypal',$id) }}" method="POST">
                                                    @csrf
                                                <div class="row">

                                                    <div class="payment-order-button col-3">
                                                        <button class="razorpay-payment-button razorpay-payment-button" type="submit">{{ $websiteLang->where('id',224)->first()->custom_text }}</button>
                                                    </div>

                                                </div>
                                            </form>
                                            </div>
                                        @endif

                                        @if ($razorpay->razorpay_status==1)
                                            <div class="tab-pane fade mt-5" id="razorpay" role="tabpanel" aria-labelledby="razorpay-tab">
                                                <form action="{{ route('user.razorpay-payment',$package->id) }}" method="POST" >
                                                    @csrf

                                                    @php
                                                        $inr_amount = round($package_price / $razorpay->currency_rate,2);
                                                        $payableAmount = round($package_price * $razorpay->currency_rate,2);
                                                    @endphp

                                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                            data-key="{{ $razorpay->razorpay_key }}"
                                                            data-amount= "{{ $payableAmount * 100 }}"
                                                            data-buttontext="{{ $websiteLang->where('id',493)->first()->custom_text }} {{ $payableAmount }} {{ $razorpay->currency_code }}"
                                                            data-name="{{ $razorpay->name }}"
                                                            data-description="{{ $razorpay->description }}"
                                                            data-image="{{ asset($razorpay->image) }}"
                                                            data-prefill.name=""
                                                            data-prefill.email=""
                                                            data-theme.color="{{ $razorpay->theme_color }}">
                                                    </script>
                                                </form>
                                            </div>
                                        @endif

                                        @php
                                        $usd_amount=$package_price / $setting->currency_rate;
                                        $tnx_ref = substr(rand(0,time()),0,7);
                                        @endphp

                                        @if ($flutterwave->status==1)
                                            <div class="tab-pane fade mt-5" id="flutterwave" role="tabpanel" aria-labelledby="flutterwave-tab">
                                                <div class="row">
                                                    <div class="payment-order-button col-6">
                                                        <button class="razorpay-payment-button razorpay-payment-button" type="button" onclick="makePayment()">{{ $websiteLang->where('id',503)->first()->custom_text }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="tab-pane fade mt-5" id="paystack" role="tabpanel" aria-labelledby="paystack-tab">
                                            <div class="row">
                                                <div class="payment-order-button col-6">
                                                    <button class="razorpay-payment-button razorpay-payment-button" type="button" onClick="payWithPaystack()">{{ $websiteLang->where('id',519)->first()->custom_text }}</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade mt-5" id="mollie" role="tabpanel" aria-labelledby="mollie-tab">
                                            <div class="row">
                                                <div class="payment-order-button col-6">
                                                    <a href="{{ route('user.mollie-payment', $package->id) }}" class="razorpay-payment-button razorpay-payment-button">{{ $websiteLang->where('id',521)->first()->custom_text }}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade mt-5" id="instamojo" role="tabpanel" aria-labelledby="instamojo-tab">
                                            <div class="row">
                                                <div class="payment-order-button col-6">
                                                    <a href="{{ route('user.pay-with-instamojo', $package->id) }}" class="razorpay-payment-button razorpay-payment-button">{{ $websiteLang->where('id',520)->first()->custom_text }}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade mt-5" id="paymongo" role="tabpanel" aria-labelledby="paymongo-tab">
                                            <div class="row">
                                                <div class="payment-order-button col-6">
                                                    <a href="javascript:;" data-toggle="modal" data-target=".paymongo-modal" class="razorpay-payment-button razorpay-payment-button">{{ $websiteLang->where('id',523)->first()->custom_text }}</a>

                                                    <a href="{{ route('user.pay-with-grab-pay', $package->id) }}" class="razorpay-payment-button razorpay-payment-button">{{ $websiteLang->where('id',524)->first()->custom_text }}</a>

                                                    <a href="{{ route('user.pay-with-gcash', $package->id) }}" class="razorpay-payment-button razorpay-payment-button">{{ $websiteLang->where('id',525)->first()->custom_text }}</a>


                                                </div>
                                            </div>
                                        </div>



                                        @if ($paymentSetting->bank_status==1)
                                            <div class="tab-pane fade mt-5" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                                                <form action="{{ route('user.bank-payment') }}" method="POST">
                                                    @csrf

                                                <div class="row">
                                                    <div class="col-6">
                                                        <p>{!! clean(nl2br(e($stripe->bank_account))) !!}</p>
                                                        <textarea name="tran_id" class="form-control" id="" cols="30" rows="3" placeholder="{{ $websiteLang->where('id',495)->first()->custom_text }}" required></textarea>
                                                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                        <div class="payment-order-button mt-3">
                                                            <button class="razorpay-payment-button razorpay-payment-button" type="submit">{{ $websiteLang->where('id',492)->first()->custom_text }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade paymongo-modal" role="dialog">
        <div class="modal-dialog">
            <!-- MODAL CONTENT-->
            <div class="modal-content">

                <div class="sign-in-dialog">
                    <div class="sign-in-dialog-header">
                        <h4 class="dialog-h-title">{{ $websiteLang->where('id',526)->first()->custom_text }}</h4>
                        <button type="button" class="close  sign-in-popup-close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="sign-in-dialog-form">
                        <form role="form" action="{{ route('user.pay-with-paymongo',$id) }}" method="post" >
                        @csrf
                        <div class='form-row row mt_30'>
                            <div class='col-sm-6 col-12 form-group required'>
                                <label class='control-label'>{{ $websiteLang->where('id',225)->first()->custom_text }}</label> <input
                                    autocomplete='off' class='form-control' size='20'
                                    type='text' name="card_number">
                            </div>


                            <div class='col-sm-6 col-12 form-group cvc required'>
                                <label class='control-label'>{{ $websiteLang->where('id',226)->first()->custom_text }}</label> <input autocomplete='off'
                                    class='form-control' size='4'
                                    type='text' name="cvc">
                            </div>

                            <div class='col-sm-6 col-12 form-group expiration required'>
                                <label class='control-label'>{{ $websiteLang->where('id',227)->first()->custom_text }}</label> <input
                                    class='form-control' size='2'
                                    type='text' name="month">
                            </div>

                            <div class='col-sm-6 col-12 form-group expiration required'>
                                <label class='control-label'>{{ $websiteLang->where('id',228)->first()->custom_text }}</label> <input
                                    class='form-control'  size='4'
                                    type='text' name="year">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="payment-order-button">
                            <button class="razorpay-payment-button razorpay-payment-button" type="submit">{{ $websiteLang->where('id',492)->first()->custom_text }}</button>
                        </div>
                    </div>
                </form>
                    </div>

                </div>

            </div>

        </div>
    </div>



@php
// start paystack
$public_key = $paystack->paystack_public_key;
$currency = $paystack->paystack_currency_code;
$currency = strtoupper($currency);

$ngn_amount = $package_price * $paystack->paystack_currency_rate;
$ngn_amount = $ngn_amount * 100;
$ngn_amount = round($ngn_amount);
// end paystack

//start fluterwave
$payable_amount = $package_price * $flutterwave->currency_rate;
$payable_amount = round($payable_amount, 2);
// end flutterwave

@endphp



<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
    function makePayment() {
        FlutterwaveCheckout({
        public_key: "{{ $flutterwave->public_key }}",
        tx_ref: "RX1_{{ $tnx_ref }}",
        amount: {{ $payable_amount }},
        currency: "{{ $flutterwave->currency_code }}",
        country: "{{ $flutterwave->country_code }}",
        payment_options: " ",
        customer: {
            email: "{{ $user->email }}",
            phone_number: "{{ $user->phone }}",
            name: "{{ $user->name }}",
        },
        callback: function (data) {
            var tnx_id = data.transaction_id;
            var _token = "{{ csrf_token() }}";
            var package_id = '{{ $package->id }}';
            $.ajax({
                type: 'post',
                data : {tnx_id,_token,package_id},
                url: "{{ url('user/flutterwave-payment/') }}",
                success: function (response) {
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        window.location.href = "{{ route('user.my-order') }}";
                    }else{
                        toastr.error(response.message);
                        window.location.reload();
                    }
                },
                error: function(err) {}
            });

        },
        customizations: {
            title: "{{ $flutterwave->title }}",
            logo: "{{ asset($flutterwave->logo) }}",
        },
        });
    }

    function payWithPaystack(){
        var package_id = '{{ $package->id }}';
        var handler = PaystackPop.setup({
            key: '{{ $public_key }}',
            email: '{{ $user->email }}',
            amount: '{{ $ngn_amount }}',
            currency: "{{ $currency }}",
            callback: function(response){
            let reference = response.reference;
            let tnx_id = response.transaction;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                type: "post",
                data: {reference, tnx_id, _token, package_id},
                url: "{{ route('user.paystack-payment') }}",
                success: function(response) {
                    if(response.status == 'success'){
                        window.location.href = "{{ route('user.my-order') }}";
                    }else{
                        window.location.reload();
                    }
                }
            });
            },
            onClose: function(){
                alert('window closed');
            }
        });
        handler.openIframe();
    }

</script>
@endsection
