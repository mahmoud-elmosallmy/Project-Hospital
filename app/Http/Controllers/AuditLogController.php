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
        $auditLogs = AuditLog::latest()->get();
        return response()->json([
            'message' => 'All Audit Logs',
            'status' => 200,
            'data' => $auditLogs
        ], 200);
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


  


}