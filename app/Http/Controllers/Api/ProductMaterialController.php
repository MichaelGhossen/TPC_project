<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductMaterial;
use Illuminate\Http\Request;

class ProductMaterialController extends Controller
{
       // Get all
       public function index()
       {
           return response()->json([
               'status' => 200,
               'data' => ProductMaterial::all()
           ]);
       }

       // Get one by ID
       public function show($id)
       {
           $item = ProductMaterial::find($id);

           if (!$item) {
               return response()->json(['status' => 404, 'message' => 'Not found'], 404);
           }

           return response()->json(['status' => 200, 'data' => $item]);
       }

       public function store(Request $request)
{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,product_id',
        'raw_material_id' => 'required|exists:raw_materials,raw_material_id',
        'quantity_required_per_unit' => 'required|numeric|min:0'
    ]);

    // ✅ Check for duplicate (same product_id + raw_material_id)
    $exists = ProductMaterial::where('product_id', $validated['product_id'])
        ->where('raw_material_id', $validated['raw_material_id'])
        ->exists();

    if ($exists) {
        return response()->json([
            'status' => 409,
            'message' => 'This raw material is already assigned to the product.'
        ], 409);
    }

    $item = ProductMaterial::create($validated);

    return response()->json([
        'status' => 201,
        'message' => 'Created',
        'data' => $item
    ]);
}


       // Update
       public function update(Request $request, $id)
{
    $item = ProductMaterial::find($id);

    if (!$item) {
        return response()->json([
            'status' => 404,
            'message' => 'Not found'
        ], 404);
    }

    $validated = $request->validate([
        'product_id' => 'sometimes|exists:products,product_id',
        'raw_material_id' => 'sometimes|exists:raw_materials,raw_material_id',
        'quantity_required_per_unit' => 'sometimes|numeric|min:0'
    ]);

    // Use existing values if not present in request
    $productId = $validated['product_id'] ?? $item->product_id;
    $rawMaterialId = $validated['raw_material_id'] ?? $item->raw_material_id;

    // ✅ Check for duplication (exclude current row)
    $duplicate = ProductMaterial::where('product_id', $productId)
        ->where('raw_material_id', $rawMaterialId)
        ->where('product_material_id', '!=', $id)
        ->exists();

    if ($duplicate) {
        return response()->json([
            'status' => 409,
            'message' => 'This raw material is already assigned to this product.'
        ], 409);
    }

    // Update the current row with validated data
    $item->update($validated);

    return response()->json([
        'status' => 200,
        'message' => 'Updated',
        'data' => $item
    ]);
}



       // Delete
       public function destroy($id)
       {
           $item = ProductMaterial::find($id);

           if (!$item) {
               return response()->json(['status' => 404, 'message' => 'Not found'], 404);
           }

           $item->delete();

           return response()->json(['status' => 200, 'message' => 'Deleted']);
       }

       // Get by product_id
       public function getByProductId($product_id)
       {
           $items = ProductMaterial::where('product_id', $product_id)->get();

           return response()->json([
               'status' => 200,
               'product_id' => $product_id,
               'data' => $items
           ]);
       }
}
