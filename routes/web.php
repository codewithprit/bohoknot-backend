<?php
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Web\AuthWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get("/api/greet", [ApiController::class, "greet"]);
// Route::middleware('api')->prefix('api')->group(function(){

//     Route::post('/register', [RegisterController::class, "register"]);
//     Route::post('/login', [LoginController::class, "login"]);
// });


Route::get("/login", [AuthWebController::class, "showLoginForm"]);
Route::get("/register", [AuthWebController::class, "showRegisterForm"]);
Route::get("/otp", [AuthWebController::class, "showOtpform"]);




