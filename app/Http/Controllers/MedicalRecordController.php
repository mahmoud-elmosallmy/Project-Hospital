<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $medicalRecords = MedicalRecord::all();
        return response()->json([
            'message' => 'All Medical Records',
            'status' => 200,
            'data' => $medicalRecords
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
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_id' => 'required|exists:appointments,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'prescription' => 'required|string',
            'notes' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }
        $medicalRecord = MedicalRecord::create($validator->validated());
        return response()->json([
            'message' => 'Medical Record created successfully',
            'status' => 201,
            'data' => $medicalRecord
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medicalRecord = MedicalRecord::find($id);
        if (!$medicalRecord) {
            return response()->json([
                'message' => 'Medical Record not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'Medical Record details',
            'status' => 200,
            'data' => $medicalRecord
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medicalRecord = MedicalRecord::find($id);
        if (!$medicalRecord) {
            return response()->json([
                'message' => 'Medical Record not found',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'patient_id' => 'sometimes|exists:users,id',
            'doctor_id' => 'sometimes|exists:users,id',
            'appointment_id' => 'sometimes|exists:appointments,id',
            'diagnosis' => 'sometimes|string',
            'treatment' => 'sometimes|string',
            'prescription' => 'sometimes|string',
            'notes' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $medicalRecord->update($validator->validated());
        return response()->json([
            'message' => 'Medical Record updated successfully',
            'status' => 200,
            'data' => $medicalRecord
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicalRecord = MedicalRecord::find($id);
        if (!$medicalRecord) {
            return response()->json([
                'message' => 'Medical Record not found',
                'status' => 404
            ], 404);
        }

        $medicalRecord->delete();
        return response()->json([
            'message' => 'Medical Record deleted successfully',
            'status' => 200
        ], 200);
    }
}
