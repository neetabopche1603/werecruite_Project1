<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function talentHome(){
        $setting = Setting::get();
        return view('talentPartner.home',compact('setting'));
    }
}
