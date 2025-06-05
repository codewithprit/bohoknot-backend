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

        if(!empty($request->email) && !empty($request->phone)){
            return response()->json([
                "status"  => false,
                "message" => "Please provide either email or phone"
            ]);
        }

        $user = null;
        if(!empty($request->email)){
            $user = User::where('email', $request->email)->first();
            if(empty($user)){
                return response()->json([
                    'status'   => false,
                    'message'  => "User not found with the Email. Try to Register First"
                ], 404);
            }
        }elseif(!empty($user->phone)){
            $user = User::where('phone', $request->phone)->first();
            if(empty($user)){
                return response()->json([
                    'status'   => false,
                    'message'  => 'User not found with the phone. Try to Register First'
                ], 404);
            }
        }
        // return $user;exit;

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
