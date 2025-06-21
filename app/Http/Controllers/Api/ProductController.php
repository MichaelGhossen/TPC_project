<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
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

    // Store (❌ no price here)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'category' => 'required|in:semi_finished,finished',
            'weight_per_unit' => 'required|numeric|min:0',
            'minimum_stock_alert' => 'required|integer|min:0'
        ]);

        $product = Product::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Product created',
            'data' => $product
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

}
