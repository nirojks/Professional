@extends('layouts.user.profile.layout')

@section('title')
    <title>{{ $websiteLang->where('id',83)->first()->custom_text }}</title>
@endsection

@section('user-dashboard')

<!-- Page Content Holder -->
<div id="content">

    <div class="content-admin-main">


        <div class="wt-admin-right-page-header clearfix">
            <h2 class="mt-2">'{{ $listing->title }}' {{ $websiteLang->where('id',130)->first()->custom_text }}</h2>
            <div class="schedule-btn"><a href="{{ route('user.schedule.create',$listing->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('id',137)->first()->custom_text }}</a></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body wt-panel-body p-a20 bg-white">

                <div class="dashboard-my-listing-tabs dashboard-badge">
                    <table class="table table-bordered" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th width="10%">{{ $websiteLang->where('id',131)->first()->custom_text }}</th>
                                <th width="20%">{{ $websiteLang->where('id',132)->first()->custom_text }}</th>
                                <th width="20%">{{ $websiteLang->where('id',133)->first()->custom_text }}</th>
                                <th width="20%">{{ $websiteLang->where('id',134)->first()->custom_text }}</th>
                                <th width="15%">{{ $websiteLang->where('id',135)->first()->custom_text }}</th>
                                <th width="15%">{{ $websiteLang->where('id',136)->first()->custom_text }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $index => $item)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $item->day->day }}</td>
                                <td>{{ $item->start_time }}</td>
                                <td>{{ $item->end_time }}</td>

                                <td>
                                    @if ($item->status==1)
                                    <a href="" onclick="listingScheduleStatus({{ $item->id }})"><input type="checkbox" checked data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>
                                    @else
                                        <a href="" onclick="listingScheduleStatus({{ $item->id }})"><input type="checkbox" data-toggle="toggle" data-on="{{ $websiteLang->where('id',140)->first()->custom_text }}" data-off="{{ $websiteLang->where('id',141)->first()->custom_text }}" data-onstyle="success" data-offstyle="danger"></a>

                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.listing.schedule.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a onclick="return confirm('{{ $notify }}')" href="{{ route('user.listing.schedule.delete',$item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash    "></i></a>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>

</div>

<script>
    function listingScheduleStatus(id){

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
            url:"{{url('/user/listing-schedule-status/')}}"+"/"+id,
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
