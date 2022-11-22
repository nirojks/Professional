@extends('layouts.user.layout')
@section('title')
    <title>{{ $blog->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $blog->seo_description }}">
@endsection

@section('user-content')
<!-- CONTENT START -->
<div class="page-content ">
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-center"  style="background-image:url({{ $image->image ? asset($image->image) : '' }});">
        <div class="overlay-main bg-black opacity-05"></div>
        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="text-white">{{ $blog->title }}</h2>
                    </div>
                </div>
                <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li><a href="{{ route('blog') }}">{{ $menus->where('id',7)->first()->navbar }}</a></li>
                            <li>{{ $blog->title }}</li>
                        </ul>
                    </div>

                <!-- BREADCRUMB ROW END -->
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

    <!-- SECTION CONTENT START -->
    <div class="section-full small-device  p-tb80 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                   <!-- BLOG START -->
                     <div class="blog-post blog-md date-style-1 blog-list-1 clearfix  m-b60 bg-white" >
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="javascript:;"><img src="{{ asset($blog->feature_image) }}" alt=""></a>
                        </div>
                        <div class="wt-post-info  bg-white p-t30">
                            <div class="wt-post-meta ">
                                <ul>
                                    <li class="post-date"><i class="fa fa-calendar-o site-text-secondry"></i><span>{{ $blog->created_at->format('M d Y') }}</span></li>
                                    @if ($commentSetting->comment_type==1)
                                    <li class="post-comment"><i class="fa fa-commenting-o site-text-secondry"></i><a href="javascript:void(0);">{{ $blog->comments->where('status',1)->count() }} {{ $websiteLang->where('id',46)->first()->custom_text }}</a> </li>
                                    @endif
                                    <li class="post-view-user"><i class="fa fa-eye site-text-secondry"></i><a href="javascript:void(0);">{{ $blog->view }} {{ $websiteLang->where('id',49)->first()->custom_text }}</a> </li>
                                    <li class="post-catagory"><i class="fa fa-tags site-text-secondry"></i><a href="{{ route('blog.category',$blog->category->slug) }}">{{ $blog->category->name }} </a> </li>
                                </ul>
                            </div>
                            <div class="wt-post-title ">
                                <h3 class="post-title">{{ $blog->title }}</h3>
                            </div>

                            <div class="wt-post-text">
                            {!! clean($blog->description) !!}
                            </div>
                        </div>

                    </div>

                    @if ($commentSetting->comment_type==1)
                    <div class="clear bg-white shadow p-a30" id="comment-list">
                        <div class="comments-area" id="comments">
                            @if ($blog->comments->where('status',1)->count() >0)
                            <h2 class="comments-title m-t0">{{ $blog->comments->where('status',1)->count() }} {{ $websiteLang->where('id',46)->first()->custom_text }}</h2>
                            @endif
                            <div>
                                <!-- COMMENT LIST START -->
                                <ol class="comment-list">
                                    @foreach ($blog->comments->where('status',1) as $comment)
                                    <li class="comment">
                                        <!-- COMMENT BLOCK -->
                                        <div class="comment-body bg-orange-light">
                                            <div class="comment-author vcard">
                                                <img  class="avatar photo" src="{{ $default_image->image ? asset($default_image->image) : '' }}" alt="">
                                                <cite class="fn">{{ $comment->name }}</cite>
                                            </div>
                                            <div class="comment-meta">
                                                <a href="javascript:void(0);">{{ $comment->created_at->format('M d Y') }}</a>
                                            </div>
                                            <p>{{ $comment->comment }}</p>

                                      </div>
                                    </li>

                                    @endforeach



                                </ol>
                                <!-- COMMENT LIST END -->

                                <!-- LEAVE A REPLY START -->
                                <div class="comment-respond m-t30 p-a20 bg-orange-light" id="respond">

                                    <h2 class="comment-reply-title" id="reply-title">{{ $websiteLang->where('id',48)->first()->custom_text }}
                                    </h2>

                                    <form class="comment-form" id="commentform" method="post" action="{{ route('blog.comment',$blog->id) }}">
                                        @csrf
                                        <p class="comment-form-author">
                                            <input class="form-control" type="text" value="{{ old('name') }}" name="name" placeholder="{{ $websiteLang->where('id',37)->first()->custom_text }}">
                                        </p>

                                        <p class="comment-form-email">
                                            <input class="form-control" type="text" value="{{ old('email') }}" name="email" placeholder="{{ $websiteLang->where('id',38)->first()->custom_text }}"  id="email">
                                        </p>

                                        <p class="comment-form-url">
                                            <input class="form-control" type="text"  value="{{ old('phone') }}"  name="phone"   placeholder="{{ $websiteLang->where('id',39)->first()->custom_text }}" id="phone">
                                        </p>

                                        <p class="comment-form-comment">
                                            <textarea class="form-control" rows="8" name="comment" placeholder="{{ $websiteLang->where('id',46)->first()->custom_text }}" id="comment"></textarea>
                                        </p>
                                        <p class="comment-form-comment">
                                            @if($commentSetting->allow_captcha==1)
                                            <p class="g-recaptcha" data-sitekey="{{ $commentSetting->captcha_key }}"></p>
                                            @endif
                                        </p>
                                        <p class="form-submit">
                                            <button class="site-button-secondry site-btn-effect" type="submit">{{ $websiteLang->where('id',47)->first()->custom_text }}</button>
                                        </p>

                                    </form>

                                </div>
                                <!-- LEAVE A REPLY END -->
                           </div>
                        </div>
                    </div>
                    @else
                    <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="10"></div>
                    @endif
                    <!-- BLOG END -->

                </div>
                <!-- SIDE BAR START -->
                <div class="col-lg-4 col-md-12 col-sm-12">

                    <aside  class="side-bar">

                            <!-- SEARCH -->
                            <div class="widget bg-white bg-white">

                                <div class="text-left m-b30">
                                    <h4 class="widget-title">{{ $websiteLang->where('id',50)->first()->custom_text }}</h4>
                                    <div class="wt-separator sep-gradient-light"></div>
                                </div>
                                <div class="search-bx">
                                    <form role="search" method="get" action="{{ route('blog.search') }}">
                                        <div class="input-group">
                                            <input name="search" type="text" class="form-control" placeholder="{{ $websiteLang->where('id',1)->first()->custom_text }}">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- CATEGORY -->
                           <div class="widget bg-white  widget_services">
                                <div class="text-left m-b30">
                                    <h4 class="widget-title">{{ $websiteLang->where('id',51)->first()->custom_text }}</h4>
                                    <div class="wt-separator sep-gradient-light"></div>
                                </div>
                                <ul>
                                    @foreach ($blogCategories as $blogCategory)
                                        <li><a href="{{ route('blog.category',$blogCategory->slug) }}">{{ $blogCategory->name }}</a><span class="badge">{{ $blogCategory->blogs->count() }}</span></li>
                                    @endforeach


                                </ul>
                            </div>

                            <!-- RECENT POSTS -->
                            <div class="widget bg-white  recent-posts-entry">
                                <div class="text-left m-b30">
                                    <h4 class="widget-title">{{ $websiteLang->where('id',52)->first()->custom_text }}</h4>
                                    <div class="wt-separator sep-gradient-light"></div>
                                </div>
                                <div class="section-content">
                                    <div class="widget-post-bx">
                                        @foreach ($popularBlogs as $blog)
                                        <div class="widget-post clearfix">
                                            <div class="wt-post-media">
                                                <img src="{{ asset($blog->thumbnail_image) }}" alt="">
                                            </div>
                                            <div class="wt-post-info">
                                                <div class="wt-post-header">
                                                    <h6 class="post-title"><a href="{{ route('blog.details',$blog->slug) }}">{{ $blog->title }}</a></h6>
                                                </div>
                                                <div class="wt-post-meta">
                                                    <ul>
                                                        <li class="post-author">{{ $blog->created_at->format('M d Y') }}</li>
                                                        <li class="post-comment"> {{ $blog->comments->where('status',1)->count() }} {{ $websiteLang->where('id',46)->first()->custom_text }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>



                            <!-- Social -->
                            <div class="widget bg-white">
                                <div class="text-left m-b30">
                                    <h4 class="widget-title">{{ $websiteLang->where('id',53)->first()->custom_text }}</h4>
                                    <div class="wt-separator sep-gradient-light"></div>
                                </div>
                                <div class="widget_social_inks">
                                    <ul class="social-icons social-square social-darkest social-md">
                                        @if ($contact_us->facebook)
                            <li>
                                <a href="{{ $contact_us->facebook }}" class="fab fa-facebook"></a>
                            </li>
                            @endif
                           @if ($contact_us->twitter)
                            <li>
                                <a href="{{ $contact_us->twitter }}" class="fab fa-twitter"></a>
                            </li>
                           @endif
                           @if ($contact_us->linkedin)
                           <li>
                            <a href="{{ $contact_us->linkedin }}" class="fab fa-linkedin"></a>
                        </li>
                           @endif
                           @if ($contact_us->youtube)
                            <li>
                                <a href="{{ $contact_us->youtube }}" class="fab fa-youtube"></a>
                            </li>
                           @endif
                           @if ($contact_us->instagram)
                            <li>
                                <a href="{{ $contact_us->instagram }}" class="fab fa-instagram"></a>
                            </li>
                           @endif
                                    </ul>
                                </div>
                            </div>

                       </aside>

                </div>
                <!-- SIDE BAR END -->
            </div>



        </div>
    </div>
    <!-- SECTION CONTENT END -->

</div>
<!-- CONTENT END -->

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId={{ $commentSetting->facebook_comment_script }}&autoLogAppEvents=1" nonce="MoLwqHe5"></script>
@endsection
