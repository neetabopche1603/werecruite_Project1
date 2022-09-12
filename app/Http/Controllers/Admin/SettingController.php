<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settingView()
    {
        $data['settings'] = Setting::get();
        //   echo "<pre>";
        // print_r($settings);
        // echo "</pre>";
        return view('admin.setting.setting', $data);
    }

    public function logoUpdate(Request $request)
    {
        $logoUpdate = Setting::find($request->id);

        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $destinationPath = 'settings';
            $uploadlogo = date('YmdHis') . "." . $logo->getClientOriginalExtension();
            $logo->move($destinationPath, $uploadlogo);
            $logoUpdate->logo =  $uploadlogo;
        }

        $logoUpdate->update();

        return redirect()->back()->with('success', 'Logo Update Successfully Changed......!');
    }

    public function faviconUpdate(Request $request)
    {
        $faviconUpdate = Setting::find($request->id);

        if ($request->file('favicon')) {
            $favicon = $request->file('favicon');
            $destinationPath = 'settings';
            $uploadfavicon = date('YmdHis') . "." . $favicon->getClientOriginalExtension();
            $favicon->move($destinationPath, $uploadfavicon);
            $faviconUpdate->favicon =  $uploadfavicon;
        }
        $faviconUpdate->update();
        return redirect()->back()->with('success', 'Favicon Update Successfully Changed......!');
    }
}
