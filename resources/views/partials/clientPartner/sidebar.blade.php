  <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="" href="{{route('clientPartner.home')}}" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
                    
                    <li class="{{ (request()->is('client/show-job'))||(request()->is('client/add-job'))||(request()->is('client/edit-job*')) ? 'mm-active active-no-child' : '' }}">
                    <!-- <a href="{{route('client.showJob')}}" class="ai-icon" aria-expanded="false"> -->
                    <a href="{{route('client.showJob')}}" class="ai-icon {{ (request()->is('client/show-job'))||(request()->is('client/add-job'))||(request()->is('client/edit-job*')) ? 'mm-active' : '' }}" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
							<span class="nav-text">Post Job</span>
						</a>
					</li>

                    <li class="{{ (request()->is('client/show-applied-jobs'))||(request()->is('client/get-all-users*')) ? 'mm-active active-no-child' : '' }}">
                        
                    <!-- <a href="{{route('client.getAllJob')}}" class="ai-icon" aria-expanded="false"> -->
                        
                    <a href="{{ route('client.getAllJob') }}" class="ai-icon {{ (request()->is('client/show-applied-jobs'))||(request()->is('client/get-all-users*')) ? 'mm-active' : '' }}" aria-expanded="false">

                            <i class="flaticon-381-notepad"></i>
							<span class="nav-text">Applied Jobs</span>
						</a>
					</li>
                </ul>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->