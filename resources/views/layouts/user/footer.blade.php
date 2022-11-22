@php
$footer_contact=App\ContactUs::first();
$contact_info=App\ContactInformation::first();
$menus=App\Navigation::all();
$setting=App\Setting::first();
$isRtl=$setting->text_direction;
@endphp

 <!-- FOOTER START -->
 <footer class="site-footer footer-large footer-light text-white">

    <!-- FOOTER BLOCKES START -->
    <div class="footer-top  dot2-left-top-img">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget widget_about">
                        <div class="logo-footer clearfix p-b15">
                            <a href="{{ route('home') }}"><img src="{{ $setting->logo ? asset($setting->logo) : '' }}" alt=""></a>
                        </div>
                        <p>{{ $contact_info->about }}</p>
                        <div class="widget_social_inks">
                            <ul class="social-icons social-square social-darkest">
                                @if ($footer_contact->facebook)
                            <li>
                                <a href="{{ $footer_contact->facebook }}" class="fab fa-facebook"></a>
                            </li>
                            @endif
                           @if ($footer_contact->twitter)
                            <li>
                                <a href="{{ $footer_contact->twitter }}" class="fab fa-twitter"></a>
                            </li>
                           @endif
                           @if ($footer_contact->linkedin)
                           <li>
                            <a href="{{ $footer_contact->linkedin }}" class="fab fa-linkedin"></a>
                        </li>
                           @endif
                           @if ($footer_contact->youtube)
                            <li>
                                <a href="{{ $footer_contact->youtube }}" class="fab fa-youtube"></a>
                            </li>
                           @endif
                           @if ($footer_contact->instagram)
                            <li>
                                <a href="{{ $footer_contact->instagram }}" class="fab fa-instagram"></a>
                            </li>
                           @endif
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget widget_services">
                        <h4 class="widget-title">{{ $websiteLang->where('id',25)->first()->custom_text }}</h4>
                        <ul>

                            <li>

                                @php
                                    $isDashbaord=$menus->where('id',10)->first();
                                    $isAbout=$menus->where('id',4)->first();
                                @endphp
                                @if ($isDashbaord->status==1)
                                    @auth
                                        <a href="{{ route('user.dashboard') }}">{{ $isDashbaord->navbar }}</a>
                                    @else
                                    <a href="{{ route('user.dashboard') }}" data-toggle="modal" data-target=".sign-in-modal">{{ $isDashbaord->navbar }}</a>
                                    @endauth

                                @endif
                                @if ($isAbout->status==1)
                                <a href="{{ route('about.us') }}">{{ $isAbout->navbar }}</a>
                                @endif
                            </li>
                            <li>
                                @php
                                    $isPricing=$menus->where('id',5)->first();
                                    $isNewListing=$menus->where('id',9)->first();

                                @endphp
                                @if ($isPricing->status==1)
                                    <a href="{{ route('pricing.plan') }}">{{ $isPricing->navbar }}</a>
                                @endif
                                @if ($isNewListing->status==1)
                                @auth
                                    <a href="{{ route('user.create.listing') }}">{{ $isNewListing->navbar }} </a>
                                @else
                                    <a href="{{ route('user.create.listing') }}" data-toggle="modal" data-target=".sign-in-modal">{{ $isNewListing->navbar }} </a>
                                @endauth

                                @endif
                            </li>
                            <li>
                                @php
                                    $isListing=$menus->where('id',2)->first();
                                @endphp
                                @if ($isListing->status==1)
                                    <a href="{{ route('listings',['page_type'=>'list_view']) }}">{{ $isListing->navbar }}</a>
                                @endif

                                @php
                                    $isBlog=$menus->where('id',7)->first();
                                @endphp
                                @if ($isBlog->status==1)
                                <a href="{{ route('blog') }}">{{ $isBlog->navbar }}</a>
                                @endif
                            </li>
                            <li>
                                @php
                                $isHomePage=$menus->where('id',1)->first();
                                @endphp
                                @if ($isHomePage->status==1)
                                    <a href="{{ route('home') }}">{{ $isHomePage->navbar }}</a>
                                @endif

                                @php
                                    $isListingCategory=$menus->where('id',6)->first();
                                @endphp
                                @if ($isListingCategory->status==1)
                                <a href="{{ route('listing.category') }}">{{ $isListingCategory->navbar }}</a>
                                @endif
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="widget recent-posts-entry">
                        <h4 class="widget-title">{{ $websiteLang->where('id',26)->first()->custom_text }}</h4>
                        <ul class="widget_address">
                            <li><i class="sl-icon-location "></i>{{ $footer_contact->footer_address }}</li>
                            <li><i class="sl-icon-envelope-open "></i>{{ $footer_contact->footer_email }}</li>
                            <li> <i class="sl-icon-phone "></i>{{ $footer_contact->footer_phone }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER COPYRIGHT -->

    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="wt-footer-bot-left">
                    <ul class="copyrights-nav">
                        @php
                            $isTermsCondition=$menus->where('id',15)->first();
                        @endphp
                        @if ($isTermsCondition->status==1)
                        <li><a href="{{ route('terms.condition') }}">{{ $isTermsCondition->navbar }}</a></li>
                        @endif

                        @php
                            $isPrivacy=$menus->where('id',16)->first();
                        @endphp
                        @if ($isPrivacy->status==1)
                        <li><a href="{{ route('privacy-policy') }}">{{ $isPrivacy->navbar }}</a></li>
                        @endif

                        @php
                            $isContact=$menus->where('id',8)->first();
                        @endphp
                        @if ($isContact->status==1)
                        <li><a href="{{ route('contact.us') }}">{{ $isContact->navbar }}</a></li>
                        @endif
                    </ul>
                    <span class="copyrights-text">{{ $contact_info->copyright }}</span>
                </div>
                @if ($setting->allow_credit_card_section==1)
                <ul class="footer-payments">

                    @php
                        $icons=App\PaymentCardLogo::where('status',1)->get();
                    @endphp
                    @foreach ($icons as $item)
                        <li><a href="javascript:;"><i class="{{ $item->icon }}"></i></a></li>
                    @endforeach


                </ul>
                @endif


            </div>
        </div>
    </div>


</footer>
<!-- FOOTER END -->

<!-- BUTTON TOP START -->
<button id="custom-scroltop" class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

@php
    $authSetting=App\Setting::first();
    $loginModal=$menus->where('id',12)->first();
    $isRegister=$menus->where('id',11)->first();
    $isForgetPass=$menus->where('id',13)->first();
@endphp


@if ($loginModal->status==1)
<!-- Login sign uo popup -->
<div class="modal fade sign-in-modal" role="dialog">
    <div class="modal-dialog">
        <!-- MODAL CONTENT-->
        <div class="modal-content">

            <div class="sign-in-dialog">
                <div class="sign-in-dialog-header">
                    <h4 class="dialog-h-title">{{ $websiteLang->where('id',57)->first()->custom_text }}</h4>
                    <button type="button" class="close  sign-in-popup-close" data-dismiss="modal">&times;</button>
                </div>
                <div class="sign-in-dialog-form">
                        <div class="wt-tabs tabs-default">
                            <ul class="nav nav-tabs">
                                <li><a class="active" data-toggle="tab" href="#login-one">{{ $loginModal->navbar }} </a></li>
                                <li><a data-toggle="tab" href="#register-one">{{ $isRegister->navbar }} </a></li>
                                <li><a data-toggle="tab" href="#forgot-one">{{ $isForgetPass->navbar }}</a></li>

                            </ul>
                            <div class="tab-content">
                                <div id="login-one" class="tab-pane active">
                                    <form id="loginFormSubmit">
                                        @csrf
                                        <div class="form-group">
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="email" type="email" placeholder="{{ $websiteLang->where('id',24)->first()->custom_text }}">
                                                <i class="fs-input-icon fa fa-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="ls-inputicon-box">
                                                <input class="form-control" name="password" type="Password" placeholder="{{ $websiteLang->where('id',61)->first()->custom_text }}">
                                                <i class="fs-input-icon sl-icon-lock "></i>
                                            </div>
                                        </div>

                                    @if($authSetting->allow_captcha==1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ $authSetting->captcha_key }}"></div>
                                    </div>

                                    @endif

                                    <div class="login-btn-bx text-right">
                                        <button id="loginSubmitBtn" type="button" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',58)->first()->custom_text }}</button>
                                    </div>
                                </form>
                                </div>

                                <div id="register-one" class="tab-pane">
                                    <form id="registerFormSubmit">
                                        @csrf
                                    <div class="form-group">
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" name="name" type="text" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }}">
                                            <i class="fs-input-icon sl-icon-user "></i>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" name="email" type="email" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }}">
                                            <i class="fs-input-icon fa fa-envelope"></i>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" name="password" type="Password" placeholder="{{ $websiteLang->where('id',61)->first()->custom_text }}">
                                            <i class="fs-input-icon sl-icon-lock "></i>
                                        </div>
                                    </div>

                                    @if($authSetting->allow_captcha==1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ $authSetting->captcha_key }}"></div>
                                    </div>

                                    @endif


                                    <style>
                                        .custom-opacity{
                                            opacity: 0.8
                                        }
                                    </style>
                                    <div class="login-btn-bx text-right">
                                        <button  id="registerBtn" type="button" class="site-button-secondry site-btn-effect"> <i id="reg-spinner" class="loading-icon fa fa-spin fa-spinner d-none"></i> {{ $websiteLang->where('id',59)->first()->custom_text }}</button>
                                    </div>
                                    </form>
                                </div>
                                <div id="forgot-one" class="tab-pane">
                                    <form id="forgetPassFormSubmit">
                                        @csrf

                                    <div class="form-group">
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" name="email" type="email" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }}">
                                            <i class="fs-input-icon fa fa-envelope"></i>
                                        </div>
                                    </div>
                                    @if($authSetting->allow_captcha==1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ $authSetting->captcha_key }}"></div>
                                    </div>

                                    @endif
                                    <div class="login-btn-bx text-right">
                                        <button id="forgetPassBtn" type="button" class="site-button-secondry site-btn-effect">{{ $websiteLang->where('id',60)->first()->custom_text }}</button>
                                    </div>
                                </form>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endif

