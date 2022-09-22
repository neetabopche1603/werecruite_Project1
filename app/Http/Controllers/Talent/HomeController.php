<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Job;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Models\AppliedJob;

class HomeController extends Controller
{
    public function talentHome(){
        $setting = Setting::get();
        return view('talentPartner.home',compact('setting'));
    }

    // NOTIFICATION SEEN FUNCTION
    public function seen(Request $request)
    {
        Notification::where('id',$request->id)->update(['is_seen' => 1]);
        return response()->json([
            "status"=>"success"
        ]);
    }

            // =====================VIEW JOBS=========================
    public function jobsView(){
        $jobs = Job::get();
        return view('talentPartner.jobs.jobs',compact('jobs'));
    }

    public function job_desc($id){
        // $jobs = Job::find($id);
        $jobs = Job::join('job_roles','jobs.job_role','=','job_roles.id')->select('jobs.*','job_roles.job_role')->where('jobs.id',$id)->first();
           
            $arr = array();
            $final = array();
            foreach(json_decode($jobs->skill) as $row)
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
            $jobs->skills = $final;

            $applied_job = AppliedJob::where('job_id', $jobs->id)->where('user_id', auth()->user()->id)->first();
										
        
        // $jobs = Job::join('job_roles','jobs.job_role','=','job_roles.id')->select('jobs.*','job_roles.*')->find($id)->get();
        return view('talentPartner.jobs.job_desc',compact('jobs','applied_job'));
    }
}
