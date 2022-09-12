<?php

namespace App\Http\Controllers;

use App\Models\AppliedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppliedJobController extends Controller
{
    public function appliedJob($job_id){

        $data = AppliedJob::where('job_id',$job_id)->get();
        foreach($data as $row)
        {
            if($row->user_id == Auth::user()->id)
            {
                return redirect()->back();
            }
        }
        
        $appliedJob = new AppliedJob();
        $appliedJob->status = 0;
        $appliedJob->user_id = Auth::user()->id;
        $appliedJob->job_id = $job_id;

        $appliedJob->save();
        return redirect()->back();
    }
}
