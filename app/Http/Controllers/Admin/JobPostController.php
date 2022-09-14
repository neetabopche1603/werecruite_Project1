<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobRole;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    // Show All Jobs
    public function jobPosts()
    {
    //     $orderList = DB::table('users')
    // ->join('orders', 'users.id', '=', 'orders.user_id')
    // ->join('order_items', 'orders.id', '=', 'order_items.orders_id')
    // ->where('users.id', '=', 5)
    // ->get();

        // $jobs = Job::join('companies','jobs.user_id','=','companies.id')->select('jobs.*','companies.*')->get();

        $jobs = job::join('users','jobs.user_id','=','users.id')->where('role',1)->join('job_roles','jobs.job_role','=','job_roles.id')->select('users.*','jobs.*','job_roles.*',)->get(); 

        // $jobs = Job::get();
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

        return view('admin.jobPost.index', compact('jobs'));
    }

    public function addJobPostView()
    {
        // $company = Company::get();
        $company = User::where('role',1)->get();
        $skills = Skill::get();
        $jobRole = JobRole::get();
        return view('admin.jobPost.add', compact('company','skills','jobRole'));
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

        return redirect()->route('admin.jobPosts')->with('success', 'Job Post Create Successfully.....!');
    }


    public function editJobPostView($id)
    {
        $jobPostEdit = Job::find($id);
        $skills = Skill::get();
        $companys = User::where('role',1)->get();
        $jobRole = JobRole::get();
        return view('admin.jobPost.edit',compact('jobPostEdit','companys','jobRole','skills'));
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


    // Applied Job
    public function allJobs()
    {
        $allJobs = job::join('users','users.id','=','jobs.user_id')->select('jobs.id as job_id','jobs.job_title','users.*')->get();
        return view('admin.jobPost.applied_jobs', compact('allJobs'));
    }

    public function screeningJobUsers($jobid)
    {
        $appliedJobs = AppliedJob::join('users', 'users.id', '=', 'applied_jobs.user_id')->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')->where('applied_jobs.job_id', $jobid)->select('applied_jobs.id as applied_job_id', 'applied_jobs.screening_schedule','applied_jobs.interview_schedule','applied_jobs.selected', 'users.id as user_id', 'users.name', 'users.email', 'users.mobile_no', 'jobs.job_title')->get();
        return view('admin.jobPost.applied_jobs_user', compact('appliedJobs'));
    }

    public function jobStatusScreening(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();
        
        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->screening_schedule = 1;
            $appliedJob->update();
            return response()->json('Screening Scheduled');
        } else {
            $appliedJob->screening_schedule = 0;
            $appliedJob->update();
            return response()->json('Screening Not Scheduled');
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
            return response()->json('Interview Scheduled');
        } else {
            $appliedJob->interview_schedule = 0;
            $appliedJob->update();
            return response()->json('Interview Not Scheduled');
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
            return response()->json('Selected');
        } else {
            $appliedJob->selected = 0;
            $appliedJob->update();
            return response()->json('Not Selected');
        }
    }


}
