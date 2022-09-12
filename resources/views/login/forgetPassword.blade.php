<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Forget Password</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/images/favicon.png')}}">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">

                                    @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                    @endif

                                    <h4 class="text-center mb-4">Forget Password</h4>
                                    <p class="text-center">Enter your Email to reset password</p>
                                    <form action="{{route('forget.password.post')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong><span class="text-danger">*</span>Email Address</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="Email Address">
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="text-center">
                                            <!-- <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button> -->
                                            <button type="submit" class="btn btn-primary btn-block">Send</button>
                                        </div>
                                        <div class="mt-2 text-center">
                                            <p>Already have an password? <a href="{{route('login')}}"><span class="text-primary"><b>Sign in</b></span></a></p>
                                       
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!-- Common JS -->
    <script src="{{asset('admin/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <!-- Custom script -->
    <script src="{{asset('admin/vendor/deznav/deznav.min.js')}}"></script>
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
    <script src="{{asset('admin/js/deznav-init.js')}}"></script>

</body>

</html>