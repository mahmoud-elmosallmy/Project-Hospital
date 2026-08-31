<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'message' => 'All Services',
            'status' => 200,
            'data' => $services
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }
        $service = Service::create($validator->validated());
        return response()->json([
            'message' => 'Service created successfully',
            'status' => 201,
            'data' => $service
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
     $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'message' => 'Service not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'Service details',
            'status' => 200,
            'data' => $service
        ], 200);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json([
                'message' => 'Service not found',
                'status' => 404
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'status' => 'sometimes|required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ],422);
             }
             $service->update($validator->validated());
             return response()->json([
                'message' => 'Service updated successfully',
                'status' => 200,
                'data' => $service],200 );
                 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if(!$service){
            return response()->json([
                'message' => 'Service not found',
                'status' => 404
            ],404);
        }
        $service->delete();
        return response()->json([
            'message' => 'service deleted successfully',
            'status' => 200
        ],200);
    }
}
