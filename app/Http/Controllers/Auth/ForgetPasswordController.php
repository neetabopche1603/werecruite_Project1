<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{

    public function forget_password()
    {
        return view('login.forgetPassword');
    }

    public function forgetpass_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user = User::where('email',$request->email)->first();
        
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $user->remember_token = $token;
            $user->update();
          
    
            Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
    
            return back()->with('success', 'We have e-mailed your password reset link!');
       
    }
    // Reset link Function

    public function reset_link($token)
    {
        return view('login.resetPassword', ['token' => $token]);
    }


    public function reset_link_post(Request $request)
    {
        $request->validate([
            // 'email' => 'required|email|exists:users',
              'password' => 'required|string|min:8|confirmed',
              'password_confirmation' => 'required'
        ]);

        // $updatePassword = DB::table('password_resets')
        //     ->where([
        //         'email' => $request->email,
        //         'token' => $request->token
        //     ])
        //     ->first();
        $user = User::where('remember_token',$request->token)->first();
        if (!$user) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        // $user = User::where('email', $request->email)
        //     ->update(['password' => Hash::make($request->password)]);
        $user->password =  Hash::make($request->password);
        $user->remember_token = NULL;
        $user->update();

        DB::table('password_resets')->where(['token' => $request->token])->delete();
        // DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('success', 'Your password has been changed!');
    }

}
