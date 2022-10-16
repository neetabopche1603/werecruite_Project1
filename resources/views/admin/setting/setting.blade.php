@extends('partials.admin.app')
@section('adminTitle','Setting')
@section('admin-content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Welcome back!</h4>
                    <!-- <p class="mb-0">Your business dashboard template</p> -->
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Setting</a></li>
                </ol>
            </div>
        </div>

        <!-- row -->

        <div class="row">
            <div class="col-xl-10 col-lg-10">
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
                    <h4 class="card-title">Setting</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('admin.logoUpdate')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$settings[0]['id']}}">
                           
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span><b>Logo:</b></label>
                                        <input type="file" name="logo" value="" class="form-control input-default" placeholder="">
                                        <span class="text-danger">
                                            @error('logo')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <img src="{{ asset('settings/'.$settings[0]['logo'] )}}" alt="" width="100" height="100">
                                    </div>
                                </div>

                                <div class="col-ml-lg-4 mt-2">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- favicon Update -->
                        <form action="{{route('admin.faviconUpdate')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$settings[0]['id']}}">
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span><b>Favicon:</b></label>
                                        <input type="file" name="favicon" value="" class="form-control input-default " placeholder="">
                                        <span class="text-danger">
                                            @error('favicon')
                                                {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="form-group">
                                        <img src="{{ asset('settings/'.$settings[0]['favicon'] )}}" alt="" width="100" height="100">
                                    </div>
                                </div>

                                <div class="col-ml-3">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    </div>
                                </div>

                            </div>

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