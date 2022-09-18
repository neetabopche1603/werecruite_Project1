<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AppliedJobController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Notification;
use App\Http\Controllers\Talent\HomeController as TalentHomeController;
use App\Http\Controllers\Talent\TalentProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login.login');
});
Route::get('email', function () {
    return view('email.forgetPassword');
});

Route::get('eye', function () {
    return view('eye');
})->name('eye');

// ==============SUPER ADMIN SINGN IN ! ROUTE==========
Route::get('superadmin', [AdminAuthController::class, 'adminLogin'])->name('admin.login');
Route::post('superadmin', [AdminAuthController::class, 'adminStore'])->name('admin.adminStore');
// =================Logout SUPER Admin Route============
Route::get('admin_logout', function () {
    session()->forget('user_name');
    return redirect()->route('admin.login');
})->name('superadmin.logout');

// ==============(CLIENT) SINGN UP ! ROUTE==========
Route::get('client/sign-up', [ClientAuthController::class, 'registerView'])->name('client.register');
Route::post('client/sign-up', [ClientAuthController::class, 'registerStore'])->name('client.registerStore');

// =============(CLIENT) SIGN IN ! ROUTE===========
Route::get('client/', [ClientAuthController::class, 'loginView'])->name('client.login');
Route::post('client/', [ClientAuthController::class, 'login'])->name('client.loginpost');
// ========= CLIENT Logout Route===========
Route::get('client_logout', function () {
    Auth::logout();
    return redirect()->route('client.login');
})->name('client.logout');


// ==============USER(TELENT) SINGN UP ! ROUTE==========
Route::get('sign-up', [AuthController::class, 'registerView'])->name('register');
Route::post('sign-up', [AuthController::class, 'registerStore'])->name('registerStore');

// =============USER(TELENT) SIGN IN ! ROUTE===========
Route::get('sign-in', [AuthController::class, 'loginView'])->name('login');
Route::post('sign-in', [AuthController::class, 'login'])->name('login.post');

// ========= USER Logout Route===========
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('user.logout');

// =========FORGET PASSWORS Route (client & user)===========
Route::get('forget-password', [ForgetPasswordController::class, 'forget_password'])->name('forget_password');
Route::post('forget-password', [ForgetPasswordController::class, 'forgetpass_post'])->name('forget.password.post');

// =========RESET PASSWORS Route(client & user)===========
Route::get('reset-link/{token}', [ForgetPasswordController::class, 'reset_link'])->name('reset_link');
Route::post('reset-link', [ForgetPasswordController::class, 'reset_link_post'])->name('reset.link.post');


