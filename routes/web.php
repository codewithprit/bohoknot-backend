<?php
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/api/greet", [ApiController::class, "greet"]);
// Route::middleware('api')->prefix('api')->group(function(){

//     Route::post('/register', [RegisterController::class, "register"]);
//     Route::post('/login', [LoginController::class, "login"]);
// });


