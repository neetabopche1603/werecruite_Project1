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
    <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css" />


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
                                                    <label class="mb-1"><strong><span class="text-danger">*</span>Company Name</strong></label>
                                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter Company Name">
                                                    <span class="text-danger">
                                                        @error('name')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>

                                            </div>

                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Date Of Birth</strong></label>
                                                    <input type="date" name="dob" class="form-control" placeholder="Date of birth">

                                                    <span class="text-danger">
                                                        @error('dob')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-6">
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
                                            </div> -->
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Mobile Number</strong></label>
                                                    <input type="text" id="phone" value="{{old('mobile_number')}}" class="form-control" placeholder="98XXXXXXXXX" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" minlength="5" maxlength="15" style="padding-left: 84px; padding-right: 97px;">
                                                    <input type="hidden" name="mobile_number" id="phoneno" value="{{old('mobile_number')}}">
                                                    <span class="text-danger">
                                                        @error('mobile_number')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span>Employment size</strong></label>
                                                    <input type="text" name="emp_size" value="{{old('emp_size')}}" class="form-control" placeholder="Employment size">
                                                    <span class="text-danger">
                                                        @error('emp_size')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> Email</strong></label>
                                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="hello@example.com">
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
                                                    <div class="input-group" id="password">
                                                        <input class="form-control" name="password" type="password" placeholder="********" onkeyup="checkPasswordStrength()">
                                                        <div class="input-group-addon" style="background-color: #450b5a;
                                                        padding: 8px;
                                                        border-radius: 0px 10px 10px 0px;">
                                                            <a href="" style="color: white;"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
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
                                                    <div class="input-group" id="show_hide_password_confirmation">
                                                        <input class="form-control" name="password_confirmation" type="password" placeholder="********">
                                                        <div class="input-group-addon" style="background-color: #450b5a;
                                                        padding: 8px;
                                                        border-radius: 0px 10px 10px 0px;">
                                                            <a href="" style="color: white;"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger">
                                                        @error('password_confirmation')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong>Image</strong></label>
                                                    <input type="file" name="image" value="{{old('image')}}" class="form-control" placeholder="">
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
                                                    <textarea class="form-control" name="address" placeholder="Type your Address...">{{old('address')}}</textarea>

                                                    <span class="text-danger">
                                                        @error('address')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> </strong>Street</label>
                                                    <input type="text" name="street" class="form-control" value="{{old('street')}}" placeholder="Street">
                                                    <span class="text-danger">
                                                        @error('street')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> </strong>City</label>
                                                    <input type="text" name="city" class="form-control" value="{{old('city')}}" placeholder="City">

                                                    <span class="text-danger">
                                                        @error('city')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> </strong>State</label>
                                                    <input type="text" name="state" class="form-control" value="{{old('state')}}" placeholder="State">

                                                    <span class="text-danger">
                                                        @error('state')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> </strong>Country</label>
                                                    <input type="text" name="country" class="form-control" value="{{old('country')}}" placeholder="Country">

                                                    <span class="text-danger">
                                                        @error('country')
                                                        {{$message}}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1"><strong><span class="text-danger">*</span> </strong>Zip Code</label>
                                                    <input type="text" name="zip_code" class="form-control" value="{{old('zip_code')}}" placeholder="Zip Code" spellcheck="false" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="6" maxlength="6">

                                                    <span class="text-danger">
                                                        @error('zip_code')
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
    <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="{{asset('admin/js/deznav-init.js')}}"></script>

    <!-- Password Validation -->


    <!-- Password Show Hide Script -->
    <script>
        $(document).ready(function() {
            $("#password a").on('click', function(event) {
                event.preventDefault();
                if ($('#password input').attr("type") == "text") {
                    $('#password input').attr('type', 'password');
                    $('#password i').addClass("fa-eye-slash");
                    $('#password i').removeClass("fa-eye");
                } else if ($('#password input').attr("type") == "password") {
                    $('#password input').attr('type', 'text');
                    $('#password i').removeClass("fa-eye-slash");
                    $('#password i').addClass("fa-eye");
                }
            });
        });
    </script>

    <!-- Show hide password confirmation Script-->
    <script>
        $(document).ready(function() {
            $("#show_hide_password_confirmation a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_confirmation input').attr("type") == "text") {
                    $('#show_hide_password_confirmation input').attr('type', 'password');
                    $('#show_hide_password_confirmation i').addClass("fa-eye-slash");
                    $('#show_hide_password_confirmation i').removeClass("fa-eye");
                } else if ($('#show_hide_password_confirmation input').attr("type") == "password") {
                    $('#show_hide_password_confirmation input').attr('type', 'text');
                    $('#show_hide_password_confirmation i').removeClass("fa-eye-slash");
                    $('#show_hide_password_confirmation i').addClass("fa-eye");
                }
            });
        });
    </script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            separateDialCode: true,
            // excludeCountries: ["in", "il"],
            preferredCountries: ["in", "pk", "us", ]
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#phone').on('keyup', function() {
                let c_code = $('.iti__selected-dial-code').html();
                let phone = $(this).val();
                $('#phoneno').val(c_code + phone)
            })

        });
    </script>


</body>

</html>