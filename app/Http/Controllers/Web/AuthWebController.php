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
            'first_name' => 'requered|string|max:30',
            'last_name'  => 'required|string|max:30',
            'email_or_phone' => 'required|string|max:60',
            'dob'        => 'nullable|date',
            'gender'     => 'nullable|in:Male, Female, Others',
            'newsletter' => 'nukllable|in:Yes, No'
        ]);
    }

    public function showLoginForm(){
        return view('auth.login');
    }


    public function showOtpform(){
        return view('auth.otp');
    }
}
