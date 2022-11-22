@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',9)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2>{{ $websiteLang->where('id',9)->first()->custom_text }}</h2>
            <div class="breadcrumbs"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a><a href="{{ route('user.dashboard') }}">{{ $websiteLang->where('id',68)->first()->custom_text }}</a><span>{{ $websiteLang->where('id',9)->first()->custom_text }}</span></div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',143)->first()->custom_text }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                            @foreach ($visitorReviews as $v_review)


                            <div class="dashboard-reviews-comments-box">
                                <div class="dashboard-reviews-comments-avtar"><img src="{{ $v_review->listing->logo ? asset($v_review->listing->logo) : '' }}" alt=""></div>
                                <div class="dashboard-reviews-comments-text">
                                    <h5>{{ $websiteLang->where('id',334)->first()->custom_text }} - <span><a href="{{ route('listing.show',$v_review->slug) }}">{{ $v_review->title }}</a></span><i>{{ $v_review->created_at->format('M d, Y') }}</i></h5>
                                    <div class="wt-rating-section dashboard-reviews-rating">
                                        <span class="wt-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                            @if ($i<=$v_review->rating)
                                            <i class="fa fa-star"></i>
                                            @else
                                            <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                        </span>
                                    </div>
                                    <p>{{ $v_review->comment }}</p>

                                    
                               </div>
                            </div>
                            @endforeach



                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">{{ $websiteLang->where('id',144)->first()->custom_text }}</h4>
                    </div>
                    <div class="panel-body wt-panel-body bg-white">
                        @foreach ($myReviews as $review)
                        <div class="dashboard-reviews-comments-box" id="accordion2">
                            <div class="dashboard-reviews-comments-avtar"><img src="{{ $review->listing->logo ? asset($review->listing->logo) : '' }}" alt=""></div>
                            <div class="dashboard-reviews-comments-text">
                                <h5><a href="{{ route('listing.show',$review->listing->slug) }}">{{ $review->listing->title }}</a><i>{{ $review->created_at->format('M d, Y') }}</i></h5>
                                <div class="wt-rating-section dashboard-reviews-rating">
                                    <span class="wt-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i<=$review->rating)
                                            <i class="fa fa-star"></i>
                                            @else
                                            <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </div>
                                <p>{{ $review->comment }}</p>

                                <a data-toggle="collapse" href="#collapseOne-{{ $review->id }}" data-parent="#accordion2"  class="bg-gray list-btn-edit"><i class="fa fa-edit"></i>  {{ $websiteLang->where('id',84)->first()->custom_text }} </a>
                                <a href="{{ route('user.delete-review',$review->id) }}" onclick="return confirm('{{ $notify }}')"  class="bg-danger list-btn-edit"><i class="fa fa-trash"></i>  {{ $websiteLang->where('id',85)->first()->custom_text }} </a>

                                <div id="collapseOne-{{ $review->id }}" class="acod-body collapse m-t20">
                                    <div class="acod-content">
                                        <form action="{{ route('user.update-review',$review->id) }}" method="POST">
                                            @csrf
                                        <div class="dashboard-message-reply-textarea">

                                            <div class="form-group wt-input-icon">
                                                <div class="input-group">
                                                    <i class="input-group-addon fa fa-star "></i>
                                                    <select name="rating" id="" class="form-control">
                                                        <option {{ $review->rating==1 ? 'selected' : '' }} value="1">1</option>
                                                        <option {{ $review->rating==2 ? 'selected' : '' }} value="2">2</option>
                                                        <option {{ $review->rating==3 ? 'selected' : '' }} value="3">3</option>
                                                        <option {{ $review->rating==4 ? 'selected' : '' }} value="4">4</option>
                                                        <option {{ $review->rating==5 ? 'selected' : '' }} value="5">5</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-group wt-input-icon">
                                                <div class="input-group">
                                                    <i class="input-group-addon fa fa-pencil v-align-t "></i>
                                                    <textarea aria-required="true" rows="4" cols="45" name="comment"   class="form-control">{{ $review->comment }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-submit m-t10">
                                                <button class="site-button" type="submit">{{ $websiteLang->where('id',118)->first()->custom_text }}</button>
                                            </div>
                                        </div>
                                    </form>
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

@endsection
