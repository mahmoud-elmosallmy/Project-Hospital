<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserContoller extends Controller
{
    public function user(Request $request)
{
    $data = [
        "message" => "User data",
        "user" => $request->user()
    ];
    return response()->json($data, 200);
    }
}
