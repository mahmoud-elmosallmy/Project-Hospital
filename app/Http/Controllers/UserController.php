<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Workbench\App\Models\User as ModelsUser;

class UserController extends Controller
{
       public function index()
    {
        $user = User::all();
        return response()->json([
            'message' => 'All users',
            'status' => 200,
            'data' => $user
        ], 200);
    }
    // public function user(Request $request)
    // {
    // $data = [
    //     "message" => "User data",
    //     "user" => $request->user()
    // ];
    // return response()->json($data, 200);
    // }
      public function show($id)
    {
     $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'user not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'user details',
            'status' => 200,
            'data' => $user
        ], 200);
    }

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

      public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'user not found',
                'status' => 404
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'role_id' => 'sometimes|numeric',
            'email' => 'sometimes|email|unique:users,email,'.$id,
            'password' => 'sometimes|string|min:8',
            'phone' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ],422);
             }
             $user->update($validator->validated());
             return response()->json([
                'message' => 'user updated successfully',
                'status' => 200,
                'data' => $user],200 );

    }
     public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'message' => 'user not found',
                'status' => 404
            ],404);
        }
        $user->delete();
        return response()->json([
            'message' => 'user deleted successfully',
            'status' => 200
        ],200);
    }
}

