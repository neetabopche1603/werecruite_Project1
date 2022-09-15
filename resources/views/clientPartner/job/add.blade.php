@extends('partials.clientPartner.app')
@section('clientPartnerTitle','Add Job')
@section('clientPartner-content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome  {{auth()->user()->name}}!</h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Job's</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Job Form</h4>
                        <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary btn-outline-light float-lg-right" style="background-color: #450b5a; color: #fff;"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('client.jobAddStore')}}" method="post" id="step-form-horizontal" class="step-form-horizontal">
                            @csrf
                            <div>
                                <!-- <h4>Personal Info</h4> -->
                                <section>
                                    <div class="row">
                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Job Tilte :</b></label>
                                                <input type="text" name="job_title" class="form-control" placeholder="Job Title">
                                                <span class="text-danger">
                                                    @error('job_title')
                                                        {{$message}}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Skill:</b></label>
                                                <select multiple class="form-control" name="skill[]" id="sel2">
                                                    @foreach ($skills as $skill )
                                                    <option value="{{$skill->id}}">{{$skill->skill}}</option>
                                                    @endforeach
                                                </select>

                                                <!-- <input type="text" name="skill" class="form-control" placeholder="Skill"> -->
                                                <span class="text-danger">
                                                    @error('skill')
                                                        {{$message}}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Role:</b></label>
                                                <select class="form-control" name="job_role" id="">
                                                    <option value="AL">--Choose Job Role--</option>
                                                    @foreach ($jobRole as $jRole )
                                                    <option value="{{$jRole->id}}">{{$jRole->job_role}}</option>
                                                    @endforeach
                                                </select>
                                                <!-- <input type="text" name="job_role" class="form-control" placeholder="Role"> -->
                                                <span class="text-danger">
                                                    @error('job_role')
                                                        {{$message}}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Description:</b></label>
                                                <textarea class="form-control input-default" name="description" placeholder="Type your description..."></textarea>
                                                <span class="text-danger">
                                                    @error('description')
                                                        {{$message}}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                    
                                    </div>
                                </section>
                            </div>
                            <input type="submit" class="btn btn-primary btn-outline-light text-light" style="background-color: #450b5a;" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection