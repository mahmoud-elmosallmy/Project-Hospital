<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::all();
        return response()->json([
            'message' => 'All Notifications',
            'status' => 200,
            'data' => $notifications
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
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'nullable|string',
            'is_read' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }
        $notification = Notification::create($validator->validated());
        return response()->json([
            'message' => 'Notification created successfully',
            'status' => 201,
            'data' => $notification
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'Notification details',
            'status' => 200,
            'data' => $notification
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'title' => 'sometimes|string|max:255',
            'message' => 'sometimes|string',
            'type' => 'nullable|string',
            'is_read' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $notification->update($validator->validated());
        return response()->json([
            'message' => 'Notification updated successfully',
            'status' => 200,
            'data' => $notification
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json([
                'message' => 'Notification not found',
                'status' => 404
            ], 404);
        }

        $notification->delete();
        return response()->json([
            'message' => 'Notification deleted successfully',
            'status' => 200
        ], 200);
    }
}
