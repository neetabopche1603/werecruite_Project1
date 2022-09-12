<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\TalentOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TalentProfileController extends Controller
{
    public function profileView()
    {
        $profileData = Auth::user();
        return view('talentPartner.profileUpdate.talentProfile', compact('profileData'));
    }

    public function ProfileUpdate(Request $request)
    {
        $ProfileUpdate = User::find($request->id);
        $ProfileUpdate->name = strtoupper($request->name);
        $ProfileUpdate->dob = $request->dob;
        $ProfileUpdate->highest_education = $request->highest_education;
        $ProfileUpdate->mobile_no = $request->mobile_number;
        $ProfileUpdate->dob = $request->dob;
        $ProfileUpdate->address = $request->address;

        if ($request->file('image') != NULL) {

            // Old Image Delete Code Start
            if ($ProfileUpdate->image != NULL) {
                unlink('image/' . $ProfileUpdate->image);
            }
            // Old Image Delete Code End
            $image = $request->file('image');
            $destinationPath = 'image';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
            $ProfileUpdate->image =  $uploadImage;
        }
        $ProfileUpdate->update();

        return redirect()->back()->with('success', 'Profile Update Successfully Changed......!');
    }

   // ============= Client Change Passwords Function ==================
   public function passwordChange(Request $request)
   {
       $request->validate([
           'current_password' => ['required', new TalentOldPassword],
           'new_password' => ['required'],
           'new_confirm_password' => ['same:new_password'],
       ]);

       User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

       // dd('Password change successfully.');
       return redirect()->back()->with('password', 'Password Successfully Changed......!');
   }

}
