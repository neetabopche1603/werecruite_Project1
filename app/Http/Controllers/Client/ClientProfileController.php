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
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ],
        [
            'image' => 'Please Choose Only jpg,jpeg,png,gif file.',
        ]
    
    );

        // echo "<pre>";
        // print_r($request->all());
        // die();
        $profileUpdate = User::find($request->id);
        $profileUpdate->name = $request->name;
        $profileUpdate->dob = $request->dob;
        $profileUpdate->emp_size = $request->emp_size;
        $profileUpdate->mobile_no = $request->mobile_number;
        // $profileUpdate->dob = $request->dob;
        $profileUpdate->address = $request->address;

        // $profileUpdate->street = $request->street;
        // $profileUpdate->city = $request->city;
        // $profileUpdate->state = $request->state;
        // $profileUpdate->country = $request->country;
        // $profileUpdate->zip_code = $request->zip_code;


        if ($request->file('image') != NULL) {

            // Old Image Delete Code Start
            if ($profileUpdate->image != NULL) {

                if(file_exists('image/'. $profileUpdate->image)){
                    if(file_exists('image/'. $profileUpdate->image)){
                        unlink('image/'. $profileUpdate->image);
                    }
                   
                }
                
            }
            // Old Image Delete Code End
            $image = $request->file('image');
            $destinationPath = 'image';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $uploadImage);
            $image->move(public_path($destinationPath), $uploadImage);
            $profileUpdate->image =  $uploadImage;
        }
        $profileUpdate->update();

        return redirect()->back()->with('success', 'Profile Updated Successfully......!');

    }

    // ============= Client Change Passwords Function ==================
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new ClientOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ],
        [
            'new_confirm_password' => 'Password does not match',
        ]
    
    );

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        // dd('Password change successfully.');
        return redirect()->back()->with('password', 'Password Updated Successfully......!');
    }
}
