@extends('partials.clientPartner.app')
@section('clientPartnerTitle','All Jobs')
@section('clientPartner-content')
@push('style')
<!-- Data Table CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome  {{auth()->user()->name}}!</h4>
                    <p class="mb-0">All Jobs</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Show Applied Job's</a></li>
                </ol>
            </div>
        </div>
        <!-- Notifications Start-->
        @if ($msg = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $msg }}</strong>
        </div>

        @elseif (Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('error') }}</strong>
        </div>

        @elseif (Session::get('delete'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('delete') }}</strong>
        </div>
        @endif
        <!-- Notifications End-->
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    {{--<pre>
                    {{print($allJobs)}}
                    </pre>--}}
                    <div class="card-header">
                        <h4 class="card-title">Show Applied Jobs</h4>
                       
                    </div>
                    <div class="card-body">
                        <table id="jobs" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Job Title</th>
                                    <th>Show All Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp

                                @foreach ($allJobs as $job)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$job->job_title}}</td>
                                    <td><a href="{{route('client.appliedJobUsers',['jobid'=>$job->id])}}" class="btn btn-btn-outline-light" style="background-color: #df5301; color: #fff;">Show All Applied Users</a></td>
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

@endsection

@push('script')
<!-- Data Table Script -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#jobs').DataTable();
    });
</script>

@endpush