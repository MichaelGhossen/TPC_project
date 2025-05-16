<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RawMaterial;
class RawMaterialController extends Controller
{
  public function index()
{
    $data = RawMaterial::all();
    return response()->json([
        'status' => 200,
        'message' => 'Raw materials retrieved successfully',
        'data' => $data
    ], 200);
}

public function store(Request $request)
{
    $data = $request->validate([
        'status' => 'required|in:used,unused',
        'quantity' => 'required|numeric',
        'added_date' => 'nullable|date',
        'price' => 'required|numeric',
        'real_cost' => 'nullable|numeric',
        'estimated_cost' => 'nullable|numeric',
        'user_id' => 'nullable|exists:users,id',
        'name_id' => 'nullable|exists:names,id',
    ]);

    $material = RawMaterial::create($data);

    return response()->json([
        'status' => 201,
        'message' => 'Raw material created successfully',
        'data' => $material
    ], 201);
}

public function show($id)
{
    $material = RawMaterial::find($id);
    if (!$material) {
        return response()->json([
            'status' => 404,
            'message' => 'Raw material not found'
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Raw material retrieved successfully',
        'data' => $material
    ], 200);
}

public function update(Request $request, $id)
{
    $material = RawMaterial::find($id);
    if (!$material) {
        return response()->json([
            'status' => 404,
            'message' => 'Raw material not found'
        ], 404);
    }

    $data = $request->validate([
        'status' => 'in:used,unused',
        'quantity' => 'numeric',
        'added_date' => 'nullable|date',
        'price' => 'numeric',
        'real_cost' => 'nullable|numeric',
        'estimated_cost' => 'nullable|numeric',
        'user_id' => 'nullable|exists:users,id',
        'name_id' => 'nullable|exists:names,id',
    ]);

    $material->update($data);

    return response()->json([
        'status' => 200,
        'message' => 'Raw material updated successfully',
        'data' => $material
    ], 200);
}

public function destroy($id)
{
    $material = RawMaterial::find($id);

    if (!$material) {
        return response()->json([
            'status' => 404,
            'message' => 'Raw material not found'
        ], 404);
    }

    if ($material->status === 'used') {
        return response()->json([
            'status' => 403,
            'message' => 'Cannot delete a raw material that is marked as used'
        ], 403);
    }

    $material->delete();

    return response()->json([
        'status' => 200,
        'message' => 'Raw material deleted successfully'
    ], 200);
}

}
