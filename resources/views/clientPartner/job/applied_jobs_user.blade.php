@extends('partials.clientPartner.app')
@section('clientPartnerTitle','Applied Jobs')
@section('clientPartner-content')
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
                    <h4>Hi, Welcome {{auth()->user()->name}}</h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Show Applied Job's</a></li>
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
                        <h4 class="card-title">Show All Applied Users</h4>
                        <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary btn-outline-light float-lg-right" style="background-color: #450b5a; color: #fff;"><i class="fa fa-backward"></i> Back</a>
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
                                    <th>Screening User</th>
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
                                        <label class="switch">
                                            <input type="checkbox" name="screening" class="screening" data-id="{{$job->applied_job_id}}" @php if($job->status==1) echo "checked"; @endphp>
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

@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('#jobs').DataTable();
    });

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
            url: "{{route('client.jobStatus')}}",
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
</script>

@endpush