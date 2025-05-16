<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NameController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => 'Name records retrieved successfully',
            'data' => Name::all()
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->user_role !== 'admin') {
            return response()->json([
                'status' => 403,
                'message' => 'Only admin can add names'
            ], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:raw,product',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $name = Name::create($data);

        return response()->json([
            'status' => 201,
            'message' => 'Name created successfully',
            'data' => $name
        ], 201);
    }

    public function show($id)
    {
        $name = Name::find($id);
        if (!$name) {
            return response()->json([
                'status' => 404,
                'message' => 'Name not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Name retrieved successfully',
            'data' => $name
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->user_role !== 'admin') {
            return response()->json([
                'status' => 403,
                'message' => 'Only admin can update names'
            ], 403);
        }

        $name = Name::find($id);
        if (!$name) {
            return response()->json([
                'status' => 404,
                'message' => 'Name not found'
            ], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'type' => 'in:raw,product',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $name->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Name updated successfully',
            'data' => $name
        ]);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->user_role !== 'admin') {
            return response()->json([
                'status' => 403,
                'message' => 'Only admin can delete names'
            ], 403);
        }

        $name = Name::find($id);
        if (!$name) {
            return response()->json([
                'status' => 404,
                'message' => 'Name not found'
            ], 404);
        }

        $name->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Name deleted successfully'
        ]);
    }

}
