<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
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
});


// ===========Talent-Partner Route===========
Route::group(['prefix' => 'talent', 'middleware' => 'talentPartner'], function () {
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
