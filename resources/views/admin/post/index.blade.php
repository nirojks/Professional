@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',230)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',236)->first()->custom_text }} -->
    </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',237)->first()->custom_text }}
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('id',131)->first()->custom_text }}
                            </th>
                            <th width="40%">{{ $websiteLang->where('id',90)->first()->custom_text }}
                            </th>
                            <th width="5%">{{ __('Image') }}
                            </th>
                            <th width="5%">{{ __('Number') }}
                            </th>
                            <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $item->title }}</td>
                            <td> <img src="{{ $item->image ? url($item->image) : "" }}" alt="blog image" class="blog_img_width">
                            </td>
                            <td> {{ $item->number }}
                            </td>
                            <td>
                                <a href="{{ route('admin.post.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>
                                <!-- <a target="_blank" href="{{ url('blog-details/'.$item->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a> -->
                                <!-- <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a> -->
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/blog/") }}'+"/"+id)
        }

        function blogStatus(id){

            // project demo mode check
         var isDemo="{{ env('PROJECT_MODE') }}"
         var demoNotify="{{ env('NOTIFY_TEXT') }}"
         if(isDemo==0){
             toastr.error(demoNotify);
             return;
         }
         // end

            $.ajax({
                type:"get",
                url:"{{url('/admin/blog-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>
@endsection
