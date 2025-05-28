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
            'login'  => 'required|string'

        ]);

        if($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->login)
                    ->orWhere('phone', $request->login)
                    ->first();

        if(!$user){
            return response()->json([
                'status'  =>  false,
                'message' => 'user not not found with given email or phone'
            ], 404);
        }

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
