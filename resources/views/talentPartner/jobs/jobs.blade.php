<?php

use App\Models\AppliedJob;

?>
@extends('partials.talentPartner.app')
@section('talentPartnerTitle','Jobs')
@section('talentPartner-content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head d-flex mb-3  mb-lg-5   align-items-start">
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
        </div>

        <div class="row">
            <div class="col-xl-12">

                <div id="accordion-one" class="accordion doctor-list ">
                    <div class="accordion__item">
                        <div id="default_collapseOne" class="collapse accordion__body show" data-parent="#accordion-one">
                            <div class="widget-media best-doctor pt-4">
                                <div class="timeline row">

                                    @forelse ($jobs as $job)
                                    <div class="col-lg-6">
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
                                            $applied_job = AppliedJob::where('job_id',$job->id)->where('user_id',auth()->user()->id)->first();
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