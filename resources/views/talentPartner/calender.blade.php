<?php

use Illuminate\Support\Carbon;
?>
@extends('partials.talentPartner.app')
@section('talentPartnerTitle','Telent Home')
@section('talentPartner-content')
<!-- Calendar CSS -->
<link href="{{asset('admin/vendor/fullcalendar/css/fullcalendar.min.css')}}" rel="stylesheet">
<link href="{{asset('admin/css/icomoon.css')}}" rel="stylesheet">
<div class="content-body">
    {{--
        <pre>
    {{print_r($schedules->toArray())}}
    {{ die(); }}
    </pre> 
        --}}
     
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Welcome {{auth()->user()->name}}</h4>
                    <p class="mb-0">InterView Schedule List and Calendar</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Schedule Calendar</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <!-- -- Notification Start -- -->
        @if(Session::get('success'))
        <div class="alert alert-success solid alert-rounded alert-dismissible fade show" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <strong>{{session::get('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <!-- -- Notification End -- -->

        <!-- Show Interview Schedule List -->
        <div class="card-body shadow p-3 mb-5 bg-white rounded">
            <div class="table-responsive">
                <!-- <table class="table table-bordered table-hover table-striped text-center"> -->
                <table id="example" class="display text-center" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Company Name</th>
                            <th>Interview Title</th>
                            <th>Job Title</th>
                            <th>Interview Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach ($schedules as $schedule)

                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>
                                @if ($schedule->user_ids !== NULL)
                                {{ $schedule->company_name }}
                                @else
                                Werecuite
                                @endif
                            </td>
                            <td>{{$schedule->title}}</td>
                            <td>{{$schedule->job_title}}</td>
                            <td>@if ($schedule->actual_sche_date != NULL)
                                <!-- {{Carbon::parse($schedule->actual_sche_date)->format('d M Y g:h A')}} -->
                                {{Carbon::parse($schedule->actual_sche_date)->format('d-m-Y H:i')}}
                                @elseif($schedule->user_sche_date != NULL)
                                <a href="javascript:void(0)" class="btn btn-success">Date Successfully Send</a>
                                @else
                                <a href="javascript:void(0)" class="btn btn-primary interviewDateChoose" data-id="{{$schedule->user_id}}" data-jobid="{{$schedule->job_id}}">ReSchedule Date</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <h3 class="text-primary mt-4 mb-4"> Show InterView Calendar </h3>
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar" class="app-fullcalendar"></div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<div class="modal fade" id="interviewDateChoose" tabindex="-1" role="dialog" aria-labelledby="interviewDateChooseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interviewDateChooseLabel">Interview Date Scheduling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('talent.setInterviewDate')}}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="job_id" id="job_id">

                    <div class="form-group">
                        <label for="date-time" class="col-form-label">First Date Time :</label>
                        <!-- <input type="datetime-local" name="date[]" class="form-control" id="dateTime1"> -->
                        <input type="text" id="date-format1" name="date[]" class="form-control" placeholder="Pick Interview Date Time">
                    </div>

                    <div class="form-group">
                        <label for="date-time" class="col-form-label">Second Date Time :</label>
                        <!-- <input type="datetime-local" name="date[]" class="form-control" id="dateTime2"> -->
                        <input type="text" id="date-format2" name="date[]" class="form-control" placeholder="Pick Interview Date Time">
                    </div>

                    <div class="form-group">
                        <label for="date-time" class="col-form-label">Third Date Time :</label>
                        <!-- <input type="datetime-local" name="date[]" class="form-control" id="dateTime3"> -->
                        <input type="text" id="date-format3" name="date[]" class="form-control" placeholder="Pick Interview Date Time">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="{{asset('admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
<!--removeIf(production)-->
<script src="{{asset('admin/vendor/jqueryui/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/vendor/fullcalendar/js/fullcalendar.min.js')}}"></script>
<!-- <script src="{{asset('admin/js/plugins-init/fullcalendar-init.js')}}"></script> -->


<script>
    $(document).ready(function() {
        // var date = new Date();
        // var d = date.getDate();
        // var m = date.getMonth();
        // var y = date.getFullYear();
        // var form = '';
        // var today = new Date($.now());
        let eventData
        $.ajax({
            type: "GET",
            url: "{{route('talent.getEvents')}}",
            success: function(result) {
                // $.each(result, function(i, val) {
                //     eventData = result[i]
                // })
                // console.log(eventData)
                var calendar = $('#calendar').fullCalendar({
                    defaultView: 'month',
                    handleWindowResize: true,
                    height: $(window).height() - 200,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: result,

                    timeFormat: 'h(:mm A)',
                });

            }
        });
    });

    $(document).ready(function() {
        $(function() {
            $(".interviewDateChoose").click(function() {
                let user_id = $(this).data('id');
                let job_id = $(this).data('jobid');
                let model = $("#interviewDateChoose");
                model.modal("show");
                model.find('#user_id').val(user_id)
                model.find('#job_id').val(job_id)
            });
        });
    });
</script>
@endpush