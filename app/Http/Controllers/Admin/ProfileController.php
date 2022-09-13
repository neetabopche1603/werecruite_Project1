<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SuperAdmin;
use App\Rules\AdminOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function adminProfile(){
        $adminProfile = SuperAdmin::where('email','=',session()->get('user_name'))->first();
        return view('admin.adminProfile.profile',compact('adminProfile'));
    }

    public function updateProfiles(Request $request)
    {
        $updateProfiles = SuperAdmin::find($request->id);
        $updateProfiles->name = $request->name;
        $updateProfiles->email = $request->email;
        $updateProfiles->dob = $request->dob;
        // $updateProfiles->highest_education = $request->highest_education;
        $updateProfiles->mobile_no = $request->mobile_number;
        $updateProfiles->dob = $request->dob;
        $updateProfiles->address = $request->address;

        // if($request->file('profile_img')){
        //     $image = $request->file('profile_img');
        //     $destinationPath = 'images';
        //     $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $uploadImage);
        //     $profileUpdate->image =  $uploadImage;
        // }


        if ($request->file('image')) {
            // Old Image Delete Code Start
            // if ($updateProfiles->image != NULL) {
            //     unlink('image/' . $updateProfiles->image);
            // }
            // Old Image Delete Code End
            $image = $request->file('image');
            $destinationPath = 'image';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
            $updateProfiles->image =  $uploadImage;
        }
        $updateProfiles->update();

        return redirect()->back()->with('success', 'Profile Update Successfully Changed......!');

    }

    // =============  Admin Change Passwords Function ==================
    public function adminChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new AdminOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        // dd('Password change successfully.');
        return redirect()->back()->with('password', 'Password Successfully Changed......!');
    }
}
