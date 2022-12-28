@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',278)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',278)->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
           <form action="{{ route('admin.banner.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="">{{ $websiteLang->where('id',283)->first()->custom_text }}</label>
                <div class="my-2">
                    <img src="{{ $slider->image ? url($slider->image) : '' }}" alt="banner image" class="slider_w">
                </div>

                <label for="">{{ $websiteLang->where('id',284)->first()->custom_text }}</label>
                <input type="file" name="image" class="form-control-file">
                
            </div>

            <div class="form-group">
                <label for="status">{{ __('Slider') }}</label>
                <select name="status" id="status" class="form-control">
                    <option {{ $slider->status==1 ? 'selected' : '' }} value="1">{{ __('On') }}</option>
                    <option {{ $slider->status==0 ? 'selected' : '' }} value="0">{{ __('Off') }}</option>
                </select>
            </div>

            <button class="btn btn-success" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>

           </form>
           <br>
           <br>
          

           @if($slider->status ==1)
           <h1 class="h3 mb-2 text-gray-800"><a href="#" data-toggle="modal" data-target="#createFeature" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ __('Create Slider') }} </a></h1>

           <div class="table-responsive" id="slider_table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                            <th width="20%">{{ __('Image') }}</th>
                            <th width="5%">{{ __('Type') }}</th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slider_images as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td> <img src="{{ $item->image ? url($item->image) : "" }}" alt="slider image" class="blog_img_width">
                            </td>
                          
                            <td>
                             {{ $item->type }}
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#updateFeature-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit  "></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            
            @endif
        </div>



        
    </div>


    <div class="modal fade" id="createFeature" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('id',288)->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('Select image for slider')}}</label>
                            <!-- <div class="my-2">
                                <img src="{{ $slider->image ? url($slider->image) : '' }}" alt="banner image" class="slider_w">
                            </div> -->

                            <!-- <label for="">{{ $websiteLang->where('id',284)->first()->custom_text }}</label> -->
                            <input type="file" name="image" class="form-control-file">
                            
                        </div>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

  <!-- create feature Modal -->
  @foreach ($slider_images as $item)
        <div class="modal fade" id="updateFeature-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $websiteLang->where('id',288)->first()->custom_text }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                        <form action="{{ route('admin.slider.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="">{{ __('Existing slider image') }}</label>
                                <div class="my-2">
                                    <img src="{{ $slider->image ? url($slider->image) : '' }}" alt="banner image" class="slider_w">
                                </div>

                                <label for="">{{ __('New slider image') }}</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>
                      
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                            <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                        </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach


    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/slider/") }}'+"/"+id)
        }
    </script>

@endsection
