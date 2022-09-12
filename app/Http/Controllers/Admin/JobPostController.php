<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    // Show All Jobs
    public function jobPosts()
    {
        $jobs = Job::join('companies','jobs.user_id','=','companies.user_id')->select('jobs.*','companies.*')->get();

        return view('admin.jobPost.index', compact('jobs'));
    }

    public function addJobPostView()
    {
        $company = Company::get();
        return view('admin.jobPost.add', compact('company'));
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

        $jobStore = new Job();
        $jobStore->user_id = $request->company_id;
        $jobStore->job_title = $request->job_title;
        $jobStore->skill = $request->skill;
        $jobStore->job_role = $request->job_role;
        $jobStore->description = $request->description;

        $jobStore->save();

        return redirect()->route('admin.jobPosts')->with('success', 'Job Post Create Successfully.....!');
    }


    public function editJobPostView($id)
    {
        $jobPostEdit = Job::find($id);
        $companys = Company::get();
        return view('admin.jobPost.edit',compact('jobPostEdit','companys'));
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
}