// ===========Admin Route===========
Route::group(['prefix' => 'admin',], function () {
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');
    // Route::get('admin/home', function () {
    //     return view('admin.home');
    // })->name('admin.home');


    //===================Profile Update Route===================
    Route::get('profile', [ProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile', [ProfileController::class, 'updateProfiles'])->name('admin.updateProfiles');
    //===================Change password===================
    
    Route::post('change-password', [ProfileController::class, 'adminChangePassword'])->name('admin.adminChangePassword');

    // ===================Setting Route===================
    Route::get('setting', [ProfileController::class, 'settingView'])->name('admin.settingView');
    //===================Logo Route===================
    Route::post('logo', [ProfileController::class, 'logoUpdate'])->name('admin.logoUpdate');
    // ===================Favicon Route===================
    Route::post('favicon', [ProfileController::class, 'faviconUpdate'])->name('admin.faviconUpdate');
    // ===================Job Post Route===================
    Route::get('show-jobs', [HomeController::class, 'jobPosts'])->name('admin.jobPosts');
    Route::get('add-jobsPost', [HomeController::class, 'addJobPostView'])->name('admin.addJobPostView');
    Route::post('add-jobsPost', [HomeController::class, 'jobPostStore'])->name('admin.jobPostStore');
    Route::get('edit-jobsPost/{id}', [HomeController::class, 'editJobPostView'])->name('admin.editJobPostView');
    Route::post('edit-jobsPost', [HomeController::class, 'jobPostUpdate'])->name('admin.jobPostUpdate');
    Route::get('delete-jobsPost/{id}', [HomeController::class, 'jobPostDelete'])->name('admin.jobPostDelete');

    //=================== JobRole Route ===================
    Route::get('show-job-role', [HomeController::class, 'jobRole'])->name('admin.jobRole');
    Route::get('add-job-role', [HomeController::class, 'jobRoleAddForm'])->name('admin.jobRoleAddForm');
    Route::post('add-job-role', [HomeController::class, 'jobRoleAddStore'])->name('admin.jobRoleAddStore');
    Route::get('edit-job-role/{id}', [HomeController::class, 'jobRoleEdit'])->name('admin.jobRoleEdit');
    Route::post('edit-job-role', [HomeController::class, 'jobRoleUpdate'])->name('admin.jobRoleUpdate');
    Route::get('delete-job-role/{id}', [HomeController::class, 'jobRoleDelete'])->name('admin.jobRoleDelete');

    //=================== SKILL ROUTE ===================
    Route::get('show-skill', [HomeController::class, 'skill'])->name('admin.skill');
    Route::get('add-skill', [HomeController::class, 'skillAddForm'])->name('admin.skillAddForm');
    Route::post('add-skill', [HomeController::class, 'skillStore'])->name('admin.skillStore');
    Route::get('edit-skill/{id}', [HomeController::class, 'skillEditForm'])->name('admin.skillEditForm');
    Route::post('edit-skill', [HomeController::class, 'skillUpdate'])->name('admin.skillUpdate');
    Route::get('delete-skill/{id}', [HomeController::class, 'skillDelete'])->name('admin.skillDelete');
    // ===========Admin status Change screening Route ===========
    Route::get('show-screening-jobs', [HomeController::class, 'allJobs'])->name('admin.getAllJob');
    Route::get('get-all-users/{jobid}', [HomeController::class, 'screeningJobUsers'])->name('admin.screeningJobUsers');
    Route::post('change-screening-status', [HomeController::class, 'jobStatusScreening'])->name('admin.screening');
    Route::post('change-interview-status', [HomeController::class, 'jobStatusInterview'])->name('admin.interview');
    Route::post('change-selected-status', [HomeController::class, 'jobStatusSelected'])->name('admin.selected');
});


// ===========Client-Partner Route===========
Route::group(['prefix' => 'client', 'middleware' => 'clientPartner'], function () {
    Route::get('home', function () {
        return view('clientPartner.home');
    })->name('clientPartner.home');

    Route::get('home', [ClientHomeController::class, 'clientHome'])->name('clientPartner.home');

    // ===================Client Profile Route===================
    Route::get('profile', [ClientProfileController::class, 'profileViewPage'])->name('client.profileView');
    Route::post('profile', [ClientProfileController::class, 'updateProfile'])->name('client.updateProfile');
    //===================Change password===================
    Route::post('change-password', [ClientProfileController::class, 'changePassword'])->name('client.changePassword');

    //===================Job Routes===================
    Route::get('show-job', [ClientHomeController::class, 'index'])->name('client.showJob');
    Route::get('add-job', [ClientHomeController::class, 'jobAddView'])->name('client.jobAddView');
    Route::post('add-job', [ClientHomeController::class, 'jobAddStore'])->name('client.jobAddStore');
    Route::get('edit-job/{id}', [ClientHomeController::class, 'jobEditView'])->name('client.jobEditView');
    Route::post('edit-job', [ClientHomeController::class, 'jobUpdate'])->name('client.jobUpdate');
    Route::get('delete-job/{id}', [ClientHomeController::class, 'jobDelete'])->name('client.jobDelete');

    // ===================Applied Job Routes===================
    Route::get('show-applied-jobs', [ClientHomeController::class, 'allJobs'])->name('client.getAllJob');
    Route::get('get-all-users/{jobid}', [ClientHomeController::class, 'appliedJobUsers'])->name('client.appliedJobUsers');
    Route::post('change-applied-job-status', [ClientHomeController::class, 'jobStatus'])->name('client.jobStatus');

    // ===================Notification===================
    Route::get('notification-seen/{id}',[ClientHomeController::class,'seen'])->name('client.notificationSeen');

});


// ===========Talent-Partner(USER) Route===========
Route::group(['prefix' => 'user', 'middleware' => 'talentPartner'], function () {
    Route::get('home', function () {
        return view('talentPartner.home');
    })->name('talentPartner.home');
    Route::get('home', [TalentHomeController::class, 'talentHome'])->name('talentPartner.home');
    //=================== Talent Profile Route  ===================
    Route::get('profile', [TalentProfileController::class, 'profileView'])->name('talent.profileView');
    Route::post('profile', [TalentProfileController::class, 'ProfileUpdate'])->name('talent.ProfileUpdate');
    //===================Change password===================
    Route::post('change-password', [TalentProfileController::class, 'passwordChange'])->name('client.passwordChange');
    //===================User ViewJobs Route===================
    Route::get('jobsView', [TalentHomeController::class, 'jobsView'])->name('talent.jobsView');
    Route::get('job_desc/{id}', [TalentHomeController::class, 'job_desc'])->name('talent.job_desc');
    // ===================Applied Job Route===================
    Route::get('applied_Job/{job_id}', [AppliedJobController::class, 'appliedJob'])->name('talent.appliedJob');
    // ==================Notification==================== 
    Route::post('notification-seen',[TalentHomeController::class,'seen'])->name('talent.notificationSeen');
});
