<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'  =>  'sometimes|nullable|email|required_without:phone',
            'phone'  =>  'sometimes|nullable|string|required_without:email',

            [
                'email.required_without'  =>  'Please Provide Email or Phone',
                'phone.required_without'  =>  'Please Provide Email or Phone'
            ]

        ]);

        if($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)
                    ->orWhere('phone', $request->phone)
                    ->first();

        if(!$user){
            return response()->json([
                'status'  =>  false,
                'message' => 'user not not found with given email or phone, try to register first'
            ], 404);
        }
        return $user;exit;

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();
        
        return response()->json([
            'success'  => true,
            'message'  => 'OTP send successfully',
            'otp'      => $otp,
            'id'  => $user->id
        ]);
    }
}
