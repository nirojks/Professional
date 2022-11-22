
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



@php
$setting=App\Setting::first();
@endphp

@if ($setting->preloader==1)

<div id="preloader">
    <div id="status" style="background-image: url({{ url($setting->preloader_image) }})"></div>
 </div>
@endif


<script src="{{ asset('user/js/custom-preloader.js') }}"></script>
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


</body>

</html>
