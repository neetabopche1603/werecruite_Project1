@extends('partials.admin.app')
@section('adminTitle','Post Job |Add Post')
@section('titlePage')
<span class="titlePage"> Post Job |Add Post</span>
@endsection
@section('admin-content')
<link rel="stylesheet" href="{{asset('admin/vendor/select2/css/select2.min.css')}}">
@push('style')

@endpush
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Job Post</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Job Post</h4>
                        <a href="javascript:void(0)" onclick="history.back()" class="btn btn-primary  float-lg-right"><i class="fa fa-backward"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.jobPostStore')}}" method="post" id="step-form-horizontal" class="step-form-horizontal">
                            @csrf
                            <div>
                                <!-- <h4>Personal Info</h4> -->
                                <section>
                                    <div class="row">
                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Company:</b></label>
                                                <select class="form-control" name="company_id" id="">
                                                    <option value="">--Choose Company--</option>
                                                    <option value="0">Admin</option>
                                                    @foreach ($company as $coms )
                                                    <option {{$coms->id == old('company_id') ? 'selected' : ''}} value="{{$coms->id}}">{{$coms->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('company_id')
                                                    {{$message}}
                                                    @enderror
                                                </span>

                                            </div>
                                        </div>

                                        <div class="col-lg-7 mb-2">
                                            <div class="form-group">
                                                <label class="text-label"><strong style="color: red;">*</strong><b>Job Tilte :</b></label>

                                                <input type="text" name="job_title" value="{{ old('job_title') }}" class="form-control" placeholder="Job Title">
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
                                                <?php
                                                $a = old('skill');
                                                //  print_r($a)
                                                ?>
                                                <select multiple="multiple" class="form-control" name="skill[]" id="sel2">
                                                    @foreach ($skills as $skill )
                                                    <option @if ($a) {{ (in_array($skill->id, $a) ? "selected":"") }}@endif value="{{$skill->id}}">{{$skill->skill}}</option>
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
                                                    <option value="">--Choose Job Role--</option>

                                                    @foreach ($jobRole as $jRole )
                                                    <option {{$jRole->id == old('job_role') ? 'selected' : ''}} value="{{$jRole->id}}">{{$jRole->job_role}}</option>
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
                                                <textarea class="form-control input-default" name="description" placeholder="Type your description...">{{ old('description') }}</textarea>
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

@push('script')
<script src="{{asset('admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{asset('admin/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin/js/plugins-init/select2-init.js')}}"></script>
@endpush