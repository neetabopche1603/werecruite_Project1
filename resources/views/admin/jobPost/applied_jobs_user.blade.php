<?php

use App\Models\Scheduler;
?>
@extends('partials.admin.app')
@section('adminTitle','Screening Users|Show All Screening Users')
@section('titlePage')
   <span class="titlePage">Screening Users|Show All Screening Users</span>
@endsection
@section('admin-content')

@push('style')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #450b5a;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #450b5a;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .dateSelect {
        border: 1px solid black;
        border-radius: 20px;
        background-color: #450b5a !important;
        padding: 10px;
        color: #fff !important;
        text-align: center !important;
    }
</style>
@endpush

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Welcome {{$super_admin[0]['name']}}</h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Show All Screening Users</a></li>
                </ol>
            </div>
        </div>

        <!-- Notification Start -->
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

        @elseif (Session::get('error'))
        <div class="alert alert-danger solid alert-rounded alert-dismissible fade show" role="alert">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <strong>{{session::get('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @elseif (Session::get('delete'))
        <div class="alert alert-danger solid alert-rounded alert-dismissible fade show" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <strong>{{session::get('delete')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif
        <!-- Notification End -->
{{--<pre>
    {{
        print_r($appliedJobs->toArray())
    }}
</pre>--}}
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Show All Screening Users</h4>
                        <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary  float-lg-right"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display text-center" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Job Title</th>
                                        <th>User Name(Talent)</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Change Status</th>
                                        <th>Status</th>
                                        <th>User Activity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp

                                    @foreach ($appliedJobs as $job)

                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$job->job_title}}</td>
                                        <td>{{$job->name}}</td>
                                        <td>{{$job->mobile_no}}</td>
                                        <td>{{$job->email}}</td>
                                       
                                        <td>
                                            <?php $schedule = Scheduler::where('job_id', $job->jobId)->where('user_id', $job->user_id)->first();
                                            ?>

                                            {{--@if ($schedule != '')
                                        @if ($schedule->user_sche_date == NULL && $schedule->actual_sche_date == NULL)
                                        <div class="btn text-center">
                                            <button type="button" class="btn btn-secondary btn-sm">Email Send</button>
                                        </div>
                                        @elseif ($schedule->user_sche_date != NULL && $schedule->actual_sche_date == NULL)
                                        <div class="btn text-center">
                                                                <button type="button" class="btn btn-warning btn-sm checkDate" data-id="{{$job->user_id}}" data-jobid="{{$job->jobId}}">Check User Availability</button>
                        </div>
                        @elseif ($schedule->user_sche_date == NULL && $schedule->actual_sche_date != NULL)
                        <div class="btn text-center">
                            <button type="button" class="btn btn-success btn-sm">Screening Scheduled</button>
                        </div>
                        @endif
                        @else
                        <div class="btn text-center">
                            <button type="button" class="btn btn-primary btn-sm screening_schedule" data-id="{{$job->user_id}}" data-jobid="{{$job->jobId}}">Schedule</button>
                        </div>
                        @endif --}}


                        <div class="btn text-center">
                            <button type="button" class="btn btn-primary btn-sm changeStatus" data-id="{{$job->user_id}}" data-jobid="{{$job->jobId}}" data-appliedjobid="{{$job->applied_job_id}}">Change Status</button>
                        </div>

                        <!-- <label class="switch">
                                                <input type="checkbox" name="screening" class="screening" data-id="{{$job->applied_job_id}}" @php if($job->screening_schedule==1) echo "checked"; @endphp>
                                                <span class="slider round"></span>
                                            </label> -->

                        </td>

                        <td><span class="badge badge-info">{{ucfirst($job->adminChangeStatus)}}</span></td>
                        <td>
                            <?php
                            $checkAvailability = Scheduler::where('job_id', $job->jobId)->where('user_id', $job->user_id)->select('user_sche_date', 'actual_sche_date')->first();
                            ?>
                            @if ($checkAvailability != null)
                            @if ($checkAvailability->user_sche_date != "" && $checkAvailability->user_sche_date != null)
                            <div class="btn text-center">
                                <button type="button" class="btn btn-warning btn-sm checkDate w-100" data-id="{{$job->user_id}}" data-jobid="{{$job->jobId}}">Check User Availability</button>
                            </div>
                            @elseif ($checkAvailability != null || $checkAvailability->actual_sche_date != "" && $checkAvailability->actual_sche_date != null)
                            <div class="btn text-center">
                                <button type="button" class="btn btn-secondary btn-sm checkDate w-100" data-id="{{$job->user_id}}" data-jobid="{{$job->jobId}}" disabled>Check User Availability</button>
                            </div>
                            
                            @endif
                            @else
                            No Activity                

                            @endif
                            <!-- Check Availiblity -->
                        </td>

                        {{-- <td>
                            <label class="switch">
                                <input type="checkbox" name="interview" disabled class="interview btn-sm" data-id="{{$job->applied_job_id}}" @php if($job->interview_schedule==1) echo "checked"; @endphp>
                        <span class="slider round"></span>
                        </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" name="selected" class="selected" data-id="{{$job->applied_job_id}}" @php if($job->selected==1) echo "checked"; @endphp>
                                <span class="slider round"></span>
                            </label>
                        </td> --}}
                       
                        <td>
                        <a href="{{url('admin/delete-screeningss-job')}}/{{$job->applied_job_id}}" onclick="return confirm('Are you sure delete this Data')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

</div>
</div>

<!-- Screening Model -->
<div class="modal fade" id="screeningModel" tabindex="-1" role="dialog" aria-labelledby="screeningModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="screeningModelLabel">Screening Scheduling</h5>
                <button type="button" class="close interviewModelClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/schedule-interview">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="job_id" id="job_id">
                    <input type="hidden" name="applied_job_id" id="applied_job_id">
                    <div class="form-group">
                        <label for="date-time" class="col-form-label">Title :</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label for="date-time" class="col-form-label">Choose Date Time :</label>
                        <!-- <input type="datetime-local" name="date" class="form-control" id="dateTime"> -->
                        <input type="text" id="date-format" name="date" class="form-control" placeholder="Pick Interview Date Time">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary interviewModelClose" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Mail</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Screening Model End-->

<!-- CheckDate Model -->
<div class="modal fade" id="checkDate" tabindex="-1" role="dialog" aria-labelledby="checkDateModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkDateModelLabel">Select User Prefered Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id1" id="user_id1">
                    <input type="hidden" name="job_id1" id="job_id1">

                    <ul id="dates">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveDate">Schedule Date</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- CheckDate Model End-->

<!-- Change Status Model -->
<div class="modal fade" id="statusChange" tabindex="-1" role="dialog" aria-labelledby="statusChangeModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusChangeModelLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" id="changeStatusForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id2" id="user_id2">
                    <input type="hidden" name="job_id2" id="job_id2">
                    <input type="hidden" name="applied_job_id2" id="applied_job_id2">

                    <div class="form-group">
                        <label class="col-form-label">Change Status :</label>
                        <select name="changeStatusvalue" id="changeStatusDb" class="form-control changeStatasselect">
                            <option value="">Select</option>
                            <option value="processing">Processing</option>
                            <option value="interview_schedule">Interview Schedule</option>
                            <option value="selected">Selected</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateStatus">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Change Status Model End-->



@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('#jobs').DataTable();
    });
    // let screening = $('.screening').is(':checked')
    // let interview = $('.interview').is(':checked')
    // let selected = $('.selected').is(':checked')

    // $(screening).each(function(){

    // })


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.screening').on('click', function() {
        let checked = $(this).is(':checked')
        let status
        if (checked) {
            status = 1;
        } else {
            status = 0;
        }
        let applied_job_id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: "{{route('admin.screening')}}",
            data: {
                'checked': status,
                'applied_job_id': applied_job_id
            },
            success: function(result) {
                // console.log(result)
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: 'Screening Status Updated.',
                    showConfirmButton: true,
                    // timer: 3000
                })
            }
        });
    })

    // interview script
    $('.interview').on('click', function() {
        let checked = $(this).is(':checked')
        let status
        if (checked) {
            status = 1;
        } else {
            status = 0;
        }
        let applied_job_id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: "{{route('admin.interview')}}",
            data: {
                'checked': status,
                'applied_job_id': applied_job_id
            },
            success: function(result) {
                // console.log(result)
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: 'Interview Status Updated.',
                    showConfirmButton: true,
                    // timer: 3000
                })
            }
        });
    })

    // selected script
    $('.selected').on('click', function() {
        let checked = $(this).is(':checked')
        let status
        if (checked) {
            status = 1;
        } else {
            status = 0;
        }
        let applied_job_id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: "{{route('admin.selected')}}",
            data: {
                'checked': status,
                'applied_job_id': applied_job_id
            },
            success: function(result) {
                // console.log(result)
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: 'Selected Status Updated.',
                    showConfirmButton: true,
                    // timer: 3000
                })
            }
        });
    })
