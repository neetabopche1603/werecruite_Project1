<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\Job;
use App\Models\JobRole;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SuperAdmin;
use App\Models\Notification;
use App\Models\Scheduler;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services;

class HomeController extends Controller
{
    public function adminHome()
    {
        $super_admin = SuperAdmin::get();
        return view('admin.home', compact('super_admin'));
    }

    // ======================Admin Job Role Function=============================
    // Job Role Function (View Tbl)
    public function jobRole()
    {
        $jobRoles = JobRole::get();
        $super_admin = SuperAdmin::get();
        return view('admin.job_Role.index', compact('jobRoles', 'super_admin'));
    }
    // Job Role Add Form Function
    public function jobRoleAddForm()
    {
        $super_admin = SuperAdmin::get();
        return view('admin.job_Role.add', compact('super_admin'));
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
        return redirect()->route('admin.jobRole')->with('success', 'Job Role Created Successfully.!');
    }

    // Job Role Edit Form Function
    public function jobRoleEdit($id)
    {
        $jobRoleEdit = JobRole::find($id);
        $super_admin = SuperAdmin::get();
        return view('admin.job_Role.edit', compact('jobRoleEdit', 'super_admin'));
    }
    // Job Role Update Form Function
    public function jobRoleUpdate(Request $request)
    {

        $jobRole = JobRole::find($request->id);
        $jobRole->job_role = $request->job_role;
        $jobRole->update();
        return redirect()->route('admin.jobRole')->with('success', 'Job Role Updated Successfully.!');
    }
    // Job Role Delete Form Function
    public function jobRoleDelete($id)
    {
        $jobRoleDelete = JobRole::find($id)->delete();
        return redirect()->route('admin.jobRole')->with('delete', 'Job Role Deleted Successfully.!');
    }

    // ======================Admin Job Role End=============================

    // ======================Admin Skill Function=============================

    public function skill()
    {
        $skills = Skill::get();
        $super_admin = SuperAdmin::get();
        return view('admin.skill.index', compact('skills', 'super_admin'));
    }

    public function skillAddForm()
    {
        return view('admin.skill.add');
    }

    public function skillStore(Request $request)
    {
        $validatedData = $request->validate([
            'skill' => 'required',
        ]);

        $skillStore = new Skill();
        $skillStore->skill = $request->skill;
        $skillStore->save();
        return redirect()->route('admin.skill')->with('success', 'Skill Created Successfully.!');
    }

    public function skillEditForm($id)
    {
        $skillEditForm = Skill::find($id);
        return view('admin.skill.edit', compact('skillEditForm'));
    }

    public function skillUpdate(Request $request)
    {
        $skillStore =  Skill::find($request->id);
        $skillStore->skill = $request->skill;
        $skillStore->save();
        return redirect()->route('admin.skill')->with('success', 'Skill Updated Successfully.!');
    }

    public function skillDelete($id)
    {
        $skillDelete = Skill::find($id)->delete();
        return redirect()->route('admin.skill')->with('delete', 'Skill Deleted Successfully.!');
    }

    // ======================Admin Skill End=============================

    // ======================Admin Post Job Function=============================
    // Show All Jobs
    public function jobPosts()
    {
        $super_admin = SuperAdmin::get();
        $jobs = job::join('job_roles', 'jobs.job_role', '=', 'job_roles.id')->select('jobs.*', 'job_roles.job_role',)->get();

        foreach ($jobs as $val) {
            $arr = array();
            $final = array();
            foreach (json_decode($val->skill) as $row) {
                $data = Skill::where('id', $row)->select('skill')->first();
                array_push($arr, $data);
            }
            foreach ($arr as $res) {
                if (!is_null($res)) {
                    array_push($final, $res->skill);
                }
            }
            $val->skills = $final;
        }

        return view('admin.jobPost.index', compact('jobs', 'super_admin'));
    }