@php
    $listings=App\Listing::all();
    $setting=App\Setting::first();
    $websiteLang=App\ManageText::all()
@endphp




{{-- confirmation modal box --}}

@php
    $listingPackages=App\ListingPackage::all();
@endphp
@foreach ($listingPackages as $listingPackage)
<div class="modal fade confirmation-modal-{{ $listingPackage->id }}" role="dialog">
    <div class="modal-dialog">
        <!-- MODAL CONTENT-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="text-center text-center">{{ $websiteLang->where('id',475)->first()->custom_text }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="login-btn-bx text-right">
                    <a href="javascript:;" class="site-button-secondry  site-button-gradient" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</a>
                    <a href="{{ route('user.purchase.package',$listingPackage->id) }}" class="site-button-secondry site-btn-danger ">{{ $websiteLang->where('id',123)->first()->custom_text }}</a>

                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
{{-- end confirmation modal box --}}

@foreach ($listings as $listing)
<!-- MODAL -->
<div class="modal fade preview-place-{{ $listing->id }}" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- MODAL CONTENT-->
        <div class="modal-content">
            <button type="button" class="close single-preview-popup-close" data-dismiss="modal">&times;</button>
            <div class="single-preview-location">

                <div class="single-preview-location-info">
                    <div class="single-preview-location-left">
                        <div class="list-slide">
                            <div class="modal-wt-media">
                                <img src="{{ $listing->thumbnail_image ? asset($listing->thumbnail_image) : '' }}" alt="">
                            </div>
                        </div>
                        <div class="list-category-content p-a20">
                            <div class="p-b10">
                                @if ($listing->is_featured==1)
                                    <span class="list-cat-featured"><i class="fa fa-star-o"></i> {{ $websiteLang->where('id',10)->first()->custom_text }}</span>
                                @endif
                                @if ($listing->verified)
                                    <span class="list-cat-verified"><i class="fa fa-check"></i> {{ $websiteLang->where('id',11)->first()->custom_text }}</span>
                                @endif

                            </div>
                            <div class="clearfix">


                                @if ($listing->reviews->count() > 0)

                                    @php
                                        $qty=$listing->reviews->count();
                                        $total=$listing->reviews->sum('rating');
                                        $avg=$total/$qty;
                                        $intAvg=intval($avg);
                                        $nextVal=$intAvg+1;
                                        $reviewPoint=$intAvg;
                                        $halfReview=false;
                                        if($intAvg < $avg && $avg < $nextVal){
                                            $reviewPoint= $intAvg + 0.5;
                                            $halfReview=true;
                                        }
                                    @endphp

                                    <div class="wt-rating-section p-b10">
                                        <span class="wt-rating">
                                            @for ($i = 1; $i <=5; $i++)
                                                        @if ($i <= $reviewPoint)
                                                            <i class="fa fa-star"></i>
                                                        @elseif ($i> $reviewPoint )
                                                            @if ($halfReview==true)
                                                                <i class="fa fa-star-half-o"></i>
                                                                @php
                                                                    $halfReview=false
                                                                @endphp
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endif
                                                    @endfor
                                        </span>
                                        <span class="wt-rating-conting">({{ $qty }} {{ $websiteLang->where('id',9)->first()->custom_text }})</span>
                                    </div>
                                @endif
                            </div>
                            <h4 class="list-place-name m-b10">{{ $listing->title }}</h4>

                            @if ($listing->phone)
                            <div class="list-cat-phone p-b10"><i class="sl-icon-phone"></i><strong>{{ $listing->phone }}</strong></div>
                            @endif


                            @if ($listing->address)
                            <div class="list-cat-address p-b10"><i class="sl-icon-location"></i>{{ $listing->address }}</div>
                            @endif


                            <p>{{ $listing->sort_description }}</p>
                            <div class="single-preview-footer clearfix" >
                                <a href="{{ route('listing.show',$listing->slug) }}" class="site-button-link">{{ $websiteLang->where('id',12)->first()->custom_text }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="single-preview-location-right">
                        <div class="single-preview-map">
                            {!! $listing->google_map_embed_code !!}
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<script>
    var map_id = {!! json_encode($listing->id, JSON_HEX_TAG) !!};

</script>




@endforeach

</div>



@if ($setting->live_chat==1)
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='{{ $setting->livechat_script }}';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>

@endif

@if ($setting->preloader==1)
<div id="preloader">
    <div id="status" style="background-image: url({{ url($setting->preloader_image) }})"></div>
 </div>
@endif



@php
    $modalConsent=App\ModalConsent::first();

@endphp

@if ($modalConsent->status==1)
<script src="{{ asset('user/js/cookieconsent.min.js') }}"></script>

<script>
window.addEventListener("load",function(){window.wpcc.init({"border":"{{ $modalConsent->border }}","corners":"{{ $modalConsent->corners }}","colors":{"popup":{"background":"{{ $modalConsent->background_color }}","text":"{{ $modalConsent->text_color }}","border":"{{ $modalConsent->border_color }}"},"button":{"background":"{{ $modalConsent->btn_bg_color }}","text":"{{ $modalConsent->btn_text_color }}"}},"content":{"href":"{{ route('privacy-policy') }}","message":"{{ $modalConsent->message }}","link":"{{ $modalConsent->link_text }}","button":"{{ $modalConsent->btn_text }}"}})});
</script>
@endif

<script>
    var isRtl="{{ $isRtl }}"
    var rtlTrue=false;
    if(isRtl=='RTL'){
        rtlTrue=true;
    }
</script>




    <script src="{{ asset('user/js/popper.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('user/js/range-slider.min.js') }}"></script>
    <script src="{{ asset('user/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('user/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('user/js/counterup.min.js') }}"></script>
    <script src="{{ asset('user/js/waypoints-sticky.min.js') }}"></script>
    <script src="{{ asset('user/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/stellar.min.js') }}"></script>
    <script src="{{ asset('user/js/dropzone.js') }}"></script>
<script src="{{ asset('user/js/m-custom-scrollbar.min.js') }}"></script>
<script src="{{ asset('user/js/kinetic.js') }}"></script>
<script src="{{ asset('user/js/jquery.final-countdown.js') }}"></script>
<script src="{{ asset('user/js/custom-preloader.js') }}"></script>


<script src="{{ asset('user/js/custom.js') }}"></script>

<script src="{{ asset('toastr/toastr.min.js') }}"></script>


<script>
    @if(Session::has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
          case 'info':
               toastr.info("{{ Session::get('messege') }}");
               break;
          case 'success':
              toastr.success("{{ Session::get('messege') }}");
              break;
          case 'warning':
             toastr.warning("{{ Session::get('messege') }}");
              break;
          case 'error':
              toastr.error("{{ Session::get('messege') }}");
              break;
      }
    @endif
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif



<script>




// stripe

$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('d-none');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('d-none');
        e.preventDefault();


      }
    });

    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }

  });

  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }


});
</script>



