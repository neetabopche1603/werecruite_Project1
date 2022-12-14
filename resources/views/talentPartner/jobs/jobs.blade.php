<?php

use App\Models\AppliedJob;

?>
@extends('partials.talentPartner.app')
@section('talentPartnerTitle','View Jobs')
@section('userBreadcrumbTitle')
<span class="titlePage">View Jobs</span>
@endsection
@section('talentPartner-content')
<div class="content-body">
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
    @endif
    <!-- Notification End -->
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Welcome {{auth()->user()->name}}</h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <!-- <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Job Role</a></li>
                </ol>
            </div> -->
        </div>
        <!-- <div class="form-head d-flex mb-3  mb-lg-5   align-items-start">
            <a href="javascript:void(0);" class="btn btn-danger">+ New Job</a>
            <div class="input-group search-area ml-auto d-inline-flex">
                <input type="text" class="form-control" placeholder="Search here">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="flaticon-381-search-2"></i></span>
                </div>
            </div>
            <div class="dropdown ml-3 d-inline-block">
                <div class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                    <i class="flaticon-381-controls-3 mr-2"></i> Filter
                </div>
                <div class="dropdown-menu dropdown-menu-left">
                    <a class="dropdown-item" href="#">A To Z List</a>
                    <a class="dropdown-item" href="#">Z To A List</a>
                </div>
            </div>
            <div class="dropdown ml-3 d-inline-block">
                <div class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                    Newest
                </div>
                <div class="dropdown-menu dropdown-menu-left">
                    <a class="dropdown-item" href="#">Newest</a>
                    <a class="dropdown-item" href="#">Old</a>
                </div>
            </div>
            <a href="javascript:void(0);" class="btn btn-outline-primary ml-3"><i class="flaticon-381-menu-1 mr-0"></i></a>
            <a href="javascript:void(0);" class="btn btn-light ml-3"><i class="flaticon-381-pad mr-0"></i></a>
        </div> -->
        <h3 class="text-center text-warning mb-4 mt-4">View All Jobs</h3>
        <div class="row">
            <div class="col-xl-12">

                <div id="accordion-one" class="accordion doctor-list ">
                    <div class="accordion__item">
                        <div id="default_collapseOne" class="collapse accordion__body show" data-parent="#accordion-one">
                            <div class="widget-media best-doctor pt-4">
                                <div class="timeline row">

                                    @forelse ($jobs as $job)
                                    {{-- <div class="col-lg-6 h-100">
                                        <div class="timeline-panel bg-white p-4 mb-4">
                                            <!-- <div class="media mr-4">
                                                <img alt="image" width="90" src="images/avatar/1.jpg">
                                            </div> -->
                                            <div class="media-body">
                                                <a href="{{route('talent.job_desc',['id'=>$job->id])}}">
                                    <h4 class="mb-2">{{$job->job_title}}</h4>
                                    <p class="mb-2 text-primary">{{$job->description}}</p>
                                    </a>
                                    <!-- <div class="star-review">
                                                    <i class="fa fa-star text-orange"></i>
                                                    <i class="fa fa-star text-orange"></i>
                                                    <i class="fa fa-star text-orange"></i>
                                                    <i class="fa fa-star text-gray"></i>
                                                    <i class="fa fa-star text-gray"></i>
                                                    <span class="ml-3">451 reviews</span>
                                                </div> 
                                                $settings[0]['favicon']
                                            -->
                                    <?php
                                    $applied_job = AppliedJob::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();
                                    ?>
                                    <div class="btn d-flex justify-content-center align-content-center">
                                        @if($applied_job != null)
                                        <a href="#">
                                            <button type="button" class="btn btn-success">Applied</button>
                                        </a>
                                        @else
                                        <a href="{{ route('talent.appliedJob', ['job_id'=> $job->id]) }}">
                                            <button type="button" class="btn btn-primary">Apply Job</button>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <!-- <div class="social-media">
                                                <a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
                                                <a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
                                                <a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
                                            </div> -->

                            </div>

                        </div>--}}


                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">

                                    <a href="{{route('talent.job_desc',['id'=>$job->id])}}">
                                        <h5 class="card-title">{{$job->job_title}}</h5>
                                    </a>

                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{$job->description}}</p>
                                </div>
                                <div class="card-footer">

                                    <?php
                                    $applied_job = AppliedJob::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();
                                    ?>
                                    <div class="btn d-flex justify-content-center align-content-center">
                                        @if($applied_job != null)
                                        <a href="#">
                                            <button type="button" class="btn btn-success">Applied</button>
                                        </a>
                                        @else
                                        <a href="{{ route('talent.appliedJob', ['job_id'=> $job->id]) }}">
                                            <button type="button" class="btn btn-primary">Apply Job</button>
                                        </a>
                                        @endif
                                    </div>
                                    <!-- <a href="javascript:void()" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>

                        @empty
                        <h4 class="text-center text-primary m-5">Job Not Found</h4>
                        @endforelse
                    </div>
                </div>
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