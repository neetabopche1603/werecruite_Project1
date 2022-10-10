 <?php

	use App\Models\Notification;

	$ids = [0, auth()->user()->id];
	//   $notification = Notification::where('type','User')->whereIn('user_id',$ids)->orderBy('id','desc')->get();
	$notification = Notification::where('is_seen', 0)->where('type', 'User')->whereIn('user_id', $ids)->orderBy('id', 'desc')->get();

	?>
 <!--**********************************
            Nav header start
        ***********************************-->
 <div class="nav-header">
 	<a href="{{route('talentPartner.home')}}" class="brand-logo">
 		<img class="logo-abbr" style="max-width: 170px;" src="{{ asset('settings/'.$setting[0]['logo'] )}}" alt="">
<!-- 
 		<img class="logo-compact" src="{{asset('admin/images/logo-text.png')}}" alt="">
 		<img class="brand-title" src="{{asset('admin/images/logo-text.png')}}" alt=""> -->
 	</a>

 	<div class="nav-control">
 		<div class="hamburger">
 			<span class="line"></span><span class="line"></span><span class="line"></span>
 		</div>
 	</div>
 </div>

 <!--**********************************
            Nav header end
        ***********************************-->
 <div class="header">
 	<div class="header-content">
 		<nav class="navbar navbar-expand">
 			<div class="collapse navbar-collapse justify-content-between">
 				<div class="header-left">
 					<div class="dashboard_bar">
 						Dashboard
 					</div>
 				</div>

 				<ul class="navbar-nav header-right">
 					<li class="nav-item dropdown notification_dropdown">
 						<a class="nav-link dz-fullscreen" href="#">
 							<svg id="icon-full" viewBox="0 0 24 24" width="26" height="26" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
 								<path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
 							</svg>
 							<svg id="icon-minimize" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize">
 								<path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"></path>
 							</svg>
 						</a>
 					</li>
 					<!-- <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell bell-link" href="#">
                                    <i class="flaticon-381-pad"></i>
                                </a>
							</li> -->
 					<li class="nav-item dropdown notification_dropdown">

 						<a class="nav-link  ai-icon" href="#" role="button" data-toggle="dropdown">
 							<i class="flaticon-381-ring"></i>
 							<div class="pulse-css"></div>
 						</a>
 						<div class="dropdown-menu dropdown-menu-right">
 							<div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
 								<ul class="timeline">
 									@forelse ($notification as $row)
 									<li>
 										<div class="timeline-panel">
 											<!-- <div class="media mr-2">
														<img alt="image" width="50" src="images/avatar/1.jpg">
													</div> -->
 											<div class="media-body">
 												<?php
													if ($row->is_seen == 0) {
													?>
 													<a href="javascript:void(0)" data-url="{{route('talent.job_desc',['id'=>$row->job_id])}}" class="jobStatus" data-id="{{$row->id}}">
 														<h6 class="mb-1 text-warning"> {{$row->title}} </h6>
 													</a>
 												<?php
													} else {
														echo "<h6 class='mb-1 text-success'> $row->title </h6>";
													}
													?>

 												<small class="d-block">{{ $row->created_at->diffForHumans() }}</small>
 											</div>
 										</div>
 									</li>
									 @empty
									<li>
										<h5 class="text-center mt-5 text-primary">No Notifications</h5>
									</li>
 									@endforelse


 								</ul>
 							</div>
 							<!-- <a class="all-notification" href="#">See all notifications <i class="ti-arrow-right"></i></a> -->
 						</div>
 					</li>
 					<li class="nav-item dropdown header-profile">
 						<a class="nav-link" href="#" role="button" data-toggle="dropdown">
 							<div class="header-info">
 								<span>{{auth()->user()->name}}</span>
 								<small>
 									@if(auth()->user()->role == 0)
 									<small>Talent-Partner</small>

 									@elseif(auth()->user()->role == 1)
 									<small>Client-Partner</small>
 									@endif
 								</small>
 							</div>
 							<img src="{{asset('image')}}/{{auth()->user()->image}}" width="20" alt="" />
 						</a>
 						<div class="dropdown-menu dropdown-menu-right">
 							<a href="{{route('talent.profileView')}}" class="dropdown-item ai-icon">
 								<svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
 									<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
 									<circle cx="12" cy="7" r="4"></circle>
 								</svg>
 								<span class="ml-2">Profile </span>
 							</a>
 							<a href="{{route('user.logout')}}" onclick="return confirm('Are you sure logout this site')" class="dropdown-item ai-icon">
 								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
 									<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
 									<polyline points="16 17 21 12 16 7"></polyline>
 									<line x1="21" y1="12" x2="9" y2="12"></line>
 								</svg>
 								<span class="ml-2">Logout </span>
 							</a>
 						</div>
 					</li>
 				</ul>
 			</div>
 		</nav>
 	</div>
 </div>
 <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
 @push('script')
 <script>
 	$.ajaxSetup({
 		headers: {
 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 		}
 	});
 	$(document).on('click', '.jobStatus', function() {
 		let notification_id = $(this).data('id');
		let getJoburl = $(this).data('url');
		
		$.ajax({
			type: "post",
			url: "{{route('talent.notificationSeen')}}",
			data: {"id":notification_id},
			success: function (result) {
				if(result.status == 'success'){
					location.href = getJoburl
				}
			}
		});
 	})
 </script>
 @endpush