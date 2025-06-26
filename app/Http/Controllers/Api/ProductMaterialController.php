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
            'data'   => ProductMaterial::with(['rawMaterial', 'semiProduct'])->get(),
        ]);
    }

    // GET /api/product-materials/{id}
    public function show($id)
    {
        $item = ProductMaterial::with(['rawMaterial', 'semiProduct'])->find($id);
        if (! $item) {
            return response()->json(['status' => 404, 'message' => 'Not found'], 404);
        }
        return response()->json(['status' => 200, 'data' => $item]);
    }

    // PUT /api/products/{product_id}/materials
    public function updateByProduct(Request $request, $product_id)
    {
        // 1) Find product
        $product = Product::find($product_id);
        if (! $product) {
            return response()->json(['status' => 404, 'message' => 'Product not found'], 404);
        }

        // 2) Determine expected component type
        $isRawBOM = in_array($product->category, ['direct_raw', 'semi_raw']);

        // 3) Build validation rules based on product.category
        $rules = [
            'materials' => 'required|array|min:1',
            'materials.*.quantity_required_per_unit' => 'required|numeric|min:0.0001',
        ];

        if ($isRawBOM) {
            $rules['materials.*.raw_material_id'] = 'required|exists:raw_materials,raw_material_id';
        } else {
            $rules['materials.*.semi_product_id'] = 'required|exists:products,product_id';
        }

        $validated = $request->validate($rules);

        // 4) Check for duplicate components
        $seen = [];
        foreach ($validated['materials'] as $i => $m) {
            $key = $isRawBOM
                ? 'raw_' . $m['raw_material_id']
                : 'semi_' . $m['semi_product_id'];
            if (in_array($key, $seen)) {
                return response()->json([
                    'status'  => 409,
                    'message' => "Duplicate component at materials[$i]."
                ], 409);
            }
            $seen[] = $key;
        }

        // 5) If semi_to_finished, ensure each referenced product is semi_raw
        if (! $isRawBOM) {
            foreach ($validated['materials'] as $i => $m) {
                $semi = Product::find($m['semi_product_id']);
                if (! $semi || $semi->category !== 'semi_raw') {
                    return response()->json([
                        'status'  => 422,
                        'message' => "Invalid semi-product at materials[$i]. Must be a semi_raw product."
                    ], 422);
                }
            }
        }

        // 6) Validate total quantity equals product weight_per_unit
        $totalQty = collect($validated['materials'])->sum('quantity_required_per_unit');
        if (abs($totalQty - $product->weight_per_unit) > 0.0001) {
            return response()->json([
                'status'                  => 422,
                'message'                 => 'Sum of component quantities must equal product weight_per_unit.',
                'expected_weight'         => $product->weight_per_unit,
                'total_material_quantity' => $totalQty,
            ], 422);
        }

        // 7) Replace existing BOM entries
        ProductMaterial::where('product_id', $product_id)->delete();

        foreach ($validated['materials'] as $m) {
            ProductMaterial::create([
                'product_id'                 => $product_id,
                'component_type'             => $isRawBOM ? 'raw_material' : 'semi_product',
                'raw_material_id'            => $isRawBOM ? $m['raw_material_id'] : null,
                'semi_product_id'            => $isRawBOM ? null : $m['semi_product_id'],
                'quantity_required_per_unit' => $m['quantity_required_per_unit'],
            ]);
        }

        // 8) Return updated BOM
        $items = ProductMaterial::with(['rawMaterial', 'semiProduct'])
            ->where('product_id', $product_id)
            ->get();

        return response()->json([
            'status'     => 200,
            'message'    => 'BOM updated successfully.',
            'product_id' => $product_id,
            'data'       => $items,
        ]);
    }
    // GET /api/products/{product_id}/materials
    public function getByProductId($product_id)
    {
        $items = ProductMaterial::with(['rawMaterial', 'semiProduct'])
            ->where('product_id', $product_id)
            ->get();

        return response()->json([
            'status'     => 200,
            'product_id' => $product_id,
            'data'       => $items,
        ]);
    }
}
