@extends('layouts.user.layout')
@section('title')
    <title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection

@section('user-content')
    <div class="page-content">
        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center"    style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
            <div class="overlay-main bg-black opacity-05"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="text-white">{{ $menus->where('id',2)->first()->navbar }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                        <div>
                            <ul class="wt-breadcrumb breadcrumb-style-2">
                                <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                                <li>{{ $menus->where('id',2)->first()->navbar }}</li>
                            </ul>
                        </div>

                    <!-- BREADCRUMB ROW END -->
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->
        <!-- SECTION CONTENT START -->
        <div class="section-full small-device p-tb80 bg-white">
            <div class="container">

                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12">
                        <div class="shadow p-a30 side-bar-opposite">
                            
                            <div class="wt-searchReasult-divider"></div>

                            <div class="wt-listing-container" id="showSearchResult">
                      

                                @if ($posts->count()>0)
                                @php
                                    $colorId=1;
                                @endphp
                                @foreach ($posts as $index => $post)
                                <div class="wt-listing-container">
                                    <div class="list-item-container posts-list m-b30 clearfix">
                                        
                                    <h4 class="listing-place-name"><a href="{{ route('user.post.details',$post->slug) }}">{{ $post->title }} </a></h4>
                                    <div class="post-user">
                                    @if($post->listing_id == 0 && isset($post->user) && !empty($post->user))
                                        @if(empty($post->user->image))
                                        <img class="post-user-img" src="http://127.0.0.1:8000/uploads/custom-images/user-2021-09-08-03-05-05-9773.jpg" alt="" height="30px" width="30px"> <p style="padding-top: 5px; ">By {{ $post->user->name }}</p>
                                        @else
                                        <img class="post-user-img" src="{{ asset($post->user->image) }}" alt="" height="30px" width="30px"> <p style="padding-top: 5px; ">By {{ $post->user->name }}</p>
                                        @endif
                                    @elseif($post->listing_id != 0)
                                    <span class="listing-cat-address"><a href="{{ route('listing.show',$post->listing->slug) }}"><i class="sl-icon-layers" style="float:left; margin-right:5px; padding-top:3px;"></i><p>{{ $post->listing->title }}</p></a></span>
                                    @endif  
                                    
                                    </div>

                                    @if(isset($post->image) && !empty($post->image))
                                    <!-- <div class="listing-cat-media"><img src="{{ asset($post->image) }}" alt=""></div> -->
                                    <!-- <div class="list-image-box bg-cover bg-no-repeat" style="background-image:url({{ $post->image ? asset($post->image) : '' }})">
                                    <div> -->
                                    <div class="list-image-box post-image bg-cover bg-no-repeat" style="background-image:url({{ $post->image ? asset($post->image) : '' }})">
                                                   
                                                   
                                                   </div>
                                    @endif
                                    <p class="post-text">{{ substr($post->body, 0, 100) }}</p> 
                                    <br>
                                    <br>
                                    @if(!empty($post->body))
                                    <a href="{{route('user.post.details',$post->slug)}}">Read more..</a>
                                    @endif
                                    </div>
                                </div>
                             
                                @php
                                    $colorId++;
                                @endphp
                                @endforeach
                                @else
                                    <h4 class="text-danger py-5 text-center">{{ $websiteLang->where('id',396)->first()->custom_text }}</h4>
                                @endif
                             
                            </div>

                            <div class="pagination-bx clearfix">
                                  {{ $posts->links() }}
                            </div>
                        </div>
                    </div>




                    <!-- <div class="col-xl-4 col-lg-12 col-md-12">

                        <div class="side-bar right shadow p-a30">
                            <div class="wt-listing-sidebar-form ">
                               
                            </div>
                        </div>

                    </div> -->
                </div>

            </div>


        </div>
        <!-- SECTION CONTENT END  -->
    </div>
    <!-- CONTENT END -->


    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#sortingId").on("change",function(){
                $(".pagination-bx").addClass('d-none')
                var id=$(this).val();
              

                if(isSortingId==0){
                    var sorting_id="&sorting_id="+id;
                    query_url += sorting_id;
                }else{
                     var href = new URL(query_url);
                    href.searchParams.set('sorting_id', id);
                    query_url=href.toString()
                }

                window.location.href = query_url;
            })

        });

        })(jQuery);


    </script>
@endsection
