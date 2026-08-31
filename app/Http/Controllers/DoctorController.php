<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
       public function index()
    {
        $doctor = Doctor::all();
        return response()->json([
            'message' => 'All doctors',
            'status' => 200,
            'data' => $doctor
        ], 200);
    }

      public function show($id)
    {
     $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json([
                'message' => 'doctor not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'doctor details',
            'status' => 200,
            'data' => $doctor
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "user_id" => 'required|integer|exists:users,id',
            "license_number" => 'required|string|max:255',
            "qualification" => 'required|string|max:255',
            "specialization" => 'required|string|min:3',
            "experience_years" => 'required|numeric',
            "bio" => 'required|string',
            "consultation_fee" => 'required|numeric',
            "status" => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation failed",
                "status" => 422,
                "data" => $validator->errors(),
            ];

            return response()->json($data, 422);
        } else {
            $doctor = Doctor::create( $validator->validated());
            $data = [
                "message" => "doctor added succsessfully",
                "status" => "201",
                "doctor" => $doctor
            ];
            return response()->json($data, 201);
        }
    }

      public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json([
                'message' => 'doctor not found',
                'status' => 404
            ], 404);
        }
        $validator = Validator::make($request->all(), [
              "user_id" => 'sometimes|integer|exists:users,id',
            "license_number" => 'sometimes|string|max:255',
            "qualification" => 'sometimes|string|max:255',
            "specialization" => 'sometimes|string|min:3',
            "experience_years" => 'sometimes|numeric',
            "bio" => 'sometimes|string',
            "consultation_fee" => 'sometimes|numeric',
            "status" => 'sometimes|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ],422);
             }
             $doctor->update($validator->validated());
             return response()->json([
                'message' => 'doctor updated successfully',
                'status' => 200,
                'data' => $doctor],200 );

    }
     public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if(!$doctor){
            return response()->json([
                'message' => 'doctor not found',
                'status' => 404
            ],404);
        }
        $doctor->delete();
        return response()->json([
            'message' => 'doctor deleted successfully',
            'status' => 200
        ],200);
    }
}
