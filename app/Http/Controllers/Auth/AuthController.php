<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
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
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;
            $data = [
                "message" => "User Registered Successfully",
                "status" => "201",
                "user" => $user,
                "token" => $token
            ];
            return response()->json($data, 201);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|string",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Failed",
                "status" => 422,
                "data" => $validator->errors(),
            ];

            return response()->json($data, 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            $data = [
                "message" => "Email Or Password is incorrect",
                "status" => 401,
            ];

            return response()->json($data, 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            "message" => "Login Successfully",
            "status" => 200,
            "user" => $user,
            "token" => $token,
        ];

        return response()->json($data, 200);
    }

    public function logout(Request $request) {

        $request-> user()->currentAccessToken()->delete();

        $data = [
            "Message" => "Logout SuccessFully",
            "status" => 200,
        ];
        return response()->json($data,200);
    }
}