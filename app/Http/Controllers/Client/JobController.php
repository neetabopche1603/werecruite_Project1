<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Jobs Function (Show Job)
    public function index()
    {
        $jobs = Job::get();
        return view('clientPartner.job.index',compact('jobs'));
    }

    // Job Add View Form Function
    public function jobAddView()
    {
        return view('clientPartner.job.add');
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
        $jobStore->skill = $request->skill;
        $jobStore->job_role = $request->job_role;
        $jobStore->description = $request->description;

        $jobStore->save();

        return redirect()->route('client.showJob')->with('success','Job Create Successfully.....!');

    }

    // Job Edit View Form Function
    public function jobEditView($id)
    {
        $jobEditViews = Job::find($id);
        return view('clientPartner.job.edit',compact('jobEditViews'));
    }

    // Job Update Form Function
    public function jobUpdate(Request $request){
        $jobUpdate = Job::find($request->id);

        $jobUpdate->job_title = $request->job_title;
        $jobUpdate->skill = $request->skill;
        $jobUpdate->job_role = $request->job_role;
        $jobUpdate->description = $request->description;

        $jobUpdate->update();

        return redirect()->route('client.showJob')->with('success','Job Updated Successfully.....!');
    }

    // Job Delete Function

    public function jobDelete($id){
        $jobDelete = Job::find($id)->delete();
        return redirect()->route('client.showJob')->with('delete','Job Deleted Successfully.....!');

    }
}
