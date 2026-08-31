<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
       public function index()
    {
        $patient = Patient::all();
        return response()->json([
            'message' => 'All patient',
            'status' => 200,
            'data' => $patient
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:Users,id',
            'date_of_birth' => 'nullable|data',
            'gender' => 'required|in:male,female',
            'blood_type' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }
        $patient = Patient::create($validator->validated());
        return response()->json([
            'message' => 'patient created successfully',
            'status' => 201,
            'data' => $patient
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
     $patient = Patient::find($id);
        if (!$patient) {
            return response()->json([
                'message' => 'patient not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'patient details',
            'status' => 200,
            'data' => $patient
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json([
                'message' => 'patient not found',
                'status' => 404
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|integer|exists:Users,id',
            'date_of_birth' => 'sometimes|data',
            'gender' => 'sometimes|in:male,female',
            'blood_type' => 'sometimes|string|max:10',
            'address' => 'sometimes|string|max:255',
            'emergency_contact_name' => 'sometimes|string|max:255',
            'emergency_contact_phone' => 'sometimes|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ],422);
             }
             $patient->update($validator->validated());
             return response()->json([
                'message' => 'patient updated successfully',
                'status' => 200,
                'data' => $patient],200 );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        if(!$patient){
            return response()->json([
                'message' => 'patient not found',
                'status' => 404
            ],404);
        }
        $patient->delete();
        return response()->json([
            'message' => 'patient deleted successfully',
            'status' => 200
        ],200);
    }
}
