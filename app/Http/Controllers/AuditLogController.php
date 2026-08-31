<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditLogs = AuditLog::all();
        return response()->json([
            'message' => 'All Audit Logs',
            'status' => 200,
            'data' => $auditLogs
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
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ip_address' => 'nullable|ip',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $auditLog = AuditLog::create($validator->validated());
        return response()->json([
            'message' => 'Audit Log created successfully',
            'status' => 201,
            'data' => $auditLog
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $auditLog = AuditLog::find($id);
        if (!$auditLog) {
            return response()->json([
                'message' => 'Audit Log not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'Audit Log details',
            'status' => 200,
            'data' => $auditLog
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuditLog $auditLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $auditLog = AuditLog::find($id);
        if (!$auditLog) {
            return response()->json([
                'message' => 'Audit Log not found',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'action' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'ip_address' => 'nullable|ip',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $auditLog->update($validator->validated());
        return response()->json([
            'message' => 'Audit Log updated successfully',
            'status' => 200,
            'data' => $auditLog
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $auditLog = AuditLog::find($id);
        if (!$auditLog) {
            return response()->json([
                'message' => 'Audit Log not found',
                'status' => 404
            ], 404);
        }

        $auditLog->delete();
        return response()->json([
            'message' => 'Audit Log deleted successfully',
            'status' => 200
        ], 200);
    }
}