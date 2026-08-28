<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index() {

        $setting = Setting::first();

        $data = [
            "message" => "Show Settings",
            "status" => 200,
            "data" => $setting,
        ];

        return response()->json($data,200);
    }

    public function store(Request $request) {

        $setting = Setting::first();

        if ($setting) {
            return response()->json([
                "message" => "Settings already exist",
                "status" => 409,
                "data" => $setting,
            ], 409);
        }

        $validator = Validator::make($request->all(),[
            "hospital_name" => "required|string|max:255",
            "logo" => "nullable|image|mimes:jpeg,jpg,png,webp|max:4096",
            "phone" => "required|string",
            "email" => "required|email:dns",
            "address" => "required|string|max:255",
            "description" => "nullable|string",
            "facebook" => "nullable|string",
            "instagram" => "nullable|string",
            "status" => "required|in:0,1",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Faild",
                "status" => 422,
                "data" => $validator->errors(),
            ];
            return response()->json($data,422);
        } else {
            $logoPath = null;
            if ($request->hasFile("logo")) {
                $logoPath = $request->file("logo")->store("setting","public");
            }
            $setting = Setting::create([
                "hospital_name" => $request->hospital_name,
                "logo" => $logoPath,
                "phone" => $request->phone,
                "email" => $request->email,
                "address" =>$request->address,
                "description" => $request->description,
                "facebook" => $request->facebook,
                "instagram" => $request->instagram,
                "status" => $request->status,
            ]);

            $data = [
                "message" => "Settings Created Successfully",
                "status" => 201,
                "data" => $setting,
            ];
            return response()->json($data,201);
        }
    }

    public function update(Request $request,$id) {
        $setting = Setting::FindOrFail($id);
        $validator = Validator::make($request->all(),[
            "hospital_name" => "required|string|max:255",
            "logo" => "nullable|image|mimes:jpeg,jpg,png,webp|max:4096",
            "phone" => "required|string",
            "email" => "required|email:dns",
            "address" => "required|string|max:255",
            "description" => "nullable|string",
            "facebook" => "nullable|string",
            "instagram" => "nullable|string",
            "status" => "required|in:0,1",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Faild",
                "status" => 422,
                "data" => $validator->errors(),
            ];
            return response()->json($data,422);
        } else {
            $old_logoPath = $setting->logo;

            if ($request->hasFile("logo")) {
                $logoPath = $request->file("logo")->store("setting", "public");
            } else {
                $logoPath = $old_logoPath;
            }

            $setting->update([
                "hospital_name" => $request->hospital_name,
                "logo" => $logoPath,
                "phone" => $request->phone,
                "email" => $request->email,
                "address" =>$request->address,
                "description" => $request->description,
                "facebook" => $request->facebook,
                "instagram" => $request->instagram,
                "status" => $request->status,
            ]);

            if ($request->hasFile("logo") && $old_logoPath && $old_logoPath != $logoPath) {
                Storage::disk("public")->delete($old_logoPath);
            }

            $data = [
                "message" => "Settings Updated Successfully",
                "status" => 200,
                "data" => $setting
            ];
            return response()->json($data,200);
        }
    }
    
    public function show($id) {

        $setting = Setting::FindOrFail($id);

        $data = [
            "message" => "Show Setting",
            "status" => 200,
            "data" => $setting
        ];
        return response()->json($data,200);
    }
}
