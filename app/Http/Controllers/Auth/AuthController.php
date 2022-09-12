<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //=================== REGISTER FUNCTION===============
    public function registerView(){
        return view('login.register');
    }

    public function registerStore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'highest_education' => 'required',
            'mobile_number' => 'required|unique:users,mobile_no|max:10',
            'email' => 'required|unique:users,email|max:255',
            'password' => 'min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
            'address' => 'required',
            'image.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);

        $registerStore = new User();
        $registerStore->name = strtoupper($request->name);
        $registerStore->dob = $request->dob;
        $registerStore->gender = $request->gender;
        $registerStore->highest_education = $request->highest_education;
        $registerStore->mobile_no = $request->mobile_number;
        $registerStore->email = $request->email;
        $registerStore->password = Hash::make($request->password);
        $registerStore->address = $request->address;

        if($request->file('image')){
            $image = $request->file('image');
            $destinationPath = 'image';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
            $registerStore->image =  $uploadImage;
        }

        $registerStore->is_admin = 2;
        $registerStore->save();
        return redirect()->route('login')->with('success', 'Register Successfully.....');
    }

    //================= LOGIN FUNCTION=============

    public function loginView(){
        return view('login.login');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $data = [];
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            }
            elseif(auth()->user()->is_admin == 2)
            {
                return redirect()->route('talentPartner.home');
            }
            elseif(auth()->user()->is_admin == 3 )
            {
                return redirect()->route('clientPartner.home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
}
