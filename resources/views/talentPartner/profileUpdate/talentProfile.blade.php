@extends('partials.talentPartner.app')
@section('talentPartnerTitle','Profile Page Talent')
@section('talentPartner-content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Profile</a></li>
                </ol>
            </div>
        </div>

        <!-- row -->
        <div class="row">
            <div class="col-xl-7 col-lg-7">
                <!-- Change Profile -->
                <div class="card">

                    <!-- Notification Start -->
                    @if(Session::get('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session::get('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{--@elseif(Session::get('password'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session::get('password')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>--}}

                    @elseif (Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{session::get('error')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @elseif (Session::get('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{session::get('danger')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @endif
                    <!-- Notification End -->
                    <div class="card-header">
                        <h4 class="card-title">Update Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('talent.ProfileUpdate')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="id" value="{{$profileData->id}}">
                                    <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for=""><span class="text-danger">*</span><b>Name:</b></label>
                                            <input type="text" name="name" value="{{$profileData->name}}" class="form-control input-default " placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for=""><span class="text-danger">*</span><b>Date Of Birth:</b></label>
                                            <input type="date" name="dob" value="{{$profileData->dob}}" class="form-control input-default " placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for=""><span class="text-danger">*</span><b>Email:</b></label>
                                            <input type="email" name="email" value="{{$profileData->email}}" class="form-control input-default " placeholder="Enter Email" disabled>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for=""><span class="text-danger">*</span><b>Highest Education:</b></label>
                                            <input type="text" name="highest_education" value="{{$profileData->highest_education}}"  class="form-control input-default " placeholder="Highest Education">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for=""><span class="text-danger">*</span><b>Mobile:</b></label>
                                            <input type="text" name="mobile_number" value="{{$profileData->mobile_no}}" class="form-control input-default" placeholder="Enter Phone">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for=""><span class="text-danger">*</span><b>Image:</b></label>
                                            <input type="file" name="image" class="form-control input-default " placeholder="">
                                            <img src="{{asset('image')}}/{{auth()->user()->image}}" alt="image" width="100px" height="100px">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for=""><span class="text-danger">*</span><b>Address:</b></label>
                                            <textarea class="form-control input-default" name="address" placeholder="Type your message...">{{$profileData->address}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Update">

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Change Password  -->
            <div class="col-xl-5 col-lg-5">
                <div class="card">
                    <!-- Notification Start -->
                    @if(Session::get('password'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session::get('password')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <!-- Notification Start -->

                    <div class="card-header">
                        <h4 class="card-title">Change Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form class="forms-sample mt-4" action="{{route('client.passwordChange')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">
                                        <span class="text-danger">*</span><b>Current Password</b></label>
                                    <input type="password" name="current_password" class="form-control input-rounded" placeholder="Cruurent Password">
                                    <span class="text-danger">
                                        @error('current_password')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        <span class="text-danger">*</span><b>New Password</b></label>
                                    <input type="password" name="new_password" class="form-control input-rounded" placeholder="New Password">
                                    <span class="text-danger">
                                        @error('new_password')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="">
                                        <span class="text-danger">*</span><b>Confirm Password</b></label>
                                    <input type="password" name="new_confirm_password" class="form-control input-rounded" placeholder="Confirm Password">
                                    <span class="text-danger">
                                        @error('new_confirm_password')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Save">
                            </form>
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