    public function addJobPostView()
    {
        // $company = Company::get();
        $super_admin = SuperAdmin::get();
        $company = User::where('role', 1)->get();
        $skills = Skill::get();
        $jobRole = JobRole::get();
        return view('admin.jobPost.add', compact('company', 'skills', 'jobRole', 'super_admin'));
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
        //    dd($request->skill);
        $jobStore = new Job();
        $jobStore->user_id = $request->company_id;
        $jobStore->job_title = $request->job_title;
        $jobStore->skill = json_encode($request->skill);  // json_decode
        $jobStore->job_role = $request->job_role;
        $jobStore->description = $request->description;
        $jobStore->save();

        $notification = new Notification();
        $notification->title = $jobStore->job_title;
        $notification->job_id = $jobStore->id;
        $notification->type = "User";
        $notification->save();

        return redirect()->route('admin.jobPosts')->with('success', 'Job Post Create Successfully.....!');
    }


    public function editJobPostView($id)
    {
        $jobPostEdit = Job::find($id);
        $skills = Skill::get();
        $companys = User::where('role', 1)->get();
        $jobRole = JobRole::get();
        $super_admin = SuperAdmin::get();
        return view('admin.jobPost.edit', compact('jobPostEdit', 'companys', 'jobRole', 'skills', 'super_admin'));
    }


    public function jobPostUpdate(Request $request)
    {

        $jobUpdate = Job::find($request->id);
        $jobUpdate->user_id = $request->company_id;
        $jobUpdate->job_title = $request->job_title;
        $jobUpdate->skill = $request->skill;
        $jobUpdate->job_role = $request->job_role;
        $jobUpdate->description = $request->description;

        $jobUpdate->update();

        return redirect()->route('admin.jobPosts')->with('success', 'Job Post Updated Successfully.....!');
    }

    public function jobPostDelete($id)
    {
        $jobPostDelete = Job::find($id)->delete();
        return redirect()->route('admin.jobPosts')->with('delete', 'Job Post Updated Successfully.....!');
    }
    // ======================Admin Post Job End=============================

    // =================================Applied Job User Function============================
    public function allJobs()
    {
        $allJobs = job::join('users', 'users.id', '=', 'jobs.user_id')->select('jobs.id as job_id', 'jobs.job_title', 'users.*')->get();

        // $allJobs = AppliedJob::join('jobs','jobs.id','=','applied_jobs.job_id')->join('users','users.id','=','jobs.user_id')->where('applied_jobs.status', 1)->select('jobs.id as job_id', 'jobs.job_title', 'users.name')->get();


        $super_admin = SuperAdmin::get();
        return view('admin.jobPost.applied_jobs', compact('allJobs', 'super_admin'));
    }
    // ======================Admin Screening User Show Function=============================
    public function screeningJobUsers($jobid)
    {

        $appliedJobs = AppliedJob::join('users', 'users.id', '=', 'applied_jobs.user_id')->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')->where('applied_jobs.job_id', $jobid)->where('applied_jobs.status', 1)->select('applied_jobs.id as applied_job_id', 'applied_jobs.screening_schedule', 'applied_jobs.interview_schedule', 'applied_jobs.selected', 'users.id as user_id', 'users.name', 'users.email', 'users.mobile_no', 'jobs.job_title', 'jobs.id as jobId')->get();
        $super_admin = SuperAdmin::get();
        return view('admin.jobPost.applied_jobs_user', compact('appliedJobs', 'super_admin'));
    }
    // ======================Admin Screening Status User Show Function=============================
    public function jobStatusScreening(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();

        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->screening_schedule = 1;
            $appliedJob->update();

            $job = Job::find($appliedJob->job_id);
            $user = User::find($appliedJob->user_id);
            $datas = [
                [
                    'title' => $job->job_title . " Screening Scheduled.",
                    'user_id' => $appliedJob->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title' => $job->job_title . ' <b>' . $user->name . "</b> Screening Scheduled.",
                    'user_id' => $job->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "Client",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ];

            foreach ($datas as $data) {
                DB::table('notifications')->insert($data);
            }

            return response()->json(['result' => 'Screening Scheduled', 'status' => 'success']);
        } else {
            $appliedJob->screening_schedule = 0;
            $appliedJob->update();
            return response()->json(['result' => 'Screening Not Scheduled', 'status' => 'success']);
        }
    }

