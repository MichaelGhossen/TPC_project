<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\RawMaterialPatch;
use Illuminate\Http\Request;

class RawMaterialPatchController extends Controller
{
       // Get all
       public function index()
       {
           return response()->json([
               'status' => 200,
               'data' => RawMaterialPatch::all()
           ]);
       }

       // Get one
       public function show($id)
       {
           $batch = RawMaterialPatch::find($id);

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
           $batch = RawMaterialPatch::create($validated);

           return response()->json([
               'status' => 201,
               'message' => 'Created',
               'data' => $batch
           ]);
       }


       // Update
       public function update(Request $request, $id)
       {
           $batch = RawMaterialPatch::find($id);

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
           $batch = RawMaterialPatch::find($id);

           if (!$batch) {
               return response()->json(['status' => 404, 'message' => 'Not found'], 404);
           }

           $rawMaterial = RawMaterial::find($batch->raw_material_id);

           if ($rawMaterial && $rawMaterial->status === 'used') {
               return response()->json([
                   'status' => 403,
                   'message' => 'Cannot delete: raw material is in use'
               ], 403);
           }

           $batch->delete();

           return response()->json([
               'status' => 200,
               'message' => 'Deleted successfully'
           ]);
       }
}
