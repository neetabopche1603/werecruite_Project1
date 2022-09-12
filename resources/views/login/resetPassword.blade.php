<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reset Password</title>
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
                                    <!-- Notifications -->

                                    @if ( Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ Session::get('success') }}</strong>
                                    </div>
                                    @elseif (Session::get('delete'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ Session::get('delete') }}</strong>
                                    </div>

                                    @elseif (Session::get('error'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ Session::get('error') }}</strong>
                                    </div>
                                    @endif
                                    <!-- Notifications -->
                                    <h4 class="text-center mb-4">Reset Password</h4>
                                    <p class="text-center">Enter your new password to reset</p>
                                    <form action="{{route('reset.link.post')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        {{-- <div class="form-group">
                                            <label><strong><span class="text-danger">*</span>Email</strong></label>
                                            <input type="email" name="email" class="form-control">
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                </div> --}}

                                <div class="form-group">
                                    <label><strong><span class="text-danger">*</span> New Password</strong></label>
                                    <input type="password" name="password" class="form-control">
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label><strong><span class="text-danger">*</span>Confirm Password</strong></label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                    @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Update Password</button>
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