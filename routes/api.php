<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::group(['prefix' => 'auth'], function($router){
    // Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/validate_otp', [AuthController::class, 'validateOtp']);
    // Route::post('/regenerate_otp', [AuthController::class, 'reGenerateOtp']);
});


Route::middleware(['auth:api'])->group(function(){
    // Route::post('me', [AuthController::class, 'me']);
});
