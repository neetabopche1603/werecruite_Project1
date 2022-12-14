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
        $validatedData = $request->validate([
            'job_role' => 'required',
        ]);

        $jobRole = JobRole::find($request->id);
        $jobRole->job_role = $request->job_role;
        $jobRole->update();
        return redirect()->route('admin.jobRole')->with('success', 'Job Role Updated Successfully.!');
    }
    // Job Role Delete Form Function
    public function jobRoleDelete($id)
    {
        JobRole::find($id)->delete();
        Job::where('job_role', $id)->delete();

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
        $super_admin = SuperAdmin::get();
        return view('admin.skill.add', compact('super_admin'));
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
        $super_admin = SuperAdmin::get();
        return view('admin.skill.edit', compact('skillEditForm', 'super_admin'));
    }

    public function skillUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'skill' => 'required',
        ]);

        $skillStore =  Skill::find($request->id);
        $skillStore->skill = $request->skill;
        $skillStore->save();
        return redirect()->route('admin.skill')->with('success', 'Skill Updated Successfully.!');
    }

    public function skillDelete($id)
    {
        Skill::find($id)->delete();
        $jobs = Job::get();
        $jobIds = [];
        foreach ($jobs as $job) {
            $skills = json_decode($job->skill);
            foreach ($skills as $skill) {
                if ($skill == $id) {
                    $jobid = $job->id;
                    array_push($jobIds, $jobid);
                }
            }
        }

        Job::whereIn('id', $jobIds)->delete();
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
            if (is_array(json_decode($val->skill))) {
                foreach (json_decode($val->skill) as $row) {
                    $data = Skill::where('id', $row)->select('skill')->first();
                    array_push($arr, $data);
                }
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
        $validatedData = $request->validate([
            'company_id' => 'required',
            'job_title' => 'required',
            'skill' => 'required',
            'job_role' => 'required',
            'description' => 'required',
        ]);

        $jobUpdate = Job::find($request->id);
        $jobUpdate->user_id = $request->company_id;
        $jobUpdate->job_title = $request->job_title;
        $jobUpdate->skill = $request->skill;
        $jobUpdate->job_role = $request->job_role;
        $jobUpdate->description = $request->description;

        $jobUpdate->update();

        return redirect()->route('admin.jobPosts')->with('success', 'Post Job Updated Successfully.....!');
    }

    public function jobPostDelete($id)
    {
        $jobPostDelete = Job::find($id)->delete();
        AppliedJob::where('job_id',$id)->delete();
        return redirect()->route('admin.jobPosts')->with('delete', 'Post Job Delete Successfully.....!');
    }
    // ======================Admin Post Job End=============================

    // =================================Applied Job User Function============================
    public function allJobs()
    {
        $allJobs = job::leftjoin('users', 'users.id', '=', 'jobs.user_id')->select('jobs.id as job_id', 'jobs.job_title', 'users.*')->get();

        $super_admin = SuperAdmin::get();
        return view('admin.jobPost.applied_jobs', compact('allJobs', 'super_admin'));
    }
    // ======================Admin Screening User Show Function=============================
    public function screeningJobUsers($jobid)
    {
        $appliedJobs = AppliedJob::join('users', 'users.id', '=', 'applied_jobs.user_id')->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')->where('applied_jobs.job_id', $jobid)->where('applied_jobs.status', 1)->select('applied_jobs.id as applied_job_id', 'applied_jobs.screening_schedule', 'applied_jobs.interview_schedule', 'applied_jobs.selected', 'applied_jobs.adminChangeStatus', 'users.id as user_id', 'users.name', 'users.email', 'users.mobile_no', 'jobs.job_title', 'jobs.id as jobId')->get();
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

    public function adminChangeStatus(Request $request)
    {
        if ($request->status != null || $request->status != '') {
            // echo "<pre>";
            // print_r($request->all());
            // die();
            $appliedJob = AppliedJob::find($request->applied_job_id);
            $appliedJob->adminChangeStatus = $request->status;
            $appliedJob->update();

            $job = Job::find($request->job_id);
            $user = User::find($request->user_id);
            $status = ucfirst($appliedJob->adminChangeStatus);
            $datas = [
                [
                    'title' => $job->job_title . ' ' . $status,
                    'user_id' => $appliedJob->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title' => $job->job_title . ' <b>' . $user->name . "</b> " . $status,
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
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'scheduleModel']);
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
        // echo "<pre>";
        // print_r($request->all());
        // die();
        //         Array
        // (
        //     [_token] => npMh4gahHqHgmpDPvuv1GQfhGXFzpPgUqNXQqG9U
        //     [user_id] => 3
        //     [job_id] => 5
        //     [applied_job_id] => 1
        //     [title] => dfs
        //     [date] => 22 October 2022 12:22 AM
        // )
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
            'title' => $request->title,
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
            $message->to($user->email, $request->title)->subject($user->name . ' Your Interview Schedule by Werecuite');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        $appliedJob = AppliedJob::find($request->applied_job_id);
        $appliedJob->adminChangeStatus = 'interview scheduled';
        $appliedJob->update();

        // return redirect()->route('admin.screeningJobUsers', $request->id)->with('success', 'Interview Scheduled Successfully.....!');
        return redirect()->back()->with('success', 'Interview Scheduled Successfully And Send Mail User.....!');
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
        $applied_job->screening_schedule = 1;
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
            'title' => $schedule->title,
            'schedule_id' => $schedule->id
        ];
        Mail::send('confim-interview-mail', $data, function ($message) use ($user_email) {
            $message->to($user_email->email)->subject($user_email->name . ' Your Interview Confirmed by Werecuite');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });

        return redirect()->route('login')->with('success', 'Interview Scheduled Successfully...! Please Login Your Account.');
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
        $applied_job->screening_schedule = 1;
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
            'title' => $schedule->title,
            'schedule_id' => $schedule->id
        ];
        Mail::send('confim-interview-mail', $data, function ($message) use ($user_email) {
            $message->to($user_email->email)->subject($user_email->name . ' Your Interview Confirmed by Werecuite');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        return response()->json(['status' => 'success']);
    }

    //==================Applied Job User Function===========
    public function appliedJobs()
    {
        $appliedJobs = Job::where('user_id', 0)->get();
        // Admin All Job Screening Query
        // $appliedJobs = Job::get();

        $super_admin = SuperAdmin::get();

        return view('admin.jobAppliedUser.applied_jobs', compact('appliedJobs', 'super_admin'));
    }

    public function appliedJobUsers($jobid)
    {
        $appliedJobs = AppliedJob::join('users', 'users.id', '=', 'applied_jobs.user_id')->join('jobs', 'jobs.id', '=', 'applied_jobs.job_id')->where('applied_jobs.job_id', $jobid)->select('applied_jobs.id as applied_job_id', 'applied_jobs.status', 'users.id as user_id', 'users.name', 'users.email', 'users.mobile_no', 'jobs.job_title')->get();
        $super_admin = SuperAdmin::get();
        return view('admin.jobAppliedUser.applied_jobs_user', compact('appliedJobs', 'super_admin'));
    }

    public function jobStatus(Request $request)
    {
        //  echo "<pre>";
        //     print_r($request->checked);
        //     exit();

        $appliedJob = AppliedJob::find($request->applied_job_id);
        if ($request->checked == 1) {
            $appliedJob->status = 1;
            $appliedJob->adminChangeStatus = "screening by admin";
            $appliedJob->update();

            $job = Job::find($appliedJob->job_id);
            $user = User::find($appliedJob->user_id);
            $datas = [
                [
                    'title' => $job->job_title . " Status Updated Screening.",
                    'user_id' => $appliedJob->user_id,
                    'job_id' => $appliedJob->job_id,
                    'type' => "User",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'title' => $job->job_title . ' <b>' . $user->name . "</b> Screening Updated Admin.",
                    'user_id' => 0,
                    'job_id' => $appliedJob->job_id,
                    'type' => "Admin",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ];

            foreach ($datas as $data) {
                DB::table('notifications')->insert($data);
            }

            return response()->json('Screening');
        } else {
            $appliedJob->status = 0;
            $appliedJob->update();
            return response()->json('applied');
        }
    }

    public function userListShow()
    {
        $userList = User::where('role', 0)->get();
        $super_admin = SuperAdmin::get();
        return view('admin.userlist', compact('userList', 'super_admin'));
    }

    public function userListDelete($id)
    {
        $userDeleted = User::find($id)->delete();
        return redirect()->route('admin.userListShow')->with('delete', 'User Deleted Successfully.!');
    }

    public function appliedJobDelete($appliedJobId)
    {
        AppliedJob::find($appliedJobId)->delete();
        return redirect()->back()->with('delete', 'Applied Job Deleted Successfully.!');
    }

    public function screeningUserDelete($appliedJobId)
    {
        AppliedJob::find($appliedJobId)->delete();
        return redirect()->back()->with('delete', 'Screening Job Deleted Successfully.!');
    }

    public function companyListShow()
    {
        $companyList = User::where('role', 1)->get();
        $super_admin = SuperAdmin::get();
        return view('admin.companylist', compact('companyList', 'super_admin'));
    }

    public function companyListDelete($id)
    {
        $userDeleted = User::find($id)->delete();
        Job::where('user_id', $id)->delete();
        return redirect()->route('admin.companylist')->with('delete', 'Company Deleted Successfully.!');
    }
}
