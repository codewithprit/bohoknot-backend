<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'     =>   'required|string|max:100',
            'email'    =>   'required|email|unique:users,email',
            'phone'    =>   'required|string|max:20|unique:users,phone',
            'password' =>   'required|string|min:6'

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message'=> $validator->errors()
            ], 422);
        }

        $otp = rand(100000, 999999);

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'otp'          => $otp,
            'otp_time_out' => now()->addMinutes(7),
            'password'     =>  Hash::make($request->password)
        ]);

        return response()->json([
            'status'   =>  true,
            'message'  =>  'User registered successfully. Otp sent to phone',
            'id'       =>  $user->id
        ]);
    }
}
