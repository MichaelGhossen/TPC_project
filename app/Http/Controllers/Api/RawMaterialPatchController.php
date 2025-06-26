<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\RawMaterialBatch;
use App\Models\RawMaterialPatch;
use Illuminate\Http\Request;

class RawMaterialPatchController extends Controller
{
       // Get all
       public function index()
       {
           return response()->json([
               'status' => 200,
               'data' => RawMaterialBatch::with('rawMaterial')->get()
           ]);
       }

       // Get one
       public function show($id)
       {
           $batch = RawMaterialBatch::with('rawMaterial')->find($id);

           if (!$batch) {
               return response()->json(['status' => 404, 'message' => 'Not found'], 404);
           }

           return response()->json([
               'status' => 200,
               'data' => $batch
           ]);
       }

       public function store(Request $request)
       {
           $validated = $request->validate([
               'user_id' => 'required|exists:users,id',
               'raw_material_id' => 'required|exists:raw_materials,raw_material_id',
               'quantity_in' => 'required|numeric|min:0',
               'real_cost' => 'required|numeric|min:0',
               'payment_method' => 'required|string|max:50',
               'supplier' => 'nullable|string|max:255',
               'notes' => 'nullable|string'
           ]);

           // Auto-set quantity_out = 0, quantity_remaining = quantity_in
           $validated['quantity_out'] = 0;
           $validated['quantity_remaining'] = $validated['quantity_in'];

           // ✅ Use correct model name
           $batch = RawMaterialBatch::create($validated);

           return response()->json([
               'status' => 201,
               'message' => 'Created',
               'data' => $batch
           ]);
       }


       // Update
       public function update(Request $request, $id)
       {
           $batch = RawMaterialBatch::find($id);

           if (!$batch) {
               return response()->json(['status' => 404, 'message' => 'Not found'], 404);
           }

           $validated = $request->validate([
               'user_id' => 'sometimes|exists:users,id',
               'raw_material_id' => 'sometimes|exists:raw_materials,raw_material_id',
               'quantity_in' => 'sometimes|numeric|min:0',
               'quantity_out' => 'sometimes|numeric|min:0',
               'quantity_remaining' => 'sometimes|numeric|min:0',
               'real_cost' => 'sometimes|numeric|min:0',
               'payment_method' => 'sometimes|string|max:50',
               'supplier' => 'nullable|string|max:255',
               'notes' => 'nullable|string'
           ]);

           $batch->update($validated);

           return response()->json([
               'status' => 200,
               'message' => 'Updated',
               'data' => $batch
           ]);
       }

       // Delete
       public function destroy($id)
       {
           $batch = RawMaterialBatch::find($id);

           if (!$batch) {
               return response()->json(['status' => 404, 'message' => 'Not found'], 404);
           }

           $rawMaterial = RawMaterial::find($batch->raw_material_id);

           $batch->delete();

           return response()->json([
               'status' => 200,
               'message' => 'Deleted successfully'
           ]);
       }
       public function getByRawMaterialId($raw_material_id)
{
    $batches = RawMaterialBatch::where('raw_material_id', $raw_material_id)->get();

    return response()->json([
        'status' => 200,
        'raw_material_id' => $raw_material_id,
        'data' => $batches
    ]);
}
public function search(Request $request)
{
    $query = RawMaterialBatch::query();

    if ($request->has('raw_material_id')) {
        $query->where('raw_material_id', $request->raw_material_id);
    }

    if ($request->has('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    if ($request->has('payment_method')) {
        $query->where('payment_method', 'like', '%' . $request->payment_method . '%');
    }

    if ($request->has('supplier')) {
        $query->where('supplier', 'like', '%' . $request->supplier . '%');
    }

    if ($request->has('quantity_in_min')) {
        $query->where('quantity_in', '>=', $request->quantity_in_min);
    }

    if ($request->has('quantity_in_max')) {
        $query->where('quantity_in', '<=', $request->quantity_in_max);
    }

    if ($request->has('quantity_remaining_min')) {
        $query->where('quantity_remaining', '>=', $request->quantity_remaining_min);
    }

    if ($request->has('quantity_remaining_max')) {
        $query->where('quantity_remaining', '<=', $request->quantity_remaining_max);
    }

    if ($request->has('real_cost_min')) {
        $query->where('real_cost', '>=', $request->real_cost_min);
    }

    if ($request->has('real_cost_max')) {
        $query->where('real_cost', '<=', $request->real_cost_max);
    }

    $results = $query->get();

    return response()->json([
        'status' => 200,
        'data' => $results
    ]);
}


}
