<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductBatch;
use Illuminate\Http\Request;

class ProductPatchController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => ProductBatch::with('product')->get()
        ]);
    }

    // Get one
    public function show($id)
    {
        $batch = ProductBatch::with('product')->find($id);

        if (!$batch) {
            return response()->json(['status' => 404, 'message' => 'Not found'], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $batch
        ]);
    }
}
