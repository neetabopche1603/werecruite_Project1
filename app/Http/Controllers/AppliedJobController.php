<?php

namespace App\Http\Controllers;

use App\Models\AppliedJob;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppliedJobController extends Controller
{
    public function appliedJob($job_id){

        $data = AppliedJob::where('job_id',$job_id)->orderBy('id', 'DESC')->get();
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

        $job = Job::find($job_id);
        // $client = User::find($job->user_id);
        $data = [
            'title' => $job->job_title . ' <b>' . Auth::user()->name. "</b> Applied.",
            'user_id' => $job->user_id,
            'job_id' => $job_id,
            'type' => "Client",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        DB::table('notifications')->insert($data);
        return redirect()->back();
    }
}
