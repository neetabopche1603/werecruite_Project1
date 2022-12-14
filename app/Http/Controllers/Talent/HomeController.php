<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Job;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Models\AppliedJob;
use App\Models\Scheduler;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function talentHome()
    {
        $setting = Setting::get();
        return view('talentPartner.home', compact('setting'));
    }

    // NOTIFICATION SEEN FUNCTION
    public function seen(Request $request)
    {
        Notification::where('id', $request->id)->update(['is_seen' => 1]);
        return response()->json([
            "status" => "success"
        ]);
    }

    // =====================VIEW JOBS=========================
    public function jobsView()
    {
        $jobs = Job::orderBy('id', 'DESC')->get();
        return view('talentPartner.jobs.jobs', compact('jobs'));
    }

    public function job_desc($id)
    {
        // $jobs = Job::find($id);
        $jobs = Job::join('job_roles', 'jobs.job_role', '=', 'job_roles.id')->leftjoin('users', 'users.id', 'jobs.user_id')->select('jobs.*', 'job_roles.job_role', 'users.name as company_name')->where('jobs.id', $id)->first();
        // echo "<pre>";
        // print_r($jobs);
        // die();

        if ($jobs == NULL) {
            return redirect()->back()->with('success', "Job Not Found.");
        }
        $arr = array();
        $final = array();
        foreach (json_decode($jobs->skill) as $row) {
            $data = Skill::where('id', $row)->select('skill')->first();
            array_push($arr, $data);
        }
        foreach ($arr as $res) {
            if (!is_null($res)) {
                array_push($final, $res->skill);
            }
        }
        $jobs->skills = $final;


        $applied_job = AppliedJob::where('job_id', $jobs->id)->where('user_id', auth()->user()->id)->first();

        // $jobs = Job::join('job_roles','jobs.job_role','=','job_roles.id')->select('jobs.*','job_roles.*')->find($id)->get();
        return view('talentPartner.jobs.job_desc', compact('jobs', 'applied_job'));
    }


    // Calender Function
    public function schedule_calendar()
    {
        $schedules = Scheduler::join('jobs', 'jobs.id', '=', 'schedulers.job_id')->leftjoin('users', 'users.id', 'jobs.user_id')->select('jobs.job_title', 'schedulers.*', 'users.id as user_ids', 'users.name as company_name')->where('schedulers.user_id', auth()->user()->id)->get();
        return view('talentPartner.calender', compact('schedules'));
    }


    public function getEvents()
    {
        $events = Scheduler::where('user_id', auth()->user()->id)->select('title', 'actual_sche_date')->get();
        $data = [];
        foreach ($events as $event) {
            $datas = [
                'title' => $event->title,
                'start' => $event->actual_sche_date,
                // 'start'=>$event->actual_sche_date,
                'allDay' => false,
                'className' => 'bg-primary'
            ];
            array_push($data, $datas);
        }

        return response()->json($data);
    }

    public function setInterviewDate(Request $request)
    {
        $dates = json_encode($request->date);
        Scheduler::where('job_id', $request->job_id)->where('user_id', $request->user_id)->update(
            [
                'user_sche_date' => $dates
            ]
        );

        return redirect()->back()->with('success', 'Prefered Date Successfully Send.');
    }


    public function viewAppliedJob()
    {
        // $totalAppliedJob = DB::table('applied_jobs')->where('user_id','=',auth()->user()->id)->orderBy('id','DESC')->get();

        $viewAppliedJob = AppliedJob::join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')->leftjoin('users', 'users.id', '=', 'jobs.user_id')->where('applied_jobs.user_id', '=', auth()->user()->id)->select('users.name as company_name', 'jobs.job_title', 'applied_jobs.id as applied_job_id', 'jobs.id as jobId', 'users.id as userId', 'applied_jobs.created_at', 'applied_jobs.status', 'applied_jobs.screening_schedule', 'applied_jobs.interview_schedule', 'applied_jobs.selected')->orderBy('applied_jobs.id', 'DESC')->get();
        return view('talentPartner.view-applied-job', compact('viewAppliedJob'));
    }
}
