@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',73)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">

        <div class="wt-admin-right-page-header clearfix">
            <h2 class="mt-2">'{{ $listing->title }}' {{ $websiteLang->where('id',130)->first()->custom_text }}</h2>
            <div class="schedule-btn"><a href="{{ route('user.post.create',$listing->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',528)->first()->custom_text }}</a></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 bg-white">

                <div class="dashboard-my-listing-tabs dashboard-badge">
                    <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th width="10%">{{ $websiteLang->where('id',90)->first()->custom_text }}</th>
                                <th width="10%">{{ __('Listing') }}</th>
                                <th width="10%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $index => $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->listing->title }}</td>
                                <td>
                                    <a href="{{ route('user.post.details',$post->slug) }}" class="btn btn-success btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                    <a href="{{ route('user.post.edit',$post->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit    "></i></a>
                                     <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $post->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash    "></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $posts->links() }}
                </div>


            </div>
        </div>

    </div>

</div>

  <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Are you sure you want to delete this post?</h4>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $websiteLang->where('id',7)->first()->custom_text }}</button>
                <button type="submit" class="btn btn-primary">{{ $websiteLang->where('id',123)->first()->custom_text }}</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("user/delete-post") }}'+"/"+id)
        }
</script>

@endsection
