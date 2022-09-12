<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function jobsView(){
        $jobs = Job::get();
        return view('talentPartner.jobs.jobs',compact('jobs'));
    }

    public function job_desc($id){
        $jobs = Job::find($id);
        return view('talentPartner.jobs.job_desc',compact('jobs'));
    }
}
