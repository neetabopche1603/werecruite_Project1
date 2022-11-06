@extends('partials.talentPartner.app')
@section('talentPartnerTitle','View Jobs |Job Description')
@section('userBreadcrumbTitle')
<span class="titlePage">View Jobs|Job Description</span>
@endsection
@section('talentPartner-content')

<div class="content-body">
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
	@endif
	<!-- Notification End -->
	<!-- row -->
	<div class="container-fluid">

		<!-- <div class="form-head d-flex mb-3 mb-lg-5 align-items-start">
					<a href="javascript:void(0);" class="btn btn-dark"><i class="flaticon-381-clock mr-2"></i> Edit Profile</a>
					<a href="javascript:void(0);" class="btn btn-success ml-auto px-5">+ Add Netw Appointment</a>
				</div> -->

		<div class="row">
			<!-- <div class="col-xl-4">
						<div class="row">
							<div class="col-lg-6 col-xl-12">
								<div class="card bg-danger">
									<div class="card-header border-0 pb-0 justify-content-center">
										<h4 class="card-title text-white">Appointment Schedule</h4>
									</div>
									<div class="card-body patient-calender  pb-2">
										<input type='text' class="form-control d-none" id='datetimepicker1' />
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-xl-12">
								<div class="card abilities-chart">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Doctors Abilities</h4>
									</div>
									<div class="card-body">
										<div id="pie-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
										<div class="chart-point">
											<div>
												<span class="a"></span>
												Operation
											</div>
											<div>
												<span class="b"></span>
												Theraphy
											</div>
											<div>
												<span class="c"></span>
												Mediation
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
			<div class="col-xl-10">
				<div class="row">
					<div class="col-md-12">

						<div class="card">

							{{--<pre>
							<?php print_r($jobs->toArray());
							die;
							?>
						</pre>--}}

							<div class="card-body">
								<div class="d-flex doctor-info-details mb-5">
									<!-- <div class="media align-self-start">
												<img alt="image" class="rounded" width="130" src="images/avatar/2.jpg">
												<i class="flaticon-381-heart"></i>
											</div> -->
									<div class="media-body">
										<h3 class="mb-2">{{$jobs->job_title}}</h3>
										<!-- <p>Company Name : <span class="text-success">
												@if ($jobs->user_id!=0)
												{{$jobs->company_name}}
												@else
												Werecuite
												@endif
												
												{{-- {{($jobs->user_id!=0)?$jobs->company_name:"Werecuite" }} --}}</span></p> -->
										@php
										$skills = implode(",",$jobs->skills);
										@endphp
										<p class="mb-md-2 mb-sm-4 mb-2"><span class="text-info text-center">Skills -</span>{{$skills}}</p>
										<!-- <span><i class="flaticon-381-clock"></i> Join Date 21 August 2020, 12:45 AM</span> -->
									</div>
									<div class="text-md-right mt-0 mt-md-0">
										<!-- <div class="dropdown mb-3">
													<div class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
														<i class="flaticon-381-user-7 mr-2"></i> Dentist
													</div>
													<div class="dropdown-menu dropdown-menu-left">
														<a class="dropdown-item" href="#">A To Z List</a>
														<a class="dropdown-item" href="#">Z To A List</a>
													</div>
												</div> -->

										<div class="btn d-flex justify-content-center align-content-center">
											@if ($applied_job != NULL)
											@if($applied_job->status == 0 && $applied_job->screening_schedule == 0 && $applied_job->interview_schedule == 0 && $applied_job->selected == 0)
											<a href="#">
												<button type="button" class="btn btn-success">Applied</button>
											</a>
											@elseif ($applied_job->status == 1 && $applied_job->screening_schedule == 0 && $applied_job->interview_schedule == 0 && $applied_job->selected == 0)
											<a href="#">
												<button type="button" class="btn btn-success">Screening</button>
											</a>

											@elseif ($applied_job->status == 1 && $applied_job->screening_schedule == 1 && $applied_job->interview_schedule == 0 && $applied_job->selected == 0)
											<a href="#">
												<button type="button" class="btn btn-success">Screening Scheduled</button>
											</a>

											@elseif ($applied_job->status == 1 && $applied_job->screening_schedule == 1 && $applied_job->interview_schedule == 1 && $applied_job->selected == 0)
											<a href="#">
												<button type="button" class="btn btn-success">Interview Scheduled</button>
											</a>

											@elseif ($applied_job->status == 1 && $applied_job->screening_schedule == 1 && $applied_job->interview_schedule == 1 && $applied_job->selected == 1)
											<a href="#">
												<button type="button" class="btn btn-success">Selected</button>
											</a>
											@endif

											@else
											<a href="{{ route('talent.appliedJob', ['job_id'=> $jobs->id]) }}">
												<button type="button" class="btn btn-primary">Apply Job</button>
											</a>
											@endif
										</div>
										<!-- <div class="star-review">
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
													<span class="ml-3">238 reviews</span>
												</div> -->
									</div>
								</div>

								<div class="doctor-info-content mb-lg-0" style="margin-bottom: 50px;">
									<h4 class="text-black mb-3"><span class="text-info"><b>Job Role -</b></span>&nbsp;&nbsp;{{$jobs->job_role}}</h4>
									<h5>Job description</h5>
									<p class="mb-3">{{$jobs->description}}</p>
									<p>Job Posted : {{ $jobs->created_at->format('d M Y h:i A')}} <span class="text-success">({{$jobs->created_at->diffForHumans()}})</span></p>
								</div>
							</div>
							<div class="card-footer border-0 pt-0 text-center">


								{{--<div class="btn d-flex justify-content-center align-content-center">
									@if($applied_job != null)
									<a href="#">
										<button type="button" class="btn btn-success">Applied</button>
									</a>
									@else
									<a href="{{ route('talent.appliedJob', ['job_id'=> $jobs->id]) }}">
								<button type="button" class="btn btn-primary">Apply Job</button>
								</a>
								@endif
							</div>--}}
						</div>
					</div>

				</div>
				<!-- <div class="col-md-12">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Assigned Patient</h4>
									</div>
									<div class="card-body">
										<div class="media patient-box">
											<img class="mr-3 img-fluid rounded" width="110" src="./images/avatar/1.jpg" alt="DexignZone">
											<div class="media-body">
												<h3 class="mt-0 mb-2 text-black bold mt-1"><b>Brian Lucky</b></h3>
												<h4 class="mb-4 text-primary">Cold & Flue</h4>
												<a href="javascript:void(0);" class="btn-link mr-4 text-dark">Unassign</a>
												<a href="javascript:void(0);" class="btn-link text-danger ">Check Imporvement</a>
											</div>
											<div id="chart" class="mr-3"></div>
											<div class="media-footer align-self-center">
												<div class="up-sign text-success">
													<i class="fa fa-caret-up"></i>
													<h3 class="text-success">4%</h3>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
				<!-- <div class="col-md-12">
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h4 class="card-title">Recent Review</h4>
									</div>
									<div class="card-body">
										<div class="media review-box mb-4">
											<img class="mr-3 img-fluid rounded" width="105" src="./images/avatar/1.jpg" alt="DexignZone">
											<div class="media-body">
												<h4 class="mt-0 mb-3 text-black">Glee Smiley</h4>
												<p class="mb-3">Hospital & staff were extremely warm & quick in getting me start with the procedures.</p>
												<span class="btn btn-xs light btn-danger btn-rounded mb-1">EXCELENT</span>
												<span class="btn btn-xs light btn-danger btn-rounded">GREAT SERVICE</span>
											</div>
											<div class="media-footer">
												<div class="star-review text-md-center">
													<span class="text-primary">4.5</span>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</div>
											</div>
										</div>
										<div class="media review-box mb-4">
											<img class="mr-3 img-fluid rounded" width="105" src="./images/avatar/2.jpg" alt="DexignZone">
											<div class="media-body">
												<h4 class="mt-0 mb-3 text-black">Emilian Brownlee</h4>
												<p class="mb-3">Hospital & staff were extremely warm & quick in getting me start with the procedures.</p>
												<span class="btn btn-xs light btn-danger btn-rounded mb-1">EXCELENT</span>
												<span class="btn btn-xs light btn-danger btn-rounded">GREAT SERVICE</span>
											</div>
											<div class="media-footer">
												<div class="star-review text-md-center">
													<span class="text-primary">4.5</span>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</div>
											</div>
										</div>
										<div class="media review-box">
											<img class="mr-3 img-fluid rounded" width="105" src="./images/avatar/3.jpg" alt="DexignZone">
											<div class="media-body">
												<h4 class="mt-0 mb-3 text-black">Stevani Anderson</h4>
												<p class="mb-3">Hospital & staff were extremely warm & quick in getting me start with the procedures.</p>
												<span class="btn btn-xs light btn-danger btn-rounded mb-1">EXCELENT</span>
												<span class="btn btn-xs light btn-danger btn-rounded">GREAT SERVICE</span>
											</div>
											<div class="media-footer">
												<div class="star-review text-md-center">
													<span class="text-primary">4.5</span>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-orange"></i>
													<i class="fa fa-star text-gray"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer border-0 pt-0 text-center">
										<a href="#" class="btn-link">Read More</a>
									</div>
								</div>
								
							</div> -->
			</div>
		</div>
	</div>
</div>
</div>



@endsection

@push('script')

@endpush