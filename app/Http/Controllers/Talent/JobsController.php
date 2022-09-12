<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function jobsView(){
        // $jobs = Job::leftJoin('applied_jobs','jobs.id','=','applied_jobs.job_id')->select('jobs.*','applied_jobs.user_id as user_id')->get();
        $jobs = Job::all();
        return view('talentPartner.jobs.jobs',compact('jobs'));
    }

    public function job_desc($id){
        $jobs = Job::find($id);
        return view('talentPartner.jobs.job_desc',compact('jobs'));
    }
}
