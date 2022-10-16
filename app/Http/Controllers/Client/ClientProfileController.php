<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ClientOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientProfileController extends Controller
{
    // ============= Client Profile Function ==================

    public function profileViewPage()
    {
        $profiles = Auth::user();
        return view('clientPartner.clientProfile.profile', compact('profiles'));
    }

    public function updateProfile(Request $request)
    {
        $profileUpdate = User::find($request->id);
        $profileUpdate->name = $request->name;
        $profileUpdate->dob = $request->dob;
        $profileUpdate->emp_size = $request->emp_size;
        $profileUpdate->mobile_no = $request->mobile_number;
        // $profileUpdate->dob = $request->dob;
        $profileUpdate->address = $request->address;


        if ($request->file('image') != NULL) {

            // Old Image Delete Code Start
            if ($profileUpdate->image != NULL) {
                unlink('image/' . $profileUpdate->image);
            }
            // Old Image Delete Code End
            $image = $request->file('image');
            $destinationPath = 'image';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
            $profileUpdate->image =  $uploadImage;
        }
        $profileUpdate->update();

        return redirect()->back()->with('success', 'Profile Update Successfully Changed......!');

    }

    // ============= Client Change Passwords Function ==================
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new ClientOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        // dd('Password change successfully.');
        return redirect()->back()->with('password', 'Password Successfully Changed......!');
    }
}
