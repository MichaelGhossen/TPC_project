<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMaterial;
use Illuminate\Http\Request;

class ProductMaterialController extends Controller
{
    // GET /api/product-materials
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => ProductMaterial::with(['rawMaterial', 'semiProduct'])->get(),
        ]);
    }

    // GET /api/product-materials/{id}
    public function show($id)
    {
        $item = ProductMaterial::with(['rawMaterial', 'semiProduct'])->find($id);
        if (!$item) {
            return response()->json(['status' => 404, 'message' => 'Not found'], 404);
        }
        return response()->json(['status' => 200, 'data' => $item]);
    }

    public function updateByProduct(Request $request, $product_id)
    {
        $product = Product::find($product_id);
        $product_controller = new ProductController();
        if (!$product) {
            return response()->json(['status' => 404, 'message' => 'Product not found'], 404);
        }

        $componentType = $product_controller->getComponentTypeFromCategory($product->category);

        $validated = $request->validate([
            'materials' => 'required|array|min:1',
            'materials.*.component_id' => 'required|integer|min:1|distinct',
            'materials.*.quantity_required_per_unit' => 'required|numeric|min:0.0001',]);

        // Validate existence and correct type
        $errorBag = $product_controller->validateMaterialComponents($validated['materials'], $componentType);
        if ($errorBag->errors()->any()) {
            return response()->json(['status' => 422, 'errors' => $errorBag->errors()], 422);
        }

        if (!$product_controller->validateComponentWeightSum($validated['materials'], $product->weight_per_unit)) {
            return response()->json([
                'status' => 422,
                'message' => 'Sum of component quantities must equal product weight_per_unit.',
                'expected_weight' => $product->weight_per_unit,
                'total_material_quantity' => collect($validated['materials'])->sum('quantity_required_per_unit'),
            ], 422);
        }

        // Replace BOM
        ProductMaterial::where('product_id', $product_id)->delete();
        $product_controller->createProductMaterials($product_id, $validated['materials'], $componentType);

        $items = ProductMaterial::with(['rawMaterial', 'semiProduct'])
            ->where('product_id', $product_id)
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'BOM updated successfully.',
            'product_id' => $product_id,
            'data' => $items,
        ]);
    }

    // GET /api/products/{product_id}/materials
    public function getByProductId($product_id)
    {
        $items = ProductMaterial::with(['rawMaterial', 'semiProduct'])
            ->where('product_id', $product_id)
            ->get();

        return response()->json([
            'status' => 200,
            'product_id' => $product_id,
            'data' => $items,
        ]);
    }
}
