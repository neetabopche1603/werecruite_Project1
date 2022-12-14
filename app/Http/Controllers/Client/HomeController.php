<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\Job;
use App\Models\JobRole;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function clientHome()
    {
        $setting = Setting::get();
        return view('clientPartner.home', compact('setting'));
    }

    // ===================Jobs Function (Show Job)===================
    public function index()
    {
        // $jobs = Job::where('user_id',auth()->user()->id)->get();
        $jobs = Job::join('users', 'jobs.user_id', '=', 'users.id')->join('job_roles', 'jobs.job_role', '=', 'job_roles.id')->where('jobs.user_id', auth()->user()->id)->select('users.*', 'jobs.*', 'job_roles.*','users.id as user_id','jobs.id as job_id','job_roles.id as jobRole_id')->get();

        // $jobs = Job::get();
        foreach ($jobs as $val) {
            $arr = array();
            $final = array();
            if(is_array(json_decode($val->skill)))
            {
            foreach (json_decode($val->skill) as $row) {
                $data = Skill::where('id', $row)->select('skill')->first();
                array_push($arr, $data);
            }
        }
            foreach ($arr as $res) {
                if (!is_null($res)) {
                    array_push($final, $res->skill);
                }
            }
            $val->skills = $final;
        }


        return view('clientPartner.job.index', compact('jobs'));
    }

    // Job Add View Form Function
    public function jobAddView()
    {
        $skills = Skill::get();
        $jobRole = JobRole::get();
        return view('clientPartner.job.add', compact('skills', 'jobRole'));
    }
    // Job Store Form Function
    public function jobAddStore(Request $request)
    {
        $validatedData = $request->validate([
            'job_title' => 'required',
            'skill' => 'required',
            'job_role' => 'required',
            'description' => 'required',

        ]);

        $jobStore = new Job();
        $jobStore->job_title = $request->job_title;
        $jobStore->user_id = auth()->user()->id;
        $jobStore->skill = json_encode($request->skill);
        // $jobStore->skill = $request->skill;
        $jobStore->job_role = $request->job_role;
        $jobStore->description = $request->description;
        $jobStore->save();

        $notification = new Notification();
        $notification->title = $jobStore->job_title;
        $notification->job_id = $jobStore->id;
        $notification->type = "User";
        $notification->save();

        return redirect()->route('client.showJob')->with('success', 'Job Create Successfully.....!');
    }

    // Job Edit View Form Function
    public function jobEditView($id)
    {
        $jobEditViews = Job::find($id);
        $skills = Skill::get();
        $jobRole = JobRole::get();
        return view('clientPartner.job.edit', compact('jobEditViews', 'skills', 'jobRole'));
    }

    // Job Update Form Function
    public function jobUpdate(Request $request)
    {
        $jobUpdate = Job::find($request->id);

        $jobUpdate->job_title = $request->job_title;
        $jobUpdate->skill = json_encode($request->skill);
        $jobUpdate->job_role = $request->job_role;
        $jobUpdate->description = $request->description;

        $jobUpdate->update();

        return redirect()->route('client.showJob')->with('success', 'Job Updated Successfully.....!');
    }

    // Job Delete Function

    public function jobDelete($id)
    {
        Job::find($id)->delete();
        AppliedJob::where('job_id',$id)->delete();
        return redirect()->route('client.showJob')->with('delete', 'Job Deleted Successfully.....!');
    }

    // Applied Job
    public function allJobs()
    {
        $allJobs = job::where('user_id', auth()->user()->id)->get();
        return view('clientPartner.job.applied_jobs', compact('allJobs'));
    }

    public function appliedJobUsers($jobid)
    {
        $appliedJobs = AppliedJob::join('users', 'users.id', '=', 'applied_jobs.user_id')->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')->where('applied_jobs.job_id', $jobid)->select('applied_jobs.id as applied_job_id', 'applied_jobs.status', 'users.id as user_id', 'users.name', 'users.email', 'users.mobile_no', 'jobs.job_title')->get();
        return view('clientPartner.job.applied_jobs_user', compact('appliedJobs'));
    }

    public function jobStatus(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();

        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->status = 1;
            $appliedJob->adminChangeStatus = "screening by company";
            $appliedJob->update();

            $job = Job::find($appliedJob->job_id);
            $user = User::find($appliedJob->user_id);
            $datas = [
                [
                    'title' => $job->job_title . " Status Updated Screening.",
                    'user_id' => $appliedJob->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title' => $job->job_title . ' <b>' . $user->name . "</b> Screening Updated Client.",
                    'user_id' => 0,
                    'job_id' => $appliedJob->job_id,
                    'type' => "Admin",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ];

            foreach ($datas as $data) {
                DB::table('notifications')->insert($data);
            }

            return response()->json('Screening');
        } else {
            $appliedJob->status = 0;
            $appliedJob->update();
            return response()->json('applied');
        }
    }

    public function appliedJobsDeleted($appliedJobId)
    {
        AppliedJob::find($appliedJobId)->delete();
        return redirect()->back()->with('delete', 'Applied Job Deleted Successfully.!');
    }




    public function seen($id)
    {
        Notification::find($id)->update(['is_seen' => 1]);
        return redirect()->back();
    }
}
