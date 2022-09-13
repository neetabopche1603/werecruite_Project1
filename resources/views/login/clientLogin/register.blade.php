<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign Up Client!</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/images/favicon.png')}}">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100 mb-5">
    <div class="authincation h-100">
        <div class="container h-100">

            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-8 mt-5 mb-lg-5">
                    <div class="authincation-content">

                        <!-- Notifications Start-->
                        @if ($msg = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $msg }}</strong>
                        </div>

                        @elseif (Session::get('faild'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ Session::get('faild') }}</strong>
                        </div>

                        @elseif (Session::get('delete'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ Session::get('delete') }}</strong>
                        </div>
                        @endif
                        <!-- Notifications End-->

                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Create new account</h4>
                                    <form action="{{route('client.registerStore')}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> User Name</strong></label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter Full Name">
                                                    <span class="text-danger">
                                                        @error('name')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Date Of Birth</strong></label>
                                                    <input type="date" name="dob" class="form-control" placeholder="Date of birth">

                                                    <span class="text-danger">
                                                        @error('dob')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label class="mb-1"><strong><span class="text-danger">*</span> Gender</strong> </label> <br>
                                                        <div class="form-check form-check-inline mt-2">
                                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1">
                                                            <label class="form-check-label">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="0">
                                                            <label class="form-check-label">Female</label>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('gender')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Mobile Number</strong></label>
                                                    <input type="text" name="mobile_number" class="form-control" placeholder="+91-XXXXXXXXXXX">
                                                    <span class="text-danger">
                                                        @error('mobile_number')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Highest Education</strong></label>
                                                    <input type="text" name="highest_education" class="form-control" placeholder="Highest education">
                                                    <span class="text-danger">
                                                        @error('highest_education')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                          
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Email</strong></label>
                                                    <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                                    <span class="text-danger">
                                                        @error('email')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Password</strong></label>
                                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                                    <span class="text-danger">
                                                        @error('password')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                              
                                                <div class="col-md-7">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Confirm Password</strong></label>
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"> <span class="text-danger">


                                                        @error('password_confirmation')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                        
                                               

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Profile Image</strong></label>
                                                    <input type="file" name="image" class="form-control" placeholder="">
                                                    <span class="text-danger">
                                                        @error('image')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-10">

                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Address</strong></label>
                                                    <!-- <input type="text" name="address" class="form-control"> -->
                                                    <textarea class="form-control" name="address" placeholder="Type your Address..."></textarea>

                                                    <span class="text-danger">
                                                        @error('address')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                                        </div>

                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-center">Already have an account? <a class="text-primary" href="{{route('client.login')}}">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('admin/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
    <script src="{{asset('admin/js/deznav-init.js')}}"></script>


</body>

</html>