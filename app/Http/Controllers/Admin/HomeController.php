<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\Job;
use App\Models\JobRole;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SuperAdmin;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function adminHome(){
        $super_admin = SuperAdmin::get();
        return view('admin.home',compact('super_admin'));
    }
// ======================Admin Job Role Function=============================
    // Job Role Function (View Tbl)
    public function jobRole()
    {
        $jobRoles = JobRole::get();
        $super_admin = SuperAdmin::get();
        return view('admin.job_Role.index',compact('jobRoles','super_admin'));
    }
    // Job Role Add Form Function
    public function jobRoleAddForm()
    {
        $super_admin = SuperAdmin::get();
        return view('admin.job_Role.add',compact('super_admin'));
    }
    // Job Role Store Form Function
    public function jobRoleAddStore(Request $request)
    {
        $validatedData = $request->validate([
            'job_role' => 'required',
        ]);

        $jobRole = new JobRole();
        $jobRole->job_role = $request->job_role;
        $jobRole->save();
        return redirect()->route('admin.jobRole')->with('success', 'Job Role Created Successfully.!');
    }

    // Job Role Edit Form Function
    public function jobRoleEdit($id)
    {
        $jobRoleEdit = JobRole::find($id);
        $super_admin = SuperAdmin::get();
        return view('admin.job_Role.edit', compact('jobRoleEdit','super_admin'));
    }
    // Job Role Update Form Function
    public function jobRoleUpdate(Request $request)
    {

        $jobRole = JobRole::find($request->id);
        $jobRole->job_role = $request->job_role;
        $jobRole->update();
        return redirect()->route('admin.jobRole')->with('success', 'Job Role Updated Successfully.!');
    }
    // Job Role Delete Form Function
    public function jobRoleDelete($id)
    {
        $jobRoleDelete = JobRole::find($id)->delete();
        return redirect()->route('admin.jobRole')->with('delete', 'Job Role Deleted Successfully.!');
    }

    // ======================Admin Skill Function=============================

    
    public function skill(){
        $skills = Skill::get();
        $super_admin = SuperAdmin::get();
        return view('admin.skill.index',compact('skills','super_admin'));
    }

    public function skillAddForm(){
        return view('admin.skill.add');
    }

    public function skillStore(Request $request){
        $validatedData = $request->validate([
            'skill' => 'required',
        ]);

        $skillStore = new Skill();
        $skillStore->skill = $request->skill;
        $skillStore->save();
        return redirect()->route('admin.skill')->with('success','Skill Created Successfully.!');
        
    }

    public function skillEditForm($id){
        $skillEditForm = Skill::find($id);
        return view('admin.skill.edit',compact('skillEditForm'));
    }

    public function skillUpdate(Request $request){
        $skillStore =  Skill::find($request->id);
        $skillStore->skill = $request->skill;
        $skillStore->save();
        return redirect()->route('admin.skill')->with('success','Skill Updated Successfully.!');
    }

    public function skillDelete($id){
        $skillDelete = Skill::find($id)->delete();
        return redirect()->route('admin.skill')->with('delete','Skill Deleted Successfully.!');

    }

// ======================Admin Post Job Function=============================
    // Show All Jobs
    public function jobPosts()
    {
        $super_admin = SuperAdmin::get();
        $jobs = job::join('job_roles','jobs.job_role','=','job_roles.id')->select('jobs.*','job_roles.job_role',)->get(); 

        
        foreach($jobs as $val)
        {
            $arr = array();
            $final = array();
            foreach(json_decode($val->skill) as $row)
            {
                $data = Skill::where('id',$row)->select('skill')->first();
                array_push($arr,$data);
            }
            foreach($arr as $res)
            {
                if(!is_null($res))
                {
                    array_push($final,$res->skill);
                }
            }
            $val->skills = $final;
        }

        return view('admin.jobPost.index', compact('jobs','super_admin'));
    }

    public function addJobPostView()
    {
        // $company = Company::get();
        $super_admin = SuperAdmin::get();
        $company = User::where('role',1)->get();
        $skills = Skill::get();
        $jobRole = JobRole::get();
        return view('admin.jobPost.add', compact('company','skills','jobRole','super_admin'));
    }

    // Job Store Form Function
    public function jobPostStore(Request $request)
    {
        $validatedData = $request->validate([
            'company_id' => 'required',
            'job_title' => 'required',
            'skill' => 'required',
            'job_role' => 'required',
            'description' => 'required',

        ]);
    //    dd($request->skill);
        $jobStore = new Job();
        $jobStore->user_id = $request->company_id;
        $jobStore->job_title = $request->job_title;
        $jobStore->skill = json_encode($request->skill);  // json_decode
        $jobStore->job_role = $request->job_role;
        $jobStore->description = $request->description;
        $jobStore->save();

        $notification = new Notification();
        $notification->title = $jobStore->job_title;
        $notification->job_id = $jobStore->id;
        $notification->type = "User";
        $notification->save();

        return redirect()->route('admin.jobPosts')->with('success', 'Job Post Create Successfully.....!');
    }


    public function editJobPostView($id)
    {
        $jobPostEdit = Job::find($id);
        $skills = Skill::get();
        $companys = User::where('role',1)->get();
        $jobRole = JobRole::get();
        $super_admin = SuperAdmin::get();
        return view('admin.jobPost.edit',compact('jobPostEdit','companys','jobRole','skills','super_admin'));
    }


    public function jobPostUpdate(Request $request){

        $jobUpdate = Job::find($request->id);
        $jobUpdate->user_id = $request->company_id;
        $jobUpdate->job_title = $request->job_title;
        $jobUpdate->skill = $request->skill;
        $jobUpdate->job_role = $request->job_role;
        $jobUpdate->description = $request->description;

        $jobUpdate->update();

        return redirect()->route('admin.jobPosts')->with('success', 'Job Post Updated Successfully.....!');
    }

    public function jobPostDelete($id){
        $jobPostDelete = Job::find($id)->delete();
        return redirect()->route('admin.jobPosts')->with('delete', 'Job Post Updated Successfully.....!');
    }


    // =================================Applied Job User Function============================
    public function allJobs()
    {
        
        $allJobs = job::join('users','users.id','=','jobs.user_id')->join('applied_jobs','applied_jobs.job_id','=','jobs.id')->where('applied_jobs.status',1)->select('jobs.id as job_id','jobs.job_title','users.*')->get();
        $super_admin = SuperAdmin::get();
        return view('admin.jobPost.applied_jobs', compact('allJobs','super_admin'));

    }
