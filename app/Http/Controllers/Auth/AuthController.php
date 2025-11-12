<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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


    public function reGenerateOtp(Request $request){
        $validator = Validator::make($request->all(), [
            "user_id" => "required|exists:users,id",
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message"=> "Invalid User id"
            ]);
        }

        $otp = rand(100000, 999999);
        $user = User::find($request->user_id);

        if(!empty($user)){
            $user->otp = $otp;
            $user->otp_time_out = now()->addMinutes(7);
            $user->save();

            return response()->json([
                "status" => false,
                "message"=> "Otp Regenerated Successfully, sent successfully",
                "data"   => [
                    "user_id" => $user->id,
                    "otp"     => $otp,
                ]
            ], 200);
        }
    }



    public function validateOtp(Request $request){
        $validator = Validator::make($request->all(), [
            "user_id" => "required|exists:users,id",
            "otp"     => "required|string|max:6",
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => $validator->errors(),
            ]);
        }

        $otp = $request->otp;
        $user = User::find($request->user_id);

        if($user->otp !== $request->otp){
            return response()->json([
                "status" => false,
                "message"=> "Invalid Otp"
            ]);
        }

        if(now()->gt($user->otp_time_out)){
            return response()->json([
                "status" => false,
                "message"=> "TimeOut, Please try to generate a new one"
            ]);
        }

        $user->otp = null;
        $user->otp_time_out = null;
        $user->email_verified_at = now();
        $user->save();

        // you can add the jwt token here if generating.

        return response()->json([
            "status" => true,
            "message"=> "Otp verified successfully. Login successfull",
            // "token",
            "user" => $user
        ]);
    }

}




