@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('id',137)->first()->custom_text }}</title>
@endsection
@section('user-dashboard')

<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2 class="mt-2">'{{ $listing->title }}' {{ $websiteLang->where('id',138)->first()->custom_text }}</h2>
            <div class="schedule-btn"><a href="{{ route('user.listing.schedule.index',$listing->id) }}" class="btn btn-success btn-sm"><i class="fa fa-backward" aria-hidden="true"></i> {{ $websiteLang->where('id',142)->first()->custom_text }}</a></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 bg-white">

                <div class="dashboard-my-listing-tabs dashboard-badge">
                    <form action="{{ route('user.listing.schedule.store',$listing->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="day">{{ $websiteLang->where('id',139)->first()->custom_text }}</label>
                            <select name="day" id="day" class="form-control">
                                <option value="">{{ $websiteLang->where('id',139)->first()->custom_text }}</option>
                                @foreach ($days as $day)
                                <option value="{{ $day->id }}">{{ $day->custom_day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',133)->first()->custom_text }}</label>
                            <input type="text" name="start_time" class="form-control timepicker">
                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',134)->first()->custom_text }}</label>
                            <input type="text" name="end_time" class="form-control timepicker">
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('id',135)->first()->custom_text }}</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">{{ $websiteLang->where('id',140)->first()->custom_text }}</option>
                                <option value="0">{{ $websiteLang->where('id',141)->first()->custom_text }}</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('id',117)->first()->custom_text }}</button>
                    </form>
                </div>


            </div>
        </div>

    </div>

</div>

<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('.timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 60,
                minTime: '1',
                maxTime: '11:00pm',
                defaultTime: '10',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });

    })(jQuery);
</script>
@endsection
