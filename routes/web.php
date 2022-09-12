<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\JobRoleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\AppliedJobController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\JobController;
use App\Http\Controllers\Talent\HomeController as TalentHomeController;
use App\Http\Controllers\Talent\JobsController;
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
});

// ==============SINGN UP ! ROUTE==========
Route::get('sign-up', [AuthController::class, 'registerView'])->name('register');
Route::post('sign-up', [AuthController::class, 'registerStore'])->name('registerStore');

// =============SIGN IN ! ROUTE===========
Route::get('sign-in', [AuthController::class, 'loginView'])->name('login');
Route::post('sign-in', [AuthController::class, 'login'])->name('login.post');

// =========Logout Route===========
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// =========FORGET PASSWORS Route===========
Route::get('forget-password', [ForgetPasswordController::class, 'forget_password'])->name('forget_password');
Route::post('forget-password', [ForgetPasswordController::class, 'forgetpass_post'])->name('forget.password.post');

// =========RESET PASSWORS Route===========
Route::get('reset-link/{token}', [ForgetPasswordController::class, 'reset_link'])->name('reset_link');
Route::post('reset-link', [ForgetPasswordController::class, 'reset_link_post'])->name('reset.link.post');


// ===========Admin Route===========
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');

    //Profile Update Route
    Route::get('profile', [ProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile', [ProfileController::class, 'updateProfiles'])->name('admin.updateProfiles');
    //Change password
    Route::post('change-password', [ProfileController::class, 'adminChangePassword'])->name('admin.adminChangePassword');

    // Setting Route
    Route::get('setting', [SettingController::class, 'settingView'])->name('admin.settingView');
    //Logo Route
    Route::post('logo', [SettingController::class, 'logoUpdate'])->name('admin.logoUpdate');
    // Favicon Route
    Route::post('favicon', [SettingController::class, 'faviconUpdate'])->name('admin.faviconUpdate');
    // Job Post Route
    Route::get('show_jobs',[JobPostController::class,'jobPosts'])->name('admin.jobPosts');
    Route::get('add_jobsPost',[JobPostController::class,'addJobPostView'])->name('admin.addJobPostView');
    Route::post('add_jobsPost',[JobPostController::class,'jobPostStore'])->name('admin.jobPostStore');
    Route::get('edit_jobsPost/{id}',[JobPostController::class,'editJobPostView'])->name('admin.editJobPostView');
    Route::post('edit_jobsPost',[JobPostController::class,'jobPostUpdate'])->name('admin.jobPostUpdate');
    Route::get('delete_jobsPost/{id}',[JobPostController::class,'jobPostDelete'])->name('admin.jobPostDelete');

    // Company Route
    Route::get('show_company',[CompanyController::class,'company'])->name('admin.company');
    Route::get('add_company',[CompanyController::class,'CompanyAddView'])->name('admin.CompanyAddView');
    Route::post('add_company',[CompanyController::class,'companyStore'])->name('admin.companyStore');
    Route::get('edit_company/{id}',[CompanyController::class,'CompanyEdit'])->name('admin.CompanyEdit');
    Route::post('edit_company',[CompanyController::class,'companyUpdate'])->name('admin.companyUpdate');
    Route::get('delete_company/{id}',[CompanyController::class,'companyDelete'])->name('admin.companyDelete');

    // JobRole Route
    Route::get('show_jobRole',[JobRoleController::class,'jobRole'])->name('admin.jobRole');
    Route::get('add_jobRole',[JobRoleController::class,'jobRoleAddForm'])->name('admin.jobRoleAddForm');
    Route::post('add_jobRole',[JobRoleController::class,'jobRoleAddStore'])->name('admin.jobRoleAddStore');
    Route::get('edit_jobRole/{id}',[JobRoleController::class,'jobRoleEdit'])->name('admin.jobRoleEdit');
    Route::post('edit_jobRole',[JobRoleController::class,'jobRoleUpdate'])->name('admin.jobRoleUpdate');
    Route::get('delete_jobRole/{id}',[JobRoleController::class,'jobRoleDelete'])->name('admin.jobRoleDelete');

    // SKILL ROUTE
    Route::get('show_skill',[SkillController::class,'skill'])->name('admin.skill');
    Route::get('add_skill',[SkillController::class,'skillAddForm'])->name('admin.skillAddForm');
    Route::post('add_skill',[SkillController::class,'skillStore'])->name('admin.skillStore');
    Route::get('edit_skill/{id}',[SkillController::class,'skillEditForm'])->name('admin.skillEditForm');
    Route::post('edit_skill',[SkillController::class,'skillUpdate'])->name('admin.skillUpdate');
    Route::get('delete_skill/{id}',[SkillController::class,'skillDelete'])->name('admin.skillDelete');


});


// ===========Talent-Partner Route===========
Route::group(['prefix' => 'user', 'middleware' => 'talentPartner'], function () {
    Route::get('home', function () {
        return view('talentPartner.home');
    })->name('talentPartner.home');

    Route::get('home', [TalentHomeController::class, 'talentHome'])->name('talentPartner.home');
    // Talent Profile Route
    Route::get('profile', [TalentProfileController::class, 'profileView'])->name('talent.profileView');
    Route::post('profile', [TalentProfileController::class, 'ProfileUpdate'])->name('talent.ProfileUpdate');
    //Change password
    Route::post('change-password', [TalentProfileController::class, 'passwordChange'])->name('client.passwordChange');
    //Jobs Route
    Route::get('jobsView', [JobsController::class, 'jobsView'])->name('talent.jobsView');
    Route::get('job_desc/{id}', [JobsController::class, 'job_desc'])->name('talent.job_desc');
    // Applied Job Route
    Route::get('applied_Job/{job_id}', [AppliedJobController::class, 'appliedJob'])->name('talent.appliedJob');
    

    
});


// ===========Client-Partner Route===========
Route::group(['prefix' => 'client', 'middleware' => 'clientPartner'], function () {
    Route::get('home', function () {
        return view('clientPartner.home');
    })->name('clientPartner.home');

    Route::get('home', [ClientHomeController::class, 'clientHome'])->name('clientPartner.home');


    // Client Profile Route
    Route::get('profile', [ClientProfileController::class, 'profileViewPage'])->name('client.profileView');
    Route::post('profile', [ClientProfileController::class, 'updateProfile'])->name('client.updateProfile');
    //Change password
    Route::post('change-password', [ClientProfileController::class, 'changePassword'])->name('client.changePassword');

    //Job Routes
    Route::get('show_job', [JobController::class, 'index'])->name('client.showJob');
    Route::get('add_job', [JobController::class, 'jobAddView'])->name('client.jobAddView');
    Route::post('add_job', [JobController::class, 'jobAddStore'])->name('client.jobAddStore');
    Route::get('edit_job/{id}', [JobController::class, 'jobEditView'])->name('client.jobEditView');
    Route::post('edit_job', [JobController::class, 'jobUpdate'])->name('client.jobUpdate');
    Route::get('delete_job/{id}', [JobController::class, 'jobDelete'])->name('client.jobDelete');
});
