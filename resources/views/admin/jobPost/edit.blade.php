@extends('partials.admin.app')
@section('adminTitle','Post Job |Edit Post Job')
@section('titlePage')
<span class="titlePage">Post Job |Edit Post</span>
@endsection
@section('admin-content')
<style>
    .error{
        color: red;
    }
</style>
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Job Post</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Job Post</h4>
                        <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary btn-outline-light float-lg-right" style="background-color: #450b5a; color: #fff;"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.jobPostUpdate')}}" method="post" id="jobPostForm" class="step-form-horizontal">
                            @csrf
                            <input type="hidden" name="id" value="{{$jobPostEdit->id}}">
                            <div>
                                <!-- <h4>Personal Info</h4> -->
                                <section>
                                    <div class="row">
                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label for=""><strong style="color: red;">*</strong><b>Company</b></label>
                                                <select class="form-control" name="company_id" id="">
                                                    <option value="0" {{$jobPostEdit->user_id === 0 ? 'selected' : ''}}>Admin</option>
                                                    @foreach ($companys as $data)
                                                    <option value="{{$data->id}}" {{$data->id == $jobPostEdit->user_id ? 'selected' : ''}}>{{$data->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">
                                                    @error('company_id')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                        </div>

                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Job Tilte :</b></label>
                                                <input type="text" name="job_title" value="{{$jobPostEdit->job_title}}" class="form-control" placeholder="Job Title">
                                            </div>
                                            <span class="text-danger">
                                                    @error('job_title')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                        </div>

                                        <?php
                                        $skillArr = json_decode($jobPostEdit->skill);
                                        ?>
                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Skill:</b></label>
                                                <select multiple class="form-control" name="skill[]" id="sel2">
                                                    @foreach ($skills as $skill )
                                                    <option value="{{$skill->id}}" {{$skill->id == in_array($skill->id,$skillArr) ? 'selected' : ''}}>{{$skill->skill}}</option>
                                                    @endforeach
                                                </select>

                                                <!-- <input type="text" name="skill" value="{{$jobPostEdit->skill}}" class="form-control" placeholder="Skill"> -->
                                            </div>

                                            <span class="text-danger">
                                                    @error('skill')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                        </div>

                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Role:</b></label>
                                                <select class="form-control" name="job_role" id="">
                                                    <!-- <option value="">Select</option> -->
                                                    @foreach ($jobRole as $jRole )
                                                    <option value="{{$jRole->id}}" {{$jRole->id == $jobPostEdit->id ? 'selected' : ''}}>{{$jRole->job_role}}</option>
                                                    @endforeach
                                                </select>
                                                <!-- <input type="text" name="job_role" value="{{$jobPostEdit->job_role}}" class="form-control" placeholder="Role"> -->
                                            </div>
                                            <span class="text-danger">
                                                    @error('job_role')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                        </div>

                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Description:</b></label>
                                                <textarea class="form-control input-default" name="description" placeholder="Type your description...">{{$jobPostEdit->description}}</textarea>
                                            </div>
                                            <span class="text-danger">
                                                    @error('description')
                                                    {{$message}}
                                                    @enderror
                                                </span>
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
@push('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 <script> 
    $(document).ready(function(){
    
    var jobPostForm = $("#jobPostForm");
    var validatorAdd = jobPostForm.validate({

        rules:{
            company_id :{ required : true},
            job_title :{ required : true},
            skill :{ required : true},
            job_role :{ required : true},
            description :{ required : true},
        },
        messages:{
            company_id :{ required : "Select Company" }, 
            job_title :{ required : "Enter Job Title" }, 
            skill :{ required : "Enter Skill" }, 
            job_role :{ required : "Enter Job Role" }, 
            description :{ required : "Enter Job Description" }, 
              }
    });

});
</script> 
@endpush