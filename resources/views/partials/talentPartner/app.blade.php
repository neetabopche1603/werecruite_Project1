<?php

use App\Models\Setting;

$setting = Setting::get();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('talentPartnerTitle')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('settings/'.$setting[0]['favicon'] )}}">

    <link href="{{asset('admin/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/vendor/chartist/css/chartist.min.css')}}">
    <link href="{{asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Datatable -->
    <link href="{{asset('admin/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- datetime picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css" />

    <link href="{{asset('admin/vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="{{asset('admin/vendor/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="{{asset('admin/vendor/jquery-asColorPicker/css/asColorPicker.min.css')}}" rel="stylesheet">

    <!-- Material color picker -->
    <link href="{{asset('admin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <!-- Pick date -->
    <link rel="stylesheet" href="{{asset('admin/vendor/pickadate/themes/default.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendor/pickadate/themes/default.date.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">






</head>

@stack('style')

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('partials.talentPartner.header')
        @include('partials.talentPartner.sidebar')
        @yield('talentPartner-content')
        @include('partials.talentPartner.footer')

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!-- Required vendors -->
    <script src="{{asset('admin/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
    <script src="{{asset('admin/js/deznav-init.js')}}"></script>
    <!-- Apex Chart -->
    <script src="{{asset('admin/vendor/apexchart/apexchart.js')}}"></script>
    <script>
        $(function() {
            setTimeout(function() {
                $(".alert").fadeOut(1500);
            }, 3000)
        });
    </script>
    <!-- Dashboard 1 -->
    <script src="{{asset('admin/js/dashboard/dashboard-1.js')}}"></script>
    <!-- Datatable -->
    <script src="{{asset('admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins-init/datatables.init.js')}}"></script>
    <!-- DateTime Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"></script>
    <!-- <script src="{{asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins-init/sweetalert.init.js')}}"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  
    <!-- Daterangepicker -->
    <!-- momment js is must -->
    <script src="{{asset('admin/vendor/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- clockpicker -->
    <script src="{{asset('admin/vendor/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
    <!-- asColorPicker -->
    <script src="{{asset('admin/vendor/jquery-asColor/jquery-asColor.min.js')}}"></script>
    <script src="{{asset('admin/vendor/jquery-asGradient/jquery-asGradient.min.js')}}"></script>
    <script src="{{asset('admin/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js')}}"></script>
    <!-- Material color picker -->
    <script src="{{asset('admin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <!-- pickdate -->
    <script src="{{asset('admin/vendor/pickadate/picker.js')}}"></script>
    <script src="{{asset('admin/vendor/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('admin/vendor/pickadate/picker.date.js')}}"></script>


    <!-- Daterangepicker -->
    <script src="{{asset('admin/js/plugins-init/bs-daterange-picker-init.js')}}"></script>
    <!-- Clockpicker init -->
    <script src="{{asset('admin/js/plugins-init/clock-picker-init.js')}}"></script>
    <!-- asColorPicker init -->
    <script src="{{asset('admin/js/plugins-init/jquery-asColorPicker.init.js')}}"></script>
    <!-- Material color picker init -->
    <script src="{{asset('admin/js/plugins-init/material-date-picker-init.js')}}"></script>
    <!-- Pickdate -->
    <script src="{{asset('admin/js/plugins-init/pickadate-init.js')}}"></script>

    @stack('script')

</body>

</html>