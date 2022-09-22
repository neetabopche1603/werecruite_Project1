@extends('partials.admin.app')
@section('adminTitle','Screening User')
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
</style>
@endpush

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome {{$super_admin[0]['name']}}</h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Show Screening User</a></li>
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
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{--<pre>
                    {{print($appliedJobs)}}
                    </pre>--}}
                    <div class="card-header">
                        <h4 class="card-title">Show Screening User</h4>
                        <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary  float-lg-right"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Job Title</th>
                                        <th>User Name(Telent)</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Screening Schedule</th>
                                        <th>Interview Schedule</th>
                                        <th>Selected</th>
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
                                            <div class="btn text-center">
                                                <button type="button" class="btn btn-primary screening_schedule" data-id="{{$job->applied_job_id}}">Schedule</button>
                                            </div>
                                            <!-- <label class="switch">
                                                <input type="checkbox" name="screening" class="screening" data-id="{{$job->applied_job_id}}" @php if($job->screening_schedule==1) echo "checked"; @endphp>
                                                <span class="slider round"></span>
                                            </label> -->
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" name="interview" class="interview" data-id="{{$job->applied_job_id}}" @php if($job->interview_schedule==1) echo "checked"; @endphp>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" name="selected" class="selected" data-id="{{$job->applied_job_id}}" @php if($job->selected==1) echo "checked"; @endphp>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        {{-- <td>
                                        <a href="{{url('client/edit_job')}}/{{$job->id}}" class="btn btn-warning btn-sm btn-outline-light" style="background-color: #df5301; color: #fff;"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>

                                        <a href="{{url('client/delete_job')}}/{{$job->id}}" onclick="return confirm('Are you sure delete this job')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                        </td>--}}
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


<div class="modal fade" id="screeningModel" tabindex="-1" role="dialog" aria-labelledby="screeningModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="screeningModelLabel">Screening Scheduling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="date-time" class="col-form-label">Choose Date Time :</label>
                        <input type="datetime-local" class="form-control" id="dateTime">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send Mail</button>
            </div>
        </div>
    </div>
</div>

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


    $(document).ready(function() {

        $(function() {
            $(".screening_schedule").click(function() {
                let id = $(this).data('id');
                let model = $("#screeningModel");
                model.modal("show");
                model.find('#id').val(id)
                
            });
        });
    });
</script>

@endpush