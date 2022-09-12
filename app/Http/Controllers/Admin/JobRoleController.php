<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobRole;
use Illuminate\Http\Request;

class JobRoleController extends Controller
{
    // Job Role Function (View Tbl)
    public function jobRole()
    {
        $jobRoles = JobRole::get();
        return view('admin.job_Role.index',compact('jobRoles'));
    }
    // Job Role Add Form Function
    public function jobRoleAddForm()
    {
        return view('admin.job_Role.add');
    }
    // Job Role Store Form Function
    public function jobRoleAddStore(Request $request)
    {
        $validatedData = $request->validate([
            'job_role' => 'required',
        ]);

        $jobRole = new JobRole();
        $jobRole->job_role = $request->job_role;
        $jobRole->save();
        return redirect()->route('admin.jobRole')->with('success', 'JobRole Created Successfully.!');
    }

    // Job Role Edit Form Function
    public function jobRoleEdit($id)
    {
        $jobRoleEdit = JobRole::find($id);
        return view('admin.job_Role.edit', compact('jobRoleEdit'));
    }
    // Job Role Update Form Function
    public function jobRoleUpdate(Request $request)
    {

        $jobRole = JobRole::find($request->id);
        $jobRole->job_role = $request->job_role;
        $jobRole->update();
        return redirect()->route('admin.jobRole')->with('success', 'JobRole Updated Successfully.!');
    }
    // Job Role Delete Form Function
    public function jobRoleDelete($id)
    {
        $jobRoleDelete = JobRole::find($id)->delete();
        return redirect()->route('admin.jobRole')->with('delete', 'JobRole Deleted Successfully.!');
    }
}
