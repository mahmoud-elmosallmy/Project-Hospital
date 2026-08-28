<?php

namespace App\Http\Controllers;

use App\Models\DoctorDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorDepartmentController extends Controller
{

    public function index() {
        $doctors_department = DoctorDepartment::all();
        $data = [
            "message" => "Show All Doctor Department",
            "status" => 200,
            "data" => $doctors_department
        ];
        return response()->json($data,200);
    }

    public function store(Request $request) {

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
            return response()->json($data,422);
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

        return response()->json($data,201);
    }

    public function show($id) {

        $doctor_department = DoctorDepartment::FindOrfail($id);
        $data = [
            "message" => "Doctor Department Found",
            "status" => 200,
            "data" => $doctor_department
        ];
        return response()->json($data,200);
    }

    public function update(Request $request,$id) {

        $doctor_department = DoctorDepartment::FindOrFail($id);

        $validator = Validator::make($request->all(),[
            "doctor_id" => "required|exists:doctors,id",
            "department_id" => "required|exists:departments,id",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Failed",
                "status" => 422,
                "data" => $validator->errors()
            ];
            return response()->json($data,422);
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

            return response()->json($data,200);
        } 

    }

    public function destroy($id) { 

        $doctor_department = DoctorDepartment::FindOrFail($id);

        $doctor_department->delete();

        $data = [
            "message" => "Doctor Department Deleted Successfully",
            "status" => 200,
            "data" => $doctor_department,
        ];

        return response()->json($data,200);
    }
}
