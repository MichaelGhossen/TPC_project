<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RawMaterial;

class RawMaterialController extends Controller
{
    // Get all
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => RawMaterial::all()
        ]);
    }

    public function materialsCount()
    {
         return rawMaterial::where('status','used')->count();
    }

    // Get one
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
            'data' => $material
        ]);
    }

    // Store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:raw_materials,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:used,unused',
            'minimum_stock_alert' => 'required|integer|min:0'
        ]);

        $material = RawMaterial::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Raw material created',
            'data' => $material
        ], 201);
    }

    // Update
    public function update(Request $request, $id)
    {
        $material = RawMaterial::find($id);

        if (!$material) {
            return response()->json([
                'status' => 404,
                'message' => 'Raw material not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:raw_materials,name,' . $id . ',raw_material_id',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:used,unused',
            'minimum_stock_alert' => 'sometimes|integer|min:0'
        ]);

        $material->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Raw material updated',
            'data' => $material
        ]);
    }

    // Delete with constraint
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
                'message' => 'Cannot delete a used raw material'
            ], 403);
        }

        $material->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Raw material deleted'
        ]);
    }

    public function search(Request $request)
    {
        $query = RawMaterial::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->has('minimum_stock_alert')) {
            $query->where('minimum_stock_alert', $request->minimum_stock_alert);
        }

        $results = $query->get();

        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }

}
