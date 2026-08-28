<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // public function user(Request $request)
    // {
    // $data = [
    //     "message" => "User data",
    //     "user" => $request->user()
    // ];
    // return response()->json($data, 200);
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => 'required|string|max:255',
            "last_name" => 'required|string|max:255',
            "email" => 'required|email:dns|unique:users,email',
            "password" => 'required|string|min:8',
            "phone" => 'required|string'
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation failed",
                "status" => 422,
                "data" => $validator->errors(),
            ];

            return response()->json($data, 422);
        } else {
            $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => 3,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            // 'status' => "1"
            ]);
            $data = [
                "message" => "User Registered Successfully",
                "status" => "201",
                "user" => $user
            ];
            return response()->json($data, 201);
        }
    }
}
