<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
     public function index()
    {
        $role = Role::all();
        return response()->json([
            'message' => 'All roles',
            'status' => 200,
            'data' => $role
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

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }
        $role = Role::create($validator->validated());
        return response()->json([
            'message' => 'role created successfully',
            'status' => 201,
            'data' => $role
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
     $role = role::find($id);
        if (!$role) {
            return response()->json([
                'message' => 'role not found',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'role details',
            'status' => 200,
            'data' => $role
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'message' => 'role not found',
                'status' => 404
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 422,
                'errors' => $validator->errors()
            ],422);
             }
             $role->update($validator->validated());
             return response()->json([
                'message' => 'role updated successfully',
                'status' => 200,
                'data' => $role],200 );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = role::find($id);
        if(!$role){
            return response()->json([
                'message' => 'role not found',
                'status' => 404
            ],404);
        }
        $role->delete();
        return response()->json([
            'message' => 'role deleted successfully',
            'status' => 200
        ],200);
    }
}