    public function jobStatusInterview(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();

        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->interview_schedule = 1;
            $appliedJob->update();

            $job = Job::find($appliedJob->job_id);
            $user = User::find($appliedJob->user_id);
            $datas = [
                [
                    'title' => $job->job_title . " Interview Scheduled.",
                    'user_id' => $appliedJob->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title' => $job->job_title . ' <b>' . $user->name . "</b> Interview Scheduled.",
                    'user_id' => $job->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "Client",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ];

            foreach ($datas as $data) {
                DB::table('notifications')->insert($data);
            }

            return response()->json(['result' => 'Interview Scheduled', 'status' => 'success']);
        } else {
            $appliedJob->interview_schedule = 0;
            $appliedJob->update();
            return response()->json(['result' => 'Interview Not Scheduled', 'status' => 'success']);
        }
    }

    public function jobStatusSelected(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();

        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->selected = 1;
            $appliedJob->update();

            $job = Job::find($appliedJob->job_id);
            $user = User::find($appliedJob->user_id);
            $datas = [
                [
                    'title' => $job->job_title . " Selected.",
                    'user_id' => $appliedJob->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title' => $job->job_title . ' <b>' . $user->name . "</b> Selected.",
                    'user_id' => $job->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "Client",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ];

            foreach ($datas as $data) {
                DB::table('notifications')->insert($data);
            }
            return response()->json(['result' => 'Selected', 'status' => 'success']);
        } else {
            $appliedJob->selected = 0;
            $appliedJob->update();
            return response()->json(['result' => 'Not Selected', 'status' => 'success']);
        }
    }

    // NOTIFICATION SEEN FUNCTION
    public function seen(Request $request)
    {
        Notification::where('id', $request->id)->update(['is_seen' => 1]);
        return response()->json([
            "status" => "success"
        ]);
    }

    // GOOGLE 
    public function scheduleInterview(Request $request)
    {
        $schedule = new Scheduler();
        $schedule->title = $request->title;
        $schedule->user_id = $request->user_id;
        $schedule->job_id = $request->job_id;
        $schedule->admin_sche_date = $request->date;
        $schedule->save();

        // $date = Carbon::parse(strtotime($request->date), 'Asia/Kolkata');
        // $time = Carbon::parse(strtotime($request->date), 'Asia/Kolkata');
        // $event = new Event;
        // $event->name = $request->title;
        // $event->startDateTime = $date;
        // $event->endDateTime = $time;
        // $event->save();
        // $e = Event::get();

        $user = User::find($request->user_id);
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'date' => Carbon::parse($request->date)->format('d/m/Y'),
            'time' => Carbon::parse($request->date)->format('g:i A'),
            'user_id' => $request->user_id,
            'schedule_id' => $schedule->id
        ];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        // $data = User::where('id', $request->user_id)->get()->toArray();
        Mail::send('mail', $data, function ($message) use ($user, $request) {
            $message->to($user->email, $request->title)->subject('Interview Schedule');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });

