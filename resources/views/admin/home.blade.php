@extends('partials.admin.app')
@section('adminTitle','Admin Home')
@section('admin-content')

<?php

use Illuminate\Support\Facades\DB;

$totalJobs = DB::table('jobs')->count();
$totalCompany = DB::table('users')->where('role','=', 0)->count();
$totalScreening = DB::table('applied_jobs')->where('status','=', 1)->count();
$totalInterview = DB::table('applied_jobs')->where('interview_schedule','=', 1)->count();
?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
			<div class="mr-auto d-none d-lg-block">
				<h3 class="text-primary font-w600">Welcome to {{$super_admin[0]['name']}}</h3>
				<!-- <p class="mb-0">Hospital Admin Dashboard Template</p> -->
			</div>

		</div>
		<div class="row">
			<div class="col-xl-6 col-xxl-12">
			</div>
			<div class="col-xl-6 col-xxl-12">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-danger">
							<div class="card-body  p-4">
								<div class="media">
									<span class="mr-3">
										<i class="flaticon-381-calendar-1"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Jobs</p>
										<h3 class="text-white">{{ $totalJobs }}</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="flaticon-381-diamond"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Company</p>
										<h3 class="text-white">{{ $totalCompany }}</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="flaticon-381-heart"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Screening</p>
										<h3 class="text-white">{{ $totalScreening }}</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="flaticon-381-user-7"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total InterView</p>
										<h3 class="text-white">{{ $totalInterview }}</h3>
									</div>
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
            Content body end
        ***********************************-->

@endsection
@push('script')

@endpush