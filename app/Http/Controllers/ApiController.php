<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    public function greet(){
        print("bkl");exit;
        $data = $request->input();
        // return response->json([
        //     "message" => "hello"
        // ]);
    }
}
