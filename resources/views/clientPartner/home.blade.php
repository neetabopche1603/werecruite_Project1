@extends('partials.clientPartner.app')
@section('clientPartnerTitle','Client Home')
@section('clientPartner-content')
<?php

use Illuminate\Support\Facades\DB;

$totaljobs = DB::table('jobs')->where('user_id', '=',auth()->user()->id)->count();
$getJobs = DB::table('jobs')->where('user_id', '=',auth()->user()->id)->get(['id']);
$jobs = [];
foreach($getJobs as $id){
array_push($jobs,$id->id);
}
$appliedJobsUser = DB::table('applied_jobs')->whereIn('job_id',$jobs)->count();

?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
			<div class="mr-auto d-none d-lg-block">
				<h3 class="text-primary font-w600">Welcome {{auth()->user()->name}}</h3>
				<!-- <p class="mb-0">Hospital Admin Dashboard Template</p> -->
			</div>
			<!-- <div class="input-group search-area ml-auto d-inline-flex">
						<input type="text" class="form-control" placeholder="Search here">
						<div class="input-group-append">
							<span class="input-group-text"><i class="flaticon-381-search-2"></i></span>
						</div>
					</div> -->
			<!-- <a href="javascript:void(0);" class="btn btn-primary ml-3"><i class="flaticon-381-settings-2 mr-0"></i></a> -->
		</div>
		<div class="row">
			<div class="col-xl-6 col-xxl-12">
				<div class="row">
					<!-- <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12"> -->
					
				</div>
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
										<p class="mb-1">Total Jobs Posted</p>
										<h3 class="text-white">{{ $totaljobs }}</h3>
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
										<p class="mb-1">Applied Job User's</p>
										<h3 class="text-white">{{ $appliedJobsUser }}</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<!-- <div class="row">
							
						</div> -->
			</div>
		</div>
	</div>
</div>
<!--**********************************
            Content body end
        ***********************************-->

@endsection

@push('script')
<script>
	history.pushState(null, null, window.location.href);
	history.back();
	window.onpopstate = () => history.forward();
</script>

@endpush