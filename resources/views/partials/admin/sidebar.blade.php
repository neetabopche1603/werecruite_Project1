  <!--**********************************
            Sidebar start
        ***********************************-->
  <div class="deznav">
      <div class="deznav-scroll">
          <ul class="metismenu" id="menu">
              <li><a class="" href="{{route('admin.home')}}" aria-expanded="false">
                      <i class="flaticon-381-networking"></i>
                      <span class="nav-text">Dashboard</span>
                  </a>
              </li>

              <li class="{{ (request()->is('admin/show-job-role'))||(request()->is('admin/add-job-role'))||(request()->is('admin/edit-job-role*')) ? 'mm-active active-no-child' : '' }}">
                <a href="{{route('admin.jobRole')}}" class="ai-icon {{ (request()->is('admin/show-job-role'))||(request()->is('admin/add-job-role'))||(request()->is('admin/edit-job-role*')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-controls-3"></i>
                      <span class="nav-text">Job Role</span>
                  </a>
              </li>

              <li class="{{ (request()->is('admin/show-skill'))||(request()->is('admin/add-skill'))||(request()->is('admin/edit-skill*')) ? 'mm-active active-no-child' : '' }}"><a href="{{route('admin.skill')}}" class="ai-icon {{ (request()->is('admin/show-skill'))||(request()->is('admin/add-skill'))||(request()->is('admin/edit-skill*')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-notepad"></i>
                      <span class="nav-text">Skill</span>
                  </a>
              </li>


              <li class="{{ (request()->is('admin/show-jobs'))||(request()->is('admin/add-jobsPost'))||(request()->is('admin/edit-jobsPost*')) ? 'mm-active active-no-child' : '' }}">
                
                <a href="{{route('admin.jobPosts')}}" class="ai-icon {{ (request()->is('admin/show-jobs'))||(request()->is('admin/add-jobsPost'))||(request()->is('admin/edit-jobsPost*')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-layer-1"></i>
                      <span class="nav-text">Post Job</span>
                  </a>
              </li>

              <li class="{{ (request()->is('admin/applied-job-user'))||(request()->is('admin/get-applied-users*')) ? 'mm-active active-no-child' : '' }}">

                <a href="{{ route('admin.appliedJobs') }}" class="ai-icon {{ (request()->is('admin/applied-job-user'))||(request()->is('admin/get-applied-users*')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-network"></i>
                      <span class="nav-text">Applied Job</span>
                  </a>
              </li>

              <li class="{{ (request()->is('admin/show-screening-jobs'))||(request()->is('admin/get-all-users*')) ? 'mm-active active-no-child' : '' }}">
                <a href="{{route('admin.getAllJob')}}" class="ai-icon {{ (request()->is('admin/show-screening-jobs'))||(request()->is('admin/get-all-users*')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-television"></i>
                      <span class="nav-text">Screening User</span>
                  </a>
              </li>

              <li class="{{ (request()->is('admin/all-users')) ? 'mm-active active-no-child' : '' }}"><a href="{{ route('admin.userListShow') }}" class="ai-icon {{ (request()->is('admin/all-users')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-television"></i>
                      <span class="nav-text">All Users</span>
                  </a>
              </li>

              <li class="{{ (request()->is('admin/all-companies')) ? 'mm-active active-no-child' : '' }}"><a href="{{ route('admin.companyListShow') }}" class="ai-icon {{ (request()->is('admin/all-users')) ? 'mm-active' : '' }}" aria-expanded="false">
                      <i class="flaticon-381-television"></i>
                      <span class="nav-text">All Company</span>
                  </a>
              </li>
      </div>
  </div>
  <!--**********************************
            Sidebar end
        ***********************************-->