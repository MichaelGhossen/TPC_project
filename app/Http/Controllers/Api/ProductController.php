<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;class ProductController extends Controller
{

    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => 'Products retrieved successfully',
            'data' => Product::with('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 403, 'message' => 'You are not authorized'], 403);
        }

        $data = $request->validate([
            'name_id' => 'required|exists:names,id',
            'category' => 'required|in:factory,half_factory',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'real_cost' => 'nullable|numeric',
            'estimated_cost' => 'nullable|numeric',
            'bom' => 'nullable|array',
            'bom.*' => 'exists:names,id',
            'production_date' => 'nullable|date',
            'user_id' => 'nullable|exists:users,id'
        ]);

        $product = Product::create($data);

        return response()->json([
            'status' => 201,
            'message' => 'Product created successfully',
            'data' => $product
        ]);
    }

    public function show($id)
    {
        $product = Product::with('name')->find($id);
        if (!$product) {
            return response()->json(['status' => 404, 'message' => 'Product not found'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Product retrieved successfully',
            'data' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 403, 'message' => 'You are not authorized'], 403);
        }

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['status' => 404, 'message' => 'Product not found'], 404);
        }

        $data = $request->validate([
            'name_id' => 'sometimes|exists:names,id',
            'category' => 'in:factory,half_factory',
            'quantity' => 'numeric',
            'price' => 'numeric',
            'real_cost' => 'nullable|numeric',
            'estimated_cost' => 'nullable|numeric',
            'bom' => 'nullable|array',
            'bom.*' => 'exists:names,id',
            'production_date' => 'nullable|date',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $product->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 403, 'message' => 'You are not authorized'], 403);
        }

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['status' => 404, 'message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Product deleted successfully'
        ]);
    }
}
