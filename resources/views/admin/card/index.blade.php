@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',442)->first()->custom_text }}</title>
@endsection

@section('title','Blog Category')
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="javascript:;" data-toggle="modal" data-target="#newCategory" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',444)->first()->custom_text }}
    </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',445)->first()->custom_text }}
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ $websiteLang->where('id',131)->first()->custom_text }}
                            </th>
                            <th>{{ $websiteLang->where('id',287)->first()->custom_text }}
                            </th>

                            <th>{{ $websiteLang->where('id',135)->first()->custom_text }}
                            </th>
                            <th>{{ $websiteLang->where('id',136)->first()->custom_text }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($icons as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td> <i class="{{ $item->icon }}"></i> </td>

                            <td>
                                @if ($item->status==1)
                                <a href="" onclick="blogCategoryStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}
                                    " data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}
                                    " data-onstyle="success" data-offstyle="danger"></a>
                                @else
                                    <a href="" onclick="blogCategoryStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}
                                        " data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}
                                        " data-onstyle="success" data-offstyle="danger"></a>

                                @endif
                            </td>
                            <td>
                                <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $item->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i></a>
                                <a href="javascript:;" data-toggle="modal" data-target="#updateCategory-{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit    "></i></a>


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Blog Category Modal -->
    <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $websiteLang->where('id',443)->first()->custom_text }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <form action="{{ route("admin.card-icon.store") }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ old('icon') }}">
                            </div>


                            <div class="form-group">
                                <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                                    <option value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                    <button type="submit" class="btn btn-primary">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- update Blog Category Modal -->
    @foreach ($icons as $item)
        <div class="modal fade" id="updateCategory-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">{{ $websiteLang->where('id',443)->first()->custom_text }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <form action="{{ route('admin.card-icon.update',$item->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="icon">{{ $websiteLang->where('id',287)->first()->custom_text }}</label>
                                    <input type="text" class="form-control custom-icon-picker" name="icon" id="icon" value="{{ $item->icon }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $item->status==1 ? 'selected': '' }} value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                                        <option {{ $item->status==0 ? 'selected': '' }} value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                        <button type="submit" class="btn btn-primary">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @endforeach



    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/card-icon/") }}'+"/"+id)
        }

        function blogCategoryStatus(id){
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
                url:"{{url('/admin/card-icon-status/')}}"+"/"+id,
                success:function(response){
                   toastr.success(response)
                },
                error:function(err){
                    console.log(err);

                }
            })
        }
    </script>

<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        $("#name").on("focusout",function(e){
            $("#slug").val(convertToSlug($(this).val()));
        })

        $("#edit-name").on("focusout",function(e){
            $("#edit-slug").val(convertToSlug($(this).val()));
        })

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
