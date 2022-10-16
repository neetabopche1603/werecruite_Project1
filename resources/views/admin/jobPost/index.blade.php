<?php

use App\Models\User;

?>
@extends('partials.admin.app')
@section('adminTitle','Job Post')
@section('admin-content')
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Show all Posted Jobs </a></li>
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
                    <div class="card-header">
                        <h4 class="card-title">Show All Posted Job's </h4>
                        <a href="{{route('admin.addJobPostView')}}" class="btn btn-primary  float-lg-right"><i class="fa fa-plus" aria-hidden="true"></i> Job Post</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display text-center" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Company Name</th>
                                        <th>Job Title</th>
                                        <th>Skill</th>
                                        <th>Role</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($jobs as $key=>$job)
                                    @php
                                    $skills = implode(",",$job->skills);
                                    @endphp
                                    
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <?php
                                            if ($job->user_id == 0) {
                                                echo "Admin";
                                            } else {
                                                $user = User::find($job->user_id);
                                                echo $user->name;
                                            }
                                            ?>
                                        </td>
                                        <td>{{$job->job_title}}</td>
                                        <td>{{$skills}}</td>
                                        <td>{{$job->job_role}}</td>
                                        <td>{{wordwrap($job->description, 20)}}
                                        </td>
                                        <td>
                                            <a href="{{url('admin/edit-jobsPost')}}/{{$job->id}}" class="btn btn-warning btn-sm btn-outline-light" style="background-color: #df5301; color: #fff;"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>

                                            <a href="{{url('admin/delete-jobsPost')}}/{{$job->id}}" onclick="return confirm('Are you sure delete this job')" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>

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

@endsection
@push('script')


@endpush