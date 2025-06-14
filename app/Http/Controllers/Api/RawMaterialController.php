<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RawMaterial;

class RawMaterialController extends Controller
{
     // ✅ Get all raw materials
     public function index()
     {
         return response()->json([
             'status' => 200,
             'data' => RawMaterial::all()
         ]);
     }

     // ✅ Create new raw material
     public function store(Request $request)
     {
         $data = $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'price' => 'required|numeric|min:0',
             'status' => 'required|in:used,unused',
             'minimum_stock_alert' => 'nullable|numeric|min:0',
         ]);

         $material = RawMaterial::create($data);

         return response()->json(['status' => 201, 'message' => 'Created successfully', 'data' => $material]);
     }

     // ✅ Show specific raw material
     public function show($id)
     {
         $material = RawMaterial::find($id);
         if (!$material) {
             return response()->json(['status' => 404, 'message' => 'Not found']);
         }
         return response()->json(['status' => 200, 'data' => $material]);
     }

     // ✅ Update raw material
     public function update(Request $request, $id)
     {
         $material = RawMaterial::find($id);
         if (!$material) {
             return response()->json(['status' => 404, 'message' => 'Not found']);
         }

         $data = $request->validate([
             'name' => 'sometimes|string|max:255',
             'description' => 'nullable|string',
             'price' => 'sometimes|numeric|min:0',
             'status' => 'sometimes|in:used,unused',
             'minimum_stock_alert' => 'nullable|numeric|min:0',
         ]);

         $material->update($data);

         return response()->json(['status' => 200, 'message' => 'Updated', 'data' => $material]);
     }

     // ✅ Delete raw material
     public function destroy($id)
     {
         $material = RawMaterial::find($id);
         if (!$material) {
             return response()->json(['status' => 404, 'message' => 'Not found']);
         }

         $material->delete();
         return response()->json(['status' => 200, 'message' => 'Deleted']);
     }

     // ✅ Search by name and status
     public function search(Request $request)
     {
         $query = RawMaterial::query();

         if ($request->has('name')) {
             $query->where('name', 'LIKE', '%' . $request->name . '%');
         }

         if ($request->has('status')) {
             $query->where('status', $request->status);
         }

         return response()->json([
             'status' => 200,
             'data' => $query->get()
         ]);
     }

}
