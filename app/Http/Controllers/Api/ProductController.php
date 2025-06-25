<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Product;
use App\Models\ProductionSetting;
use App\Models\ProductMaterial;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get all
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Product::all()
        ]);
    }

    // Get one
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $product
        ]);
    }

    public function store(Request $request)
    {
        // Step 1: Validate product and materials (BOM) together
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'category' => 'required|in:semi_finished,finished',
            'weight_per_unit' => 'required|numeric|min:0',
            'minimum_stock_alert' => 'required|integer|min:0',
            'materials' => 'required|array|min:1',
            'materials.*.raw_material_id' => 'required|exists:raw_materials,raw_material_id|distinct',
            'materials.*.quantity_required_per_unit' => 'required|numeric|min:0.001',
        ]);

        // Step 2: Validate total material weight equals product weight
        $totalMaterialWeight = collect($validated['materials'])->sum('quantity_required_per_unit');
        if (abs($totalMaterialWeight - $validated['weight_per_unit']) > 0.0001) {
            return response()->json([
                'status' => 422,
                'message' => 'Sum of raw material quantities must equal product weight per unit.',
                'difference' => $validated['weight_per_unit'] - $totalMaterialWeight
            ], 422);
        }

        // Step 3: Create the product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'weight_per_unit' => $validated['weight_per_unit'],
            'minimum_stock_alert' => $validated['minimum_stock_alert']
        ]);

        // Step 4: Add product materials
        foreach ($validated['materials'] as $material) {
            // Check for duplicate material entries (optional, since new product is unique)
            ProductMaterial::create([
                'product_id' => $product->product_id,
                'raw_material_id' => $material['raw_material_id'],
                'quantity_required_per_unit' => $material['quantity_required_per_unit']
            ]);
        }

        return response()->json([
            'status' => 201,
            'message' => 'Product and BOM created successfully.',
            'data' => $product->load('product_materials') // assuming a `materials` relationship
        ]);
    }


    // Update (❌ no price update allowed)
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:products,name,' . $id . ',product_id',
            'description' => 'nullable|string',
            'category' => 'sometimes|in:semi_finished,finished',
            'weight_per_unit' => 'sometimes|numeric|min:0',
            'minimum_stock_alert' => 'sometimes|integer|min:0'
        ]);

        $product->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Product updated',
            'data' => $product
        ]);
    }

    // Delete
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Product deleted'
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
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Step 1: Get production setting for current year/month preferring 'real'
        $setting = ProductionSetting::where('type', 'real')
            ->where('year', $currentYear)
            ->where('month', $currentMonth)
            ->first();

        if (!$setting) {
            $setting = ProductionSetting::where('type', 'estimated')
                ->where('year', $currentYear)
                ->where('month', $currentMonth)
                ->first();
        }

        if (!$setting) {
            return response()->json([
                'status' => 404,
                'message' => "No production settings found for {$currentYear}-{$currentMonth} (real or estimated). Please add them before updating prices."
            ], 404);
        }

        // Step 2: Get expenses for current year/month preferring 'real'
        $expenses = Expense::where('type', 'real')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('amount');

        if ($expenses == 0) {
            // fallback to estimated if no real expenses found
            $expenses = Expense::where('type', 'estimated')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->sum('amount');

            if ($expenses == 0) {
                return response()->json([
                    'status' => 422,
                    'message' => "No expenses found for {$currentYear}-{$currentMonth} (real or estimated). Please add expenses before updating prices."
                ], 422);
            }
        }

        if ($setting->total_production == 0) {
            return response()->json([
                'status' => 422,
                'message' => 'Total production cannot be zero.'
            ], 422);
        }

        // Step 3: Calculate unit expense and update product prices
        $unitExpense = $expenses / $setting->total_production;

        $products = Product::get();

        foreach ($products as $product) {
            $rawCost = 0;
            $product_materials = ProductMaterial::where('product_id',$product->product_id)->get();
            foreach ($product_materials as $product_material) {
                $rawMaterial  = RawMaterial::where('raw_material_id',$product_material->raw_material_id)->get()->first();
                $rawMaterialPrice = $rawMaterial->price;
                $rawCost += $product_material->quantity_required_per_unit * $rawMaterialPrice;
            }

            $costPrice = $rawCost + ($unitExpense * $product->weight_per_unit);
            $finalPrice = $costPrice * (1 + $setting->profit_ratio);

            $product->price = round($finalPrice, 2);
            $product->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Product prices updated successfully',
            'data' => $products
        ]);
    }

}
