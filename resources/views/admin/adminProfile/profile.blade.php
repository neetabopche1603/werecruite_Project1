@extends('partials.admin.app')
@section('adminTitle','Admin Profile')
@section('titlePage')
   <span class="titlePage">Profile</span>
@endsection
@section('admin-content')
<style>
    .error {
        color: red;
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Welcome {{ $adminProfile->name }}</h4>
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
                    {{--@elseif(Session::get('password'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session::get('password')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>--}}

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

                @elseif (Session::get('danger'))
                <div class="alert alert-danger solid alert-rounded alert-dismissible fade show" role="alert">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
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
                        <form action="{{route('admin.updateProfiles')}}" id="adminProfileChangeForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$adminProfile->id}}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span><b>Name:</b></label>
                                        <input type="text" name="name" value="{{$adminProfile->name}}" class="form-control input-default " placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span><b>Date Of Birth:</b></label>
                                        <input type="date" name="dob" value="{{$adminProfile->dob}}" class="form-control input-default " placeholder="">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span><b>Email:</b></label>
                                        <input type="email" name="email" value="{{$adminProfile->email}}" class="form-control input-default " placeholder="Enter Email">
                                    </div>
                                </div>

                                <!-- <div class="col-12">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span><b>Password:</b></label>
                                        <input type="password" name="password" class="form-control input-default " placeholder="********">
                                    </div>
                                </div> -->

                                {{-- <div class="col-12">
                                         <div class="form-group">
                                             <label for=""><span class="text-danger">*</span><b>Highest Education:</b></label>
                                             <input type="text" name="highest_education" value="{{$adminProfile->highest_education}}" class="form-control input-default " placeholder="Highest Education">
                            </div>
                    </div> --}}


                    <div class="col-12">
                        <div class="form-group">
                            <label for=""><span class="text-danger">*</span><b>Mobile:</b></label>
                            <input type="text" name="mobile_number" value="{{$adminProfile->mobile_no}}" class="form-control input-default" placeholder="Enter Phone">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for=""><b>Image:</b></label>
                            <input type="file" name="image" class="form-control input-default " placeholder="">
                            <!-- <img src="{{asset('image')}}/{{$adminProfile->image}}" alt="image" width="100px" height="100px"> -->
                        </div>
                        <span class="text-danger">
                            @error('image')
                            {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for=""><span class="text-danger">*</span><b>Address:</b></label>
                            <textarea class="form-control input-default" name="address" placeholder="Type your message...">{{$adminProfile->address}}</textarea>
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
        <!-- -- Notification Start -- -->
        @if(Session::get('password'))
        <div class="alert alert-success solid alert-rounded alert-dismissible fade show" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <strong>{{session::get('password')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <!-- -- Notification Start -- -->

        <div class="card-header">
            <h4 class="card-title">Change Password</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form class="forms-sample mt-4" action="{{route('admin.adminChangePassword')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">
                            <span class="text-danger">*</span><b>Current Password</b></label>
                        <input type="password" name="current_password" class="form-control input-rounded" placeholder="Current Password">
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {

        var adminProfileChangeForm = $("#adminProfileChangeForm");
        var validatorAdd = adminProfileChangeForm.validate({

            rules: {

                name: {
                    required: true
                },
                dob: {
                    required: true
                },
                email: {
                    required: true
                },
                mobile_number: {
                    required: true
                },
                address: {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "Enter Name"
                },
                dob: {
                    required: "Enter Date Of Birth"
                },
                email: {
                    required: "Enter Email"
                },
                mobile_number: {
                    required: "Enter Mobile Number"
                },
                address: {
                    required: "Enter Address"
                },

            }
        });

    });
</script>
@endpush