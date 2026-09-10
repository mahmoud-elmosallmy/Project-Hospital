<?php

namespace App\Http\Controllers;

use App\Models\DoctorDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DoctorDepartmentController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $user = Auth::user();
        if ($user->role_id === 1 || $user->role_id === 3) {
            $doctors_department = DoctorDepartment::all();
        } else {
            $doctors_department = DoctorDepartment::where('doctor_id', $user->id)->get();
        }
        $data = [
            "message" => "Show All Doctor Department",
            "status" => 200,
            "data" => $doctors_department
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $this->authorize('create', DoctorDepartment::class);
        $validator = Validator::make($request->all(), [
            "doctor_id" => "required|exists:doctors,id",
            "department_id" => "required|exists:departments,id",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "validation failed",
                "status" => 422,
                "data" => $validator->errors(),
            ];
            return response()->json($data, 422);
        }

        $doctor_department = DoctorDepartment::create([
            "doctor_id" => $request->doctor_id,
            "department_id" => $request->department_id,
        ]);

        $data = [
            "message" => "SuccessFully Created Doctor Department",
            "status" => 201,
            "data" => $doctor_department,
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {

        $doctor_department = DoctorDepartment::find($id);
        if(!$doctor_department){
            $data = [
                "message" => "Doctor Department Not Found",
                "status" => 404,
                "data" => null
            ];
            return response()->json($data, 404);
        }
        $this->authorize('view', $doctor_department);
        $data = [
            "message" => "Doctor Department Found",
            "status" => 200,
            "data" => $doctor_department
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {

        $doctor_department = DoctorDepartment::find($id);
        if (!$doctor_department) {
            $data = [
                "message" => "Doctor Department Not Found",
                "status" => 404,
                "data" => null
            ];
            return response()->json($data, 404);
        }
        $this->authorize('update', $doctor_department);

        $validator = Validator::make($request->all(), [
            "doctor_id" => "required|exists:doctors,id",
            "department_id" => "required|exists:departments,id",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Failed",
                "status" => 422,
                "data" => $validator->errors()
            ];
            return response()->json($data, 422);
        } else {
            $doctor_department->update([
                "doctor_id" => $request->doctor_id,
                "department_id" => $request->department_id,
            ]);

            $data = [
                "message" => "Doctor Department updated successfully",
                "status" => 200,
                "data" => $doctor_department,
            ];

            return response()->json($data, 200);
        }
    }

    public function destroy($id)
    {

        $doctor_department = DoctorDepartment::find($id);
        if (!$doctor_department) {
            $data = [
                "message" => "Doctor Department Not Found",
                "status" => 404,
                "data" => null
            ];
            return response()->json($data, 404);
        }
        $this->authorize('delete', $doctor_department);
        $doctor_department->delete();

        $data = [
            "message" => "Doctor Department Deleted Successfully",
            "status" => 200,
            "data" => $doctor_department,
        ];

        return response()->json($data, 200);
    }
}
