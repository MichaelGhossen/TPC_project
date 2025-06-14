<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => 'All products retrieved successfully',
            'data' => Product::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'weight_per_unit' => 'nullable|numeric',
            'minimum_stock_alert' => 'nullable|integer',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

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
            'message' => 'Product retrieved successfully',
            'data' => $product
        ]);
    }

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
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'weight_per_unit' => 'nullable|numeric',
            'minimum_stock_alert' => 'nullable|integer',
        ]);

        $product->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

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
            'message' => 'Product deleted successfully'
        ]);
    }
    public function search(Request $request)
    {
        $keyword = $request->input('name');

        if (!$keyword) {
            return response()->json([
                'status' => 400,
                'message' => 'Search keyword (name) is required.'
            ], 400);
        }

        $products = Product::where('name', 'LIKE', "%{$keyword}%")->get();

        return response()->json([
            'status' => 200,
            'message' => 'Search results',
            'data' => $products
        ]);
    }
}
