<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctorSchedules = DoctorSchedule::all();
        return response()->json([
            'message' => 'All Doctor Schedules',
            'status' => 200,
            'data' => $doctorSchedules
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
            'doctor_id' => 'required|exists:users,id',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'avg_duration' => 'required|integer|min:1',
            'status' => 'required|in:available,booked,unavailable,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $doctorSchedule = DoctorSchedule::create($validator->validated());
        return response()->json([
            'message' => 'Doctor Schedule created successfully',
            'status' => 201,
            'data' => $doctorSchedule
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctorSchedule = DoctorSchedule::find($id);
        if (!$doctorSchedule) {
            return response()->json([
                'message' => 'Doctor Schedule not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'Doctor Schedule details',
            'status' => 200,
            'data' => $doctorSchedule
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $doctorSchedule = DoctorSchedule::find($id);
        if (!$doctorSchedule) {
            return response()->json([
                'message' => 'Doctor Schedule not found',
                'status' => 404
            ], 404);
        }
        $data = $request->all();
        if (!$request->has('start_time')) {
            $data['start_time'] = $doctorSchedule->start_time;
        }
       
        if (!$request->has('end_time')) {
            $data['end_time'] = $doctorSchedule->end_time;
        }
        $validator = Validator::make($data, [
            'doctor_id' => 'sometimes|exists:users,id',
            'day_of_week' => 'sometimes|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'sometimes|date_format:H:i,h:i:s',
            'end_time' => 'sometimes|date_format:H:i,h:i:s|after:start_time',
            'avg_duration' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:available,booked,unavailable,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $doctorSchedule->update($validator->validated());
        return response()->json([
            'message' => 'Doctor Schedule updated successfully',
            'status' => 200,
            'data' => $doctorSchedule
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctorSchedule = DoctorSchedule::find($id);
        if (!$doctorSchedule) {
            return response()->json([
                'message' => 'Doctor Schedule not found',
                'status' => 404
            ], 404);
        }
        $doctorSchedule->delete();
        return response()->json([
            'message' => 'Doctor Schedule deleted successfully',
            'status' => 200
        ], 200);
    }
}
