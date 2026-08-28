<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    
    public function index() {
        $departments = Department::all();
        $data = [
            "message" => "",
            "status" => 200,
            "data" => $departments
        ];
        return response()->json($data,200);
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            "name" => "required|max:255",
            "description" => "required",
            // "image_department" => "required",
            "image_department" => "required|image|mimes:jpeg,jpg,png,webp|max:4096",
            "status" => "required|in:0,1",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation failed",
                "status" => 422,
                "data" => $validator->errors(),
            ];

            return response()->json($data, 422);
        } else {
            $imagePath = $request->file("image_department")->store("departments","public");
            $department = Department::create([
                "name" => $request->name,
                "description" => $request->description,
                "image_department" => $imagePath,
                "status" => $request->status,
            ]);

            $data = [
                "message" => "",
                "status" => 201,
                "data" => $department
            ];

            return response()->json($data,201);
        }
    }

    public function show($id) {
        try {
            $department = Department::FindOrfail($id);
                $data = [
                    "message" => "Department found",
                    "status" => 200,
                    "data" => $department
                ];
            return response()->json($data,200);

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $error) {

            $data = [
                "message" => "Department not found",
                "status" => 404,
            ];
            return response()->json($data,404);
        }
    }

    public function update(Request $request,$id) {

        $department = Department::FindOrfail($id);

        $validator = Validator::make($request->all(),[
            "name" => "required|max:255",
            "description" => "required",
            // "image_department" => "required",
            "image_department" => "nullable|image|mimes:jpeg,jpg,png,webp|max:4096",
            "status" => "required|in:0,1",
        ]);

        // $imagePath = $request->file("image_department")->store("departments","public");

        if ($validator->fails()) {
            $data = [
                "message" => "Validation failed",
                "status" => 422,
                "data" => $validator->errors(),
            ];

            return response()->json($data, 422);

        } else {

            $old_image = $department->image_department;

            if ($request->hasFile("image_department")) {

                $imagePath = $request->file("image_department")
                                    ->store("departments", "public");
            } else {
                $imagePath = $old_image;
            }

            $department->update([
                "name" => $request->name,
                "description" => $request->description,
                "image_department" => $imagePath,
                "status" => $request->status,
            ]);

            if ($request->hasFile("image_department") && $old_image && $old_image != $imagePath) {
                Storage::disk("public")->delete($old_image);
            }

            $data = [
                "message" => "Department updated successfully",
                "status" => 200,
                "data" => $department
            ];

            return response()->json($data,200);
        }
    }

    public function destroy($id) {

        $department = Department::FindOrFail($id);

        if($department->image_department) {
            Storage::disk("public")->delete($department->image_department);
        }

        $department->delete();

        $data = [
            "message" => "Department Deleted Successfully",
            "status" => 200,
            "data" => $department,
        ];
        return response()->json($data,200);
    }
}