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
        $jobs = Job::get();
        return view('talentPartner.jobs.jobs', compact('jobs'));
    }

    public function job_desc($id)
    {
        // $jobs = Job::find($id);
        $jobs = Job::join('job_roles', 'jobs.job_role', '=', 'job_roles.id')->select('jobs.*', 'job_roles.job_role')->where('jobs.id', $id)->first();

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
        $schedules = Scheduler::join('jobs','jobs.id','=','schedulers.job_id')->select('jobs.job_title','schedulers.*')->where('schedulers.user_id',auth()->user()->id)->get();
        return view('talentPartner.calender',compact('schedules'));
    }
    public function getEvents()
    {
        $events = Scheduler::where('user_id', auth()->user()->id)->select('title','actual_sche_date')->get();
        $data = [];
        foreach($events as $event){
            $datas = [
                'title'=>$event->title,
                'start'=>$event->actual_sche_date,
                // 'start'=>$event->actual_sche_date,
                'allDay'=>false,
                'className'=>'bg-primary'
            ];
            array_push($data,$datas);
        }

        return response()->json($data);
    }

    public function setInterviewDate(Request $request){
        $dates = json_encode($request->date);
       Scheduler::where('job_id',$request->job_id)->where('user_id',$request->user_id)->update(
        [
            'user_sche_date'=>$dates
        ]
        );

        return redirect()->back()->with('success','Prefered Date Successfully Send.');

    }
}
