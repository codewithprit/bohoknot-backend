<?php
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/api/greet", [ApiController::class, "greet"]);

Route::get('/register', [RegisterController::class, "register"]);
