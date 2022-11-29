@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ __('Posts') }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ __('Posts') }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ __('Posts') }}</span></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading wt-panel-heading p-a20">
                <h4 class="panel-tittle m-a0">{{ __('Posts') }}</h4>
            </div>

            <div class="panel-body wt-panel-body p-a20 bg-white">
            <a href="{{ route('user.create.posts') }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',528)->first()->custom_text }}</a>

                <div class="dashboard-my-listing-tabs dashboard-badge">
                    <div class="wt-tabs tabs-default">
                       
                        <div class="tab-content">


                            <div id="web-design-1" class="tab-pane active">
                               
                                    @foreach ($allPosts as $index => $post)
                                        <div class="wt-listing-container dashboard-my-listing">
                                            <div class="list-item-container posts-list m-b30 clearfix">
                                                <h4 class="listing-place-name"><a href="{{ route('listing.show',$post->slug) }}">{{ $post->title }} </a></h4>
                                                @if(isset($post->image) && !empty($post->image))
                                                <div class="list-image-box post-image bg-cover bg-no-repeat" style="background-image:url({{ $post->image ? asset($post->image) : '' }})">
                                                   
                                                   
                                                </div>
                                                @endif
                                                <p class="post-text">{{ substr($post->body, 0, 100) }}...</p> 
                                                <br>
                                                <br>
                                                <a href="{{route('user.post.details',$post->slug)}}">Read more..</a>

                                                <div class="list-category-content">
                                                    <div class="listing-logo-outer">
                                                    </div>
                                                    
                                                    <div class="list-category-edit text-right">
                                                        @if($post->user_id == auth()->user()->id)
                                                        <!-- <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.post.delete',$post->id) }}" class="bg-gray list-btn-delete"><i class="fa fa-trash"></i> {{ $websiteLang->where('id',85)->first()->custom_text }} </a> -->
                                                        <a data-toggle="modal" data-target="#deleteModal" href="javascript:;" onclick="deleteData({{ $post->id }})" class="bg-gray list-btn-delete"><i class="fa fa-trash    "></i>{{ $websiteLang->where('id',85)->first()->custom_text }}</a>

                                                        <a href="{{ route('user.post.edit',$post->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-edit"></i> {{ $websiteLang->where('id',84)->first()->custom_text }} </a>
                                                        @if($post->listing_id !=0)
                                                        <!-- <a href="{{ route('user.post.index',$post->id) }}" class="bg-gray list-btn-edit"><i class="fa fa-list"></i> {{ __('Listings') }} </a> -->
                                                        @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    @endforeach

                            </div>
                        </div>
                    </div>

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
