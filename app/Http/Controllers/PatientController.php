<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class PatientController extends Controller
{
    use AuthorizesRequests;
       public function index()
    {
        $user = Auth::user();
        if (in_array($user->role_id, [1, 3])) {
            $patient = Patient::all();
        } elseif( $user->role_id === 2) {
            $patient = Patient::whereHas('appointments', function ($query) use ($user) {
                $query->where('doctor_id', $user->id);
            })->get();
        }else{
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 403
            ], 403);
        }
        return response()->json([
            'message' => 'All patient',
            'status' => 200,
            'data' => $patient
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Patient::class);
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:Users,id',
            "profile_image" => "required|image|mimes:jpeg,jpg,png,webp|max:4096",
            'date_of_birth' => 'nullable|date',
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
        } else {
            
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
        $this->authorize('view', $patient);
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
        $this->authorize('update', $patient);
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|integer|exists:Users,id',
            'date_of_birth' => 'sometimes|date',
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
        $this->authorize('delete', $patient);
        $patient->delete();
        return response()->json([
            'message' => 'patient deleted successfully',
            'status' => 200
        ],200);
    }
}
