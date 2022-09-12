<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminHome(){
        $setting = Setting::get();
        return view('admin.home',compact('setting'));
    }
}
