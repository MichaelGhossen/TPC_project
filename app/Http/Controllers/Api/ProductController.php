<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Product;
use App\Models\ProductionSetting;
use App\Models\ProductMaterial;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Get all
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Product::with('productMaterials')->get(),
        ]);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::with('productMaterials')->find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $product,
        ]);
    }

    // POST /api/products
    public function store(Request $request)
    {
        // 1) Validate main product fields + BOM array
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'category' => 'required|in:direct_raw,semi_raw,semi_to_finished',
            'weight_per_unit' => 'required|numeric|min:0',
            'minimum_stock_alert' => 'required|integer|min:0',
            'materials' => 'required|array|min:1',
            'materials.*.component_id' => 'required|integer|min:1',
            'materials.*.quantity_required_per_unit' => 'required|numeric|min:0.0001',
        ]);

        // 2) Determine component_type and existence check
        $componentType = $validated['category'] === 'semi_to_finished'
            ? 'semi_product'
            : 'raw_material';

        $errors = Validator::make([], []);
        foreach ($validated['materials'] as $i => $m) {
            if ($componentType === 'raw_material') {
                if (!RawMaterial::where('raw_material_id', $m['component_id'])->exists()) {
                    $errors->errors()->add("materials.$i.component_id", 'Invalid raw material');
                }
            } else { // semi_product
                $semi = Product::find($m['component_id']);
                if (!$semi || $semi->category !== 'semi_raw') {
                    $errors->errors()->add("materials.$i.component_id", 'Invalid semi-product (must be semi_raw)');
                }
            }
        }
        if ($errors->errors()->any()) {
            return response()->json([
                'status' => 422,
                'errors' => $errors->errors(),
            ], 422);
        }

        // 3) Ensure total component quantities match weight_per_unit
        $sum = collect($validated['materials'])->sum('quantity_required_per_unit');
        if (abs($sum - $validated['weight_per_unit']) > 0.0001) {
            return response()->json([
                'status' => 422,
                'message' => 'Sum of component quantities must equal weight_per_unit.',
                'weight_per_unit' => $validated['weight_per_unit'],
                'total_material_quantity' => $sum,
            ], 422);
        }

        // 4) Create product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'weight_per_unit' => $validated['weight_per_unit'],
            'minimum_stock_alert' => $validated['minimum_stock_alert'],
        ]);

        // 5) Attach each material to BOM
        foreach ($validated['materials'] as $m) {
            ProductMaterial::create([
                'product_id' => $product->product_id,
                'component_type' => $componentType,
                'quantity_required_per_unit' => $m['quantity_required_per_unit'],
                // set the correct FK field:
                $componentType === 'raw_material'
                    ? 'raw_material_id'
                    : 'semi_product_id' => $m['component_id'],
            ]);
        }

        $componentType === 'semi_product'
        ? $product->load('productMaterials.semiProduct')
        : $product->load('productMaterials.rawMaterial');

        return response()->json([
            'status' => 201,
            'message' => 'Product created with BOM.',
            'data' => $product,
        ], 201);
    }

    // PUT /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found',
            ], 404);
        }

        $validated = $request->validate([
            'name' => "sometimes|string|max:255|unique:products,name,{$id},product_id",
            'description' => 'nullable|string',
            'weight_per_unit' => 'sometimes|numeric|min:0',
            'minimum_stock_alert' => 'sometimes|integer|min:0',
        ]);

        $product->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Product updated.',
            'data' => $product,
        ]);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Product deleted.',
        ]);
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->has('category')) {
            $query->where('category', $request->category); // 'semi_finished' or 'finished'
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->has('weight_per_unit')) {
            $query->where('weight_per_unit', $request->weight_per_unit);
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
    public function updateProductsPrices()
    {
        $year  = now()->year;
        $month = now()->month;

        // ——————————————————————————————
        // 1) Fetch ProductionSetting (real → estimated)
        $setting = ProductionSetting::where('type', 'real')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->first()
            ?? ProductionSetting::where('type', 'estimated')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->first();

        if (! $setting) {
            return response()->json([
                'status'  => 404,
                'message' => "No production setting for {$year}-{$month}.",
            ], 404);
        }

        // 2) Sum expenses (real → estimated)
        $expenses = Expense::where('type', 'real')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('amount')
            ?: Expense::where('type', 'estimated')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->sum('amount');

        if ($expenses <= 0) {
            return response()->json([
                'status'  => 422,
                'message' => "No expenses for {$year}-{$month}.",
            ], 422);
        }

        if ($setting->total_production <= 0) {
            return response()->json([
                'status'  => 422,
                'message' => 'Total production must be > 0.',
            ], 422);
        }

        $unitExpense = $expenses / $setting->total_production;

        // ——————————————————————————————
        // 3) First: direct_raw + semi_raw (their BOM uses raw materials)
        $initialCats = ['direct_raw', 'semi_raw'];
        $initialProducts = Product::with(['productMaterials.rawMaterial'])
            ->whereIn('category', $initialCats)
            ->get();

        foreach ($initialProducts as $product) {
            // raw-material cost
            $rawCost = $product->productMaterials
                ->sum(function($m) {
                    return $m->quantity_required_per_unit
                        * $m->rawMaterial->price;
                });

            $costPrice  = $rawCost + ($unitExpense * $product->weight_per_unit);
            $finalPrice = $costPrice * (1 + $setting->profit_ratio);

            $product->update(['price' => round($finalPrice, 2)]);
        }

        // ——————————————————————————————
        // 4) Then: semi_to_finished (their BOM uses semi-products)
        $finalProducts = Product::with(['productMaterials.semiProduct'])
            ->where('category', 'semi_to_finished')
            ->get();

        foreach ($finalProducts as $product) {
            // semi-product cost
            $semiCost = $product->productMaterials
                ->sum(function($m) {
                    return $m->quantity_required_per_unit
                        * $m->semiProduct->price;
                });

            $costPrice  = $semiCost + ($unitExpense * $product->weight_per_unit);
            $finalPrice = $costPrice * (1 + $setting->profit_ratio);

            $product->update(['price' => round($finalPrice, 2)]);
        }

        // Collect all updated products to return
        $all = $initialProducts->merge($finalProducts);

        return response()->json([
            'status'  => 200,
            'message' => 'Product prices updated successfully.',
            'data'    => $all,
        ]);
    }

}
