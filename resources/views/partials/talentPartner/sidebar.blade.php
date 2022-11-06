  <!--**********************************
            Sidebar start
        ***********************************-->
  <div class="deznav">
      <div class="deznav-scroll">
          <ul class="metismenu" id="menu">
              <li><a class="" href="{{route('talentPartner.home')}}" aria-expanded="false">
                      <i class="flaticon-381-networking"></i>
                      <span class="nav-text">Dashboard</span>
                  </a>
                  <!-- <ul aria-expanded="false">
							<li><a href="index.html">Dashboard</a></li>
							<li><a href="doctors.html">Doctors</a></li>
							<li><a href="doctors-details.html">Doctors Details</a></li>
							<li><a href="doctors-review.html">Doctors Review</a></li>
							<li><a href="patient-details.html">Patient Details</a></li>
						</ul> -->

              </li>

              <li class="{{ (request()->is('user/jobsView'))||(request()->is('user/job_desc*')) ? 'mm-active active-no-child' : '' }}">
                  <a href="{{route('talent.jobsView')}}" class="ai-icon {{ (request()->is('user/jobsView'))||(request()->is('user/job_desc*')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-settings-2"></i>
                      <span class="nav-text">View jobs</span>
                  </a>
              </li>

              <li class="{{ (request()->is('user/view-applied-job')) ? 'mm-active active-no-child' : '' }}">
                  <a href="{{route('talent.viewAppliedJob')}}" class="ai-icon {{ (request()->is('user/view-applied-job')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-layer-1"></i>
                      <span class="nav-text text-center">View Applied Jobs</span>
                  </a>
              </li>

              <li class="{{ (request()->is('user/full-calender')) ? 'mm-active active-no-child' : '' }}">
              <!-- <a href="{{route('talent.scheduleCalendar')}}" class="ai-icon" aria-expanded="false"> -->

              <a href="{{route('talent.scheduleCalendar')}}" class="ai-icon {{ (request()->is('user/full-calender')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-television"></i>
                      <span class="nav-text text-center">Scheduled Interview</span>
                  </a>
              </li>
          </ul>
      </div>
  </div>
  <!--**********************************
            Sidebar end
        ***********************************-->