<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthWebController extends Controller
{

    public function showRegisterForm(){
        return view('auth.register');
    }


    public function handleRegisterForm(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string|max:30',
            'last_name'  => 'required|string|max:30',
            'email' => 'nullable|email|max:60|unique:users,email',
            'phone' => 'nullable|string|max:20|unique:users,phone',
            'dob'        => 'nullable|date',
            'gender'     => 'nullable|in:Male, Female, Others',
            'newsletter' => 'nullable|in:Yes, No'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        if(empty($request->email) && empty($request->phone)){
            return back()->withErrors([
                'email' => 'Please provide at least an email or phone number',
                'phone' => 'Please provide at least an email or phone number'
            ]);
        }

        if(!empty($request->email)){
            $existingUser = User::where('email', $request->email)->first();
            if($existingUser){
                return back()->withErrors('Email is already registered')->withInput();
            }
        }

        if(!empty($request->phone)){
            $existingUser = User::where('phone', $request->phone)->first();
            if($existingUser){
                return back()->withErrors('Phone number is already registered')->withInput();
            }
        }

        $otp = rand(100000, 999999);

        $otp_target = !empty($request->phone) ? $request->phone : $request->email;

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'dob'        => $request->dob,
            'gender'     => $request->gender,
            'newsletter' => $request->newsletter,
            'otp'        => $otp,
            'otp_time_out'=> now()->addMinutes(7),
            // 'password'   => 
        ]);

        session()->put('user_id', $user->id);
        

        return redirect()->route('show.otp.form')->with('success', 'Registration successful. OTP sent to ' . $otp_target);
    }

    public function showLoginForm(){
        return view('auth.login');
    }


    public function showOtpform(){
        return view('auth.otp');
    }
}
