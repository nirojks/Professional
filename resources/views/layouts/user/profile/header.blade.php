@php
    $setting=App\Setting::first();
    $isRtl=$setting->text_direction;
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
    <meta name="description" content="" />


    <link rel="shortcut icon" type="image/x-icon" href="{{ $setting->favicon ?  asset($setting->favicon) : '' }}" />

    <!-- PAGE TITLE HERE -->
    @yield('title')

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/fontawesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/range-slider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/m-custom-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/loader.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/prescription.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/custom-preloader.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.css') }}">
    @if ($setting->text_direction=='RTL')
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/rtl.css') }}">
    @endif


    <link rel="stylesheet" href="{{ asset('user/css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/flaticon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/cluster-css.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">


    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">



    <script>
        var isRtl="{{ $isRtl }}"
        var rtlTrue=false;
        if(isRtl=='RTL'){
            rtlTrue=true;
        }
    </script>

    <!-- JAVASCRIPT  FILES ========================================= -->
    <script  src="{{ asset('user/js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('user/js/popper.min.js') }}"></script>
    <script  src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('user/js/range-slider.min.js') }}"></script>
    <script  src="{{ asset('user/js/magnific-popup.min.js') }}"></script>
    <script  src="{{ asset('user/js/waypoints.min.js') }}"></script>
    <script  src="{{ asset('user/js/counterup.min.js') }}"></script>
    <script  src="{{ asset('user/js/waypoints-sticky.min.js') }}"></script>
    <script  src="{{ asset('user/js/isotope.pkgd.min.js') }}"></script>
    <script  src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
    <script  src="{{ asset('user/js/stellar.min.js') }}"></script>
    <script src="{{ asset('user/js/dropzone.js') }}"></script>




    <script src="{{ asset('user/js/m-custom-scrollbar.min.js') }}"></script>
    <script  src="{{ asset('user/js/kinetic.js') }}"></script>
    <script src="{{ asset('user/js/jquery.final-countdown.js') }}"></script>




    <script  src="{{ asset('user/js/custom.js') }}"></script>


    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-bs4.css') }}">
    <script src="{{ asset('backend/summernote/summernote-bs4.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('backend/timepicker/jquery.timepicker.min.css') }}">
    <script src="{{ asset('backend/timepicker/jquery.timepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap4-toggle.min.css') }}">
    <script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>


</head>
