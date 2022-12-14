@extends('partials.clientPartner.app')
@section('clientPartnerTitle','Post Job |Edit Job')
@section('clientBreadcrumbTitle')
   <span class="titlePage">Post Job |Edit Job</span>
@endsection
@section('clientPartner-content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Welcome {{auth()->user()->name}}!</h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Jobs</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-10 col-xxl-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Job</h4>
                        <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary btn-outline-light float-lg-right" style="background-color: #450b5a; color: #fff;"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('client.jobUpdate')}}" method="post" id="step-form-horizontal" class="step-form-horizontal">
                            @csrf
                            <input type="hidden" name="id" value="{{$jobEditViews->id}}">
                            <div>
                                <!-- <h4>Personal Info</h4> -->
                                <section>
                                    <div class="row">
                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Job Tilte :</b></label>
                                                <input type="text" name="job_title" value="{{$jobEditViews->job_title}}" class="form-control" placeholder="Job Title" required>
                                            </div>
                                        </div>
                                        <?php
                                        $skillArr = json_decode($jobEditViews->skill);
                                        ?>
                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Skill :</b></label>
                                                <select multiple class="form-control" name="skill[]" id="sel2">
                                                    @foreach ($skills as $skil )
                                                    <option value="{{$skil->id}}" {{$skil->id == in_array($skil->id,$skillArr) ? 'selected' : ''}}>{{$skil->skill}}</option>
                                                    @endforeach
                                                </select>
                                                <!-- <input type="text" name="skill" value="{{$jobEditViews->skill}}" class="form-control" placeholder="Skill" required> -->
                                            </div>
                                        </div>

                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Role:</b></label>
                                                <select class="form-control" name="job_role" id="">
                                                    <option value="AL">--Choose Job Role--</option>
                                                    @foreach ($jobRole as $jRole )
                                                    <option value="{{$jRole->id}}" {{$jRole->id == $jobEditViews->id ? 'selected' : ''}}>{{$jRole->job_role}}</option>
                                                    @endforeach
                                                </select>

                                                <!-- <input type="text" name="job_role" value="{{$jobEditViews->job_role}}" class="form-control" placeholder="Role" required> -->
                                            </div>
                                        </div>

                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Description:</b></label>
                                                <textarea class="form-control input-default" name="description"  placeholder="Type your description...">{{$jobEditViews->description}}</textarea>
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