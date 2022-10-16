@extends('partials.talentPartner.app')
@section('talentPartnerTitle','Telent Home')
@section('talentPartner-content')
<?php

use Illuminate\Support\Facades\DB;

$totalAppliedJob = DB::table('applied_jobs')->where('user_id','=',auth()->user()->id)->count();

$totalInterViewSchedule = DB::table('applied_jobs')->where('user_id','=',auth()->user()->id)->where('interview_schedule','=',1)->count();
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
		</div>
		<div class="row">
			<div class="col-xl-6 col-xxl-12">
				<div class="row">
					
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
										<p class="mb-1">Total Applied Job</p>
										<h3 class="text-white">{{ $totalAppliedJob }}</h3>
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
										<p class="mb-1">Total Interview Scheduled</p>
										<h3 class="text-white">{{ $totalInterViewSchedule }}</h3>
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
<script>
	history.pushState(null, null, window.location.href);
	history.back();
	window.onpopstate = () => history.forward();
</script>
@endpush