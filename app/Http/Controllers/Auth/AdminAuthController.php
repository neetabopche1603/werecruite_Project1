<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{


    // =====================SUPER ADMIN LOGIN FUNCTION========================
    public function adminLogin(){
        return view('login.adminLogin.login');
    }
    
    public function adminStore(Request $request){
        $input = $request->all();  
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = SuperAdmin::where('email',$request->email)->first();
        if ($check && Hash::check($request->password, $check->password)) {
            $request->session()->put('user_name', $check->email);
            // Session::put('user_name', $check->email);
            return redirect()->route('admin.home')->with('success','Admin have Successfully Login...');

        } else {
            return redirect()->route('admin.login')->with('error','Oppes! You have entered invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }


}
