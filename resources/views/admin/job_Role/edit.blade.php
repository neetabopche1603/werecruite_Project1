@extends('partials.admin.app')
@section('adminTitle','Job Role |Edit Job Role')
@section('titlePage')
   <span class="titlePage">Job Role |Edit Job Role</span>
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Job Role</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Job Role</h4>
                        <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary btn-outline-light float-lg-right" style="background-color: #450b5a; color: #fff;"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.jobRoleUpdate')}}" method="post" id="jobRoleForm" class="step-form-horizontal">
                            @csrf
                            <input type="hidden" name="id" value="{{$jobRoleEdit->id}}">
                            <div>
                                <!-- <h4>Personal Info</h4> -->
                                <section>
                                    <div class="row">
                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Job Role :</b></label>
                                                <input type="text" name="job_role" value="{{$jobRoleEdit->job_role}}" class="form-control" placeholder="Job Role">
                                                <span class="text-danger">
                                                    @error('job_role')
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
@push('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script> 
    $(document).ready(function(){
    
    var jobRoleForm = $("#jobRoleForm");
    var validatorAdd = jobRoleForm.validate({

        rules:{
            
            job_role :{ required : true},
        },
        messages:{
            job_role :{ required : "Enter Job Role" }, 
           
              }
    });

});
</script> 
@endpush