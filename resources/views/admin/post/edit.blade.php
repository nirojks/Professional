@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('id',230)->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.blog.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('id',241)->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('id',238)->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                   <form action="{{ route('admin.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="title">{{ __('Number') }}</label>
                        <input type="text" name="number" class="form-control" id="number" value="{{ $post->number }}">
                    </div>
                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    </script>


@endsection
