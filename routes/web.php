<?php
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\DebugController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::middleware('api')->prefix('api')->group(function(){

//     Route::post('/register', [RegisterController::class, "register"]);
//     Route::post('/login', [LoginController::class, "login"]);
// });


Route::get("/login", [AuthWebController::class, "showLoginForm"]);
// Route::post("login", [AuthWebController::class, "handleRegisterForm"]);

Route::get("/register", [AuthWebController::class, "showRegisterForm"]);
Route::post("/register", [AuthWebController::class, "handleRegisterForm"])->name("register");

Route::get("/otp", [AuthWebController::class, "showOtpform"])->name("show.otp.form");


Route::get("session_data", [DebugController::class, "showSession"]);