<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        $('.select2').select2();
        $("#loginSubmitBtn").on('click',function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('login') }}",
                type:"post",
                data:$('#loginFormSubmit').serialize(),
                success:function(response){
                    if(response.success){
                        window.location.href = "{{ route('user.dashboard')}}";
                        toastr.success(response.success)

                    }
                    if(response.error){
                        toastr.error(response.error)

                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.email)toastr.error(response.responseJSON.errors.email[0])
                    if(response.responseJSON.errors.password)toastr.error(response.responseJSON.errors.password[0])
                    if(response.responseJSON.errors.g-recaptcha-response)toastr.error(response.responseJSON.errors.g-recaptcha-response[0])


                }

            });


        })

        $("#registerBtn").on('click',function(e) {

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            e.preventDefault();
            $("#reg-spinner").removeClass('d-none')
            $("#registerBtn").addClass('custom-opacity')
            $("#registerBtn").removeClass('site-btn-effect')
            $("#registerBtn").attr('disabled',true);
            $.ajax({
                url: "{{ route('register') }}",
                type:"post",
                data:$('#registerFormSubmit').serialize(),
                success:function(response){
                    if(response.success){
                        $("#registerFormSubmit").trigger("reset");
                        $(".sign-in-modal").modal('hide');

                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')

                        toastr.success(response.success)
                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.name){
                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.name[0])
                    }

                    if(response.responseJSON.errors.email){
                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.email[0])
                    }

                    if(response.responseJSON.errors.password){
                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.password[0])
                    }

                    if(response.responseJSON.errors.g-recaptcha-response){
                        $("#reg-spinner").addClass('d-none')
                        $("#registerBtn").removeClass('custom-opacity')
                        $("#registerBtn").attr('disabled',false);
                        $("#registerBtn").addClass('site-btn-effect')
                        toastr.error(response.responseJSON.errors.g-recaptcha-response[0])
                    }


                }

            });


        })

        $("#forgetPassBtn").on('click',function(e) {

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            e.preventDefault();
            $.ajax({
                url: "{{ route('send.forget.password') }}",
                type:"post",
                data:$('#forgetPassFormSubmit').serialize(),
                success:function(response){
                    if(response.success){
                        $(".sign-in-modal").modal('hide');
                        $("#forgetPassFormSubmit").trigger("reset");
                        toastr.success(response.success)
                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.email)toastr.error(response.responseJSON.errors.email[0])

                    if(response.responseJSON.errors.g-recaptcha-response)toastr.error(response.responseJSON.errors.g-recaptcha-response[0])

                }

            });


        })


        $("#subscribeBtn").on('click',function(e) {

            // project demo mode check
            var isDemo="{{ env('PROJECT_MODE') }}"
            var demoNotify="{{ env('NOTIFY_TEXT') }}"
            if(isDemo==0){
                toastr.error(demoNotify);
                return;
            }
            // end

            e.preventDefault();

            $("#subscribe-spinner").removeClass('d-none')
            $("#subscribeBtn").addClass('custom-opacity')
            $("#subscribeBtn").attr('disabled',true);


            $.ajax({
                url: "{{ route('subscribe-us') }}",
                type:"get",
                data:$('#subscribeForm').serialize(),
                success:function(response){
                    if(response.success){
                        $("#subscribeForm").trigger("reset");
                        toastr.success(response.success)

                        $("#subscribe-spinner").addClass('d-none')
                        $("#subscribeBtn").removeClass('custom-opacity')
                        $("#subscribeBtn").attr('disabled',false);

                    }
                    if(response.error){
                        toastr.error(response.error)
                    }
                },
                error:function(response){
                    if(response.responseJSON.errors.email){

                        toastr.error(response.responseJSON.errors.email[0])

                        $("#subscribe-spinner").addClass('d-none')
                        $("#subscribeBtn").removeClass('custom-opacity')
                        $("#subscribeBtn").attr('disabled',false);

                    }
                }

            });


        })



    });

    })(jQuery);
</script>

</body>

</html>



