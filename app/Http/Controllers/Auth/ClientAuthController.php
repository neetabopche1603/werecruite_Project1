<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    //=================== REGISTER FUNCTION===============
    public function registerView()
    {
        return view('login.clientLogin.register');
    }

    public function registerStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'emp_size' => 'required',
                'mobile_number' => 'required|unique:users,mobile_no',
                'email' => 'required|unique:users,email|max:255',
                'password' => [
                    'required',
                    'string',
                    'min:8',             // must be at least 8 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                'password_confirmation' => 'required_with:password|same:password|min:8',
                'address' => 'required',
                'image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',

            ],
            [
                'image.image' => 'Please Choose Only jpg,jpeg,png,gif file.',
                'password.min'=> 'Password must be at least 8 characters in length.',
                'password.regex'=> 'Password containt at least one lowercase, uppercase, digit, character and must be at least 8 characters in length.'
                
            ]
        );

        $registerStore = new User();
        $registerStore->name = strtoupper($request->name);
        $registerStore->emp_size = $request->emp_size;
        $registerStore->mobile_no = $request->mobile_number;
        $registerStore->email = $request->email;
        $registerStore->password = Hash::make($request->password);
        $registerStore->address = $request->address;

        if ($request->file('image')) {
            $image = $request->file('image');
            $destinationPath = 'image';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
            $registerStore->image =  $uploadImage;
        }

        $registerStore->role = 1;
        $register = $registerStore->save();

        if ($register) {
            if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
                if (auth()->user()->role === 1) {
                    return redirect()->route('clientPartner.home');
                } else {
                    return redirect()->route('client.login')
                        ->with('error', 'You don`t have access..');
                }
            }
        }
        return redirect()->back()->with('error', 'Register Faild.....');
    }



    //================= LOGIN FUNCTION=============

    public function loginView()
    {
        return view('login.clientLogin.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $data = [];

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            // if (auth()->user()->is_admin == 1) {
            //     return redirect()->route('admin.home');
            // }
            if (auth()->user()->role === 1) {
                return redirect()->route('clientPartner.home');
            } else {
                return redirect()->route('client.login')
                    ->with('error', 'You don`t have access..');
            }
        } else {
            return redirect()->route('client.login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }
}