// ======================Admin Screening User Show Function=============================
    public function screeningJobUsers($jobid)
    {
      
        $appliedJobs = AppliedJob::join('users', 'users.id', '=', 'applied_jobs.user_id')->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')->where('applied_jobs.job_id', $jobid)->select('applied_jobs.id as applied_job_id', 'applied_jobs.screening_schedule','applied_jobs.interview_schedule','applied_jobs.selected', 'users.id as user_id', 'users.name', 'users.email', 'users.mobile_no', 'jobs.job_title')->get();
        $super_admin = SuperAdmin::get();
        return view('admin.jobPost.applied_jobs_user', compact('appliedJobs','super_admin'));
    }
// ======================Admin Screening Status User Show Function=============================
    public function jobStatusScreening(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();
        
        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->screening_schedule = 1;
            $appliedJob->update();

            $job = Job::find($appliedJob->job_id);
            $user = User::find($appliedJob->user_id);
            $datas = [
                [
                    'title'=>$job->job_title." Screening Scheduled.",
                    'user_id'=>$appliedJob->user_id,
                    'job_id'=>$appliedJob->job_id,
                    'type'=>"User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title'=>$job->job_title.' <b>'.$user->name."</b> Screening Scheduled.",
                    'user_id'=>$job->user_id,
                    'job_id'=>$appliedJob->job_id,
                    'type'=>"Client",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ];

            foreach($datas as $data){
                DB::table('notifications')->insert($data);
            }
        
            return response()->json(['result'=>'Screening Scheduled','status'=>'success']);
        } else {
            $appliedJob->screening_schedule = 0;
            $appliedJob->update();
            return response()->json(['result'=>'Screening Not Scheduled','status'=>'success']);
        }
    }

    public function jobStatusInterview(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();
        
        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->interview_schedule = 1;
            $appliedJob->update();

            $job = Job::find($appliedJob->job_id);
            $user = User::find($appliedJob->user_id);
            $datas = [
                [
                    'title'=>$job->job_title." Interview Scheduled.",
                    'user_id'=>$appliedJob->user_id,
                    'job_id'=>$appliedJob->job_id,
                    'type'=>"User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title'=>$job->job_title.' <b>'.$user->name."</b> Interview Scheduled.",
                    'user_id'=>$job->user_id,
                    'job_id'=>$appliedJob->job_id,
                    'type'=>"Client",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ];

            foreach($datas as $data){
                DB::table('notifications')->insert($data);
            }

            return response()->json(['result'=>'Interview Scheduled','status'=>'success']);
        } else {
            $appliedJob->interview_schedule = 0;
            $appliedJob->update();
            return response()->json(['result'=>'Interview Not Scheduled','status'=>'success']);
        }
    }

    public function jobStatusSelected(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();
        
        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->selected = 1;
            $appliedJob->update();

            $job = Job::find($appliedJob->job_id);
            $user = User::find($appliedJob->user_id);
            $datas = [
                [
                    'title'=>$job->job_title." Selected.",
                    'user_id'=>$appliedJob->user_id,
                    'job_id'=>$appliedJob->job_id,
                    'type'=>"User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title'=>$job->job_title.' <b>'.$user->name."</b> Selected.",
                    'user_id'=>$job->user_id,
                    'job_id'=>$appliedJob->job_id,
                    'type'=>"Client",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ];

            foreach($datas as $data){
                DB::table('notifications')->insert($data);
            }
            return response()->json(['result'=>'Selected','status'=>'success']);
        } else {
            $appliedJob->selected = 0;
            $appliedJob->update();
            return response()->json(['result'=>'Not Selected','status'=>'success']);
        }
    }


}