</script>

<!-- Screening Schedule Process -->
<script>
    // $('.screening_schedule').datetimepicker({
    //     format: 'DD/MM/YYYY HH:mm:ss',
    //     defaultDate: new Date(),
    // });


    $(document).on('click', '.changeStatus', function() {
        let user_id = $(this).data('id');
        let job_id = $(this).data('jobid');
        let appliedJobId = $(this).data('appliedjobid');
        // console.log(appliedJobId)
        let model = $("#statusChange");
        model.modal("show");
        model.find('#user_id2').val(user_id);
        model.find('#applied_job_id2').val(appliedJobId);
        model.find('#job_id2').val(job_id);
        let data;
        $(document).on('change', '#changeStatusDb', function() {
            let selectBox = $(this);
            data = $(this).val();
            if (data === 'interview_schedule') {
                interviewShedule(user_id, job_id, appliedJobId)
                model.modal("hide");
                $('#changeStatusForm')[0].reset();
                selectBox.val("").change();
            }
            // interviewModelClose
            // rejected
            // selected
            // interview_schedule
            // processing
        });

        $(document).on('click', '#updateStatus', function() {
            $.ajax({
                type: "POST",
                url: "{{route('admin.adminChangeStatus')}}",
                data: {
                    'status': data,
                    'applied_job_id': appliedJobId,
                    'user_id': user_id,
                    'job_id': job_id
                },
                success: function(result) {
                    // console.log(result)
                    if (result.status === 'success') {
                        model.modal("hide");
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Status Updated.',
                            showConfirmButton: true,
                            // timer: 3000
                        })
                        // alert('Status Updated.')
                        setTimeout(function() {
                            location.reload();
                        }, 1500)
                    }
                }
            });
        })

        // $(document).on('click', '.interviewModelClose', function() {
        //     model.modal("show");
        // });
    });

    function interviewShedule(userid, jobId, appliedJobid) {
        let user_id = userid;
        let job_id = jobId;
        let appliedjobIdUser = appliedJobid;
        let model = $("#screeningModel");
        model.modal("show");
        model.find('#user_id').val(user_id)
        model.find('#applied_job_id').val(appliedjobIdUser)
        model.find('#job_id').val(job_id)

    }

    // function interviewShedule() {
    //     $(".screening_schedule").click(function() {
    //         let user_id = $(this).data('id');
    //         let job_id = $(this).data('jobid');
    //         let model = $("#screeningModel");
    //         model.modal("show");
    //         model.find('#user_id').val(user_id)
    //         model.find('#job_id').val(job_id)

    //     });
    // }


    $(document).on('click', '.date', function() {
        $('.date').removeClass('selected')
        $(this).addClass('selected');
        $('.date').removeClass('dateSelect')
        $(this).addClass('dateSelect');
    })

    $(document).ready(function() {
        $(".checkDate").click(function() {
            let user_id = $(this).data('id');
            let job_id = $(this).data('jobid');
            $.ajax({
                type: "post",
                url: "{{route('admin.checkUserDate')}}",
                data: {
                    'user_id': user_id,
                    "job_id": job_id
                },
                success: function(result) {
                    let datas = JSON.parse(result)
                    let html = '';
                    $.each(datas, function(i) {
                        // console.log(datas[i]);
                        let dateval = new Date(datas[i])
                        start_date = dateval.toLocaleString();
                        html += `<li>
                                <div class="form-group">
                                    <label for="date-time" class="col-form-label">Select Date :</label>
                                    <a href="javascript:void(0)" class="date form-control" data-date="${datas[i]}">${datas[i]}</a>
                                </div>
                            </li>`
                    })

                    let model = $("#checkDate");
                    model.modal("show");
                    model.find('#user_id1').val(user_id)
                    model.find('#job_id1').val(job_id)
                    model.find('#dates').html(html)
                }
            });

        })
    });

    $('#saveDate').on('click', function() {
        let btn = $(this)
        let user_id = $('#user_id1').val();
        let job_id = $('#job_id1').val();
        let getClass = $('#dates li').find('.selected')
        if (getClass.length != 0) {
            let interviewDate = getClass.data('date');
            $.ajax({
                type: "post",
                url: "{{route('admin.scheduleInterviewSelectedDate')}}",
                data: {
                    "user_id": user_id,
                    "job_id": job_id,
                    "date": interviewDate
                },
                beforeSend: function() {
                    btn.css('background-color', 'red')
                    btn.attr('disabled', true)
                    btn.html('Sending...')
                },
                success: function(response) {
                    if (response.status == 'success') {
                        // alert("Screening Scheduled.");
                        alert("Interview Scheduled.");
                        setTimeout(function() {
                            location.reload();
                        }, 500)
                    }
                }
            });
        } else {
            alert('Please Select Any One Date.')
        }
    });
</script>

@endpush