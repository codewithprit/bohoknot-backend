<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function showSession(){
        return response()->json(session()->all());
    }
}
