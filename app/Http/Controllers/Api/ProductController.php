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
            'data' => Product::with('productMaterials')->get()
        ]);
    }

    public function productsCount()
    {
        return Product::all()->count();
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
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'category' => 'required|in:direct_raw,semi_raw,semi_to_finished',
            'weight_per_unit' => 'required|numeric|min:0',
            'minimum_stock_alert' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'materials' => 'required|array|min:1',
            'materials.*.component_id' => 'required|integer|min:1|distinct',
            'materials.*.quantity_required_per_unit' => 'required|numeric|min:0.0001',
        ]);
        if ($validated['category'] == 'semi_raw' && floatval($validated['weight_per_unit']) !== 1.0) {
            return response()->json([
                'status' => 422,
                'message' => 'Weight per unit must be exactly 1 for semi_raw products.',
            ]);
        }

        $componentType = $this->getComponentTypeFromCategory($validated['category']);
        $errorBag = $this->validateMaterialComponents($validated['materials'], $componentType);

        if ($errorBag->errors()->any()) {
            return response()->json(['status' => 422, 'errors' => $errorBag->errors()], 422);
        }

        if (!$this->validateComponentWeightSum($validated['materials'], $validated['weight_per_unit'])) {
            return response()->json([
                'status' => 422,
                'message' => 'Sum of component quantities must equal weight_per_unit.',
                'weight_per_unit' => $validated['weight_per_unit'],
                'total_material_quantity' => collect($validated['materials'])->sum('quantity_required_per_unit'),
            ], 422);
        }
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'weight_per_unit' => $validated['weight_per_unit'],
            'minimum_stock_alert' => $validated['minimum_stock_alert'],
            'image_path' => $imagePath,
        ]);

        $this->createProductMaterials($product->product_id, $validated['materials'], $componentType);

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
    public function update(Request $request, $id)    //if category or weight changed then the BOM must be changes
    {
        $product = Product::with('productMaterials')->find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found',
            ], 404);
        }

        $validated = $request->validate([
            'name' => "sometimes|string|max:255|unique:products,name,{$id},product_id",
            'description' => 'nullable|string',
            'category' => 'sometimes|in:direct_raw,semi_raw,semi_to_finished',
            'weight_per_unit' => 'sometimes|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'minimum_stock_alert' => 'sometimes|integer|min:0',
            'materials' => 'required_with:weight_per_unit,category|array|min:1',
            'materials.*.component_id' => 'required_with:materials|integer|min:1|distinct',
            'materials.*.quantity_required_per_unit' => 'required_with:materials|numeric|min:0.0001',
        ]);

        $originalCategory = $product->category;
        $originalWeight = $product->weight_per_unit;

        $newCategory = $validated['category'] ?? $originalCategory;
        $newWeight = $validated['weight_per_unit'] ?? $originalWeight;

        if ($newCategory === 'semi_raw' && $newWeight !== 1.0) {
            return response()->json([
                'status' => 422,
                'message' => 'For semi_raw products, weight_per_unit must be exactly 1.',
            ], 422);
        }

        $categoryChanged = isset($validated['category']) && $validated['category'] !== $originalCategory;
        $weightChanged = isset($validated['weight_per_unit']) && abs($validated['weight_per_unit'] - $originalWeight) > 0.0001;

        if ($categoryChanged || $weightChanged) {
            if (!isset($validated['materials'])) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Updating category or weight_per_unit requires materials to be sent.',
                ], 422);
            }

            $componentType = $this->getComponentTypeFromCategory($newCategory);

            $errorBag = $this->validateMaterialComponents($validated['materials'], $componentType);
            if ($errorBag->errors()->any()) {
                return response()->json(['status' => 422, 'errors' => $errorBag->errors()], 422);
            }

            if (!$this->validateComponentWeightSum($validated['materials'], $newWeight)) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Sum of component quantities must equal weight_per_unit.',
                    'expected_weight' => $newWeight,
                    'total_material_quantity' => collect($validated['materials'])->sum('quantity_required_per_unit'),
                ], 422);
            }

            // Update BOM
            ProductMaterial::where('product_id', $id)->delete();
            $this->createProductMaterials($id, $validated['materials'], $componentType);
        }

        // Remove materials from validated before updating the product
        $productFields = collect($validated)->except('materials')->toArray();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
            $product->save();
        }
        $product->update($productFields);

        return response()->json([
            'status' => 200,
            'message' => 'Product updated.',
            'data' => $product->fresh('productMaterials'),
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
        $year = now()->year;
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

        if (!$setting) {
            return response()->json([
                'status' => 404,
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
                'status' => 422,
                'message' => "No expenses for {$year}-{$month}.",
            ], 422);
        }

        if ($setting->total_production <= 0) {
            return response()->json([
                'status' => 422,
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
                ->sum(function ($m) {
                    return $m->quantity_required_per_unit
                        * $m->rawMaterial->price;
                });

            $costPrice = $rawCost + ($unitExpense * $product->weight_per_unit);
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
                ->sum(function ($m) {
                    return $m->quantity_required_per_unit
                        * $m->semiProduct->price;
                });

            $costPrice = $semiCost + ($unitExpense * $product->weight_per_unit);
            $finalPrice = $costPrice * (1 + $setting->profit_ratio);

            $product->update(['price' => round($finalPrice, 2)]);
        }

        // Collect all updated products to return
        $all = $initialProducts->merge($finalProducts);

        return response()->json([
            'status' => 200,
            'message' => 'Product prices updated successfully.',
            'data' => $all,
        ]);
    }

    public function getComponentTypeFromCategory($category)
    {
        return $category === 'semi_to_finished' ? 'semi_product' : 'raw_material';
    }

    public function validateMaterialComponents(array $materials, string $componentType)
    {
        $errors = Validator::make([], []);

        foreach ($materials as $i => $m) {
            if ($componentType === 'raw_material') {
                if (!RawMaterial::where('raw_material_id', $m['component_id'])->exists()) {
                    $errors->errors()->add("materials.$i." . ($m['component_id']), 'Invalid raw material');
                }
            } else {
                $semiId = $m['component_id'];
                $semi = Product::find($semiId);
                if (!$semi || $semi->category !== 'semi_raw') {
                    $errors->errors()->add("materials.$i." . $m['component_id'], 'Invalid semi-product (must be semi_raw)');
                }
            }
        }

        return $errors;
    }

    public function validateComponentWeightSum(array $materials, float $expectedWeight): bool
    {
        $total = collect($materials)->sum('quantity_required_per_unit');
        return abs($total - $expectedWeight) <= 0.0001;
    }

    public function createProductMaterials(int $productId, array $materials, string $componentType)
    {
        foreach ($materials as $m) {
            ProductMaterial::create([
                'product_id' => $productId,
                'component_type' => $componentType,
                'raw_material_id' => $componentType === 'raw_material' ? $m['component_id'] : null,
                'semi_product_id' => $componentType === 'semi_product' ? $m['component_id'] : null,
                'quantity_required_per_unit' => $m['quantity_required_per_unit'],
            ]);
        }
    }

}
