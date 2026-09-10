<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AppointmentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $user = Auth::user();
        if ($user->role_id == 1 || $user->role_id == 3) {
            $appointment = Appointment::all();
        } elseif ($user->role_id == 2) {
            $appointment = Appointment::where('doctor_id', $user->id)->get();
        } else {
            $appointment = Appointment::whereHas('patient', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->get();
        }
        return response()->json([
            'message' => 'All Appointments',
            'status' => 200,
            'data' => $appointment
        ], 200);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'doctor_schedule_id' => 'required|exists:doctor_schedules,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }
          $this->authorize('create', Appointment::class);
        $appointment = Appointment::create($validator->validated());
        return response()->json([
            'message' => 'Appointment created successfully',
            'status' => 201,
            'data' => $appointment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $appointment =  Appointment::find($id); 
    
        if (!$appointment) {
            return response()->json([
                'message' => 'Appointment not found',
                'status' => 404
            ], 404);
        }
        $this->authorize('view', $appointment);
        return response()->json([
            'message' => 'Appointment details',
            'status' => 200,
            'data' => $appointment
        ], 200);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json([
                'message' => 'Appointment not found',
                'status' => 404
            ], 404);
        }
        $this->authorize('update', $appointment);

        $validator = Validator::make($request->all(), [
            'patient_id' => 'sometimes|exists:users,id',
            'doctor_id' => 'sometimes|exists:users,id',
            'doctor_schedule_id' => 'sometimes|exists:doctor_schedules,id',
            'appointment_date' => 'sometimes|date',
            'appointment_time' => 'sometimes|date_format:H:i',
            'status' => 'sometimes|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment->update($validator->validated());
        return response()->json([
            'message' => 'Appointment updated successfully',
            'status' => 200,
            'data' => $appointment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json([
                'message' => 'Appointment not found',
                'status' => 404
            ], 404);
        }
        $this->authorize('delete', $appointment);
        $appointment->delete();
        return response()->json([
            'message' => 'Appointment deleted successfully',
            'status' => 200
        ], 200);
    }
}