        // return redirect()->route('admin.screeningJobUsers', $request->id)->with('success', 'Interview Scheduled Successfully.....!');
        return redirect()->back()->with('success', 'Interview Scheduled Successfully.....!');
    }

    public function scheduleInterviewCancel($id, $user_id)
    {
        Auth::loginUsingId($user_id);
        return redirect()->route('talent.scheduleCalendar');
    }

    // public function scheduleInterviewConfirm($id)
    // {
    //     $schedule = Scheduler::find($id);
    //     $user_email = User::find($schedule->user_id);
    //     $date = Carbon::parse(strtotime($schedule->admin_sche_date), 'Asia/Kolkata');
    //     $time = Carbon::parse(strtotime($schedule->admin_sche_date), 'Asia/Kolkata');
    //     $event = new Event;
    //     $event->name = $schedule->title;
    //     $event->startDateTime = $date;
    //     $event->endDateTime = $time;
    //     // $event->addAttendee([
    //     //     'email' => $user_email->email,
    //     //     'name' => $user_email->name,
    //     // ]);
    //     $event->save();
    //     $e = Event::get($event->id);

    //     echo "<pre>";
    //     print_r($e);
    //     echo "</pre>";
    //     die();
    // }



    public function scheduleInterviewConfirm($id)
    {
        $schedule = Scheduler::find($id);
        $user_email = User::find($schedule->user_id);
        $date = Carbon::parse($schedule->admin_sche_date, 'Asia/Kolkata');
        $time = Carbon::parse($schedule->admin_sche_date, 'Asia/Kolkata');
        $event = new Event;
        $event->name = $schedule->title;
        $event->startDateTime = $date;
        $event->endDateTime = $time;
        // $event->addAttendee([
        //     'email' => $user_email->email,
        //     'name' => $user_email->name,
        // ]);
        $event->save();
        $e = Event::get($event->id);
        $schedule->actual_sche_date = $schedule->admin_sche_date;
        $schedule->update();

        // Notification
        $applied_job = AppliedJob::where('job_id', $schedule->job_id)->where('user_id', $schedule->user_id)->first();
        $applied_job->interview_schedule = 1;
        $applied_job->update();

        $job = Job::find($applied_job->job_id);
        $user = User::find($applied_job->user_id);
        $datas = [
            [
                'title' => $job->job_title . " Interview Scheduled.",
                'user_id' => $applied_job->user_id,
                'job_id' => $applied_job->job_id,
                'type' => "User",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => $job->job_title . ' <b>' . $user->name . "</b> Interview Scheduled.",
                'user_id' => $job->user_id,
                'job_id' => $applied_job->job_id,
                'type' => "Client",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ];

        foreach ($datas as $data) {
            DB::table('notifications')->insert($data);
        }
        // Notification End

        $data = [
            'name' => $user_email->name,
            'email' => $user_email->email,
            'date' => Carbon::parse($date)->format('d/m/Y'),
            'time' => Carbon::parse($time)->format('g:i A'),
            'user_id' => $user_email->id,
            'schedule_id' => $schedule->id
        ];
        Mail::send('mailed', $data, function ($message) use ($user_email) {
            $message->to($user_email->email)->subject('Interview Scheduled');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });

        // return redirect()->back()->with('success', 'Interview Scheduled Successfully.....!');

    }

    // Check User Availability Date
    public function checkUserDate(Request $request)
    {
        $scheduleDate = Scheduler::where('user_id', $request->user_id)->where('job_id', $request->job_id)->first();
        return response()->json($scheduleDate->user_sche_date);
    }

    public function scheduleInterviewSelectedDate(Request $request)
    {
        $schedule = Scheduler::where('job_id', $request->job_id)->where('user_id', $request->user_id)->first();
        $user_email = User::find($request->user_id);

        $schedule->actual_sche_date = $request->date;
        $schedule->user_sche_date = NULL;
        $schedule->update();

        // Notification Start
        $applied_job = AppliedJob::where('job_id', $request->job_id)->where('user_id', $request->user_id)->first();
        $applied_job->interview_schedule = 1;
        $applied_job->update();

        $job = Job::find($applied_job->job_id);
        $user = User::find($applied_job->user_id);
        $datas = [
            [
                'title' => $job->job_title . " Interview Scheduled.",
                'user_id' => $applied_job->user_id,
                'job_id' => $applied_job->job_id,
                'type' => "User",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => $job->job_title . ' <b>' . $user->name . "</b> Interview Scheduled.",
                'user_id' => $job->user_id,
                'job_id' => $applied_job->job_id,
                'type' => "Client",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ];

        foreach ($datas as $data) {
            DB::table('notifications')->insert($data);
        }
        // Notification End

        $data = [
            'name' => $user_email->name,
            'email' => $user_email->email,
            'date' => Carbon::parse($request->date)->format('d/m/Y'),
            'time' => Carbon::parse($request->date)->format('g:i A'),
            'user_id' => $user_email->id,
            'schedule_id' => $schedule->id
        ];
        Mail::send('confim-mailed', $data, function ($message) use ($user_email) {
            $message->to($user_email->email)->subject('Interview Scheduled');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });


        return response()->json(['status' => 'success']);
    }
}
