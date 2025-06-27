<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversion;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Conversion::with(['outputProductBatch.product', 'inputProductBatch.product', 'rawMaterialBatch.rawMaterial'])
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }

    public function show($id)
    {
        $item = Conversion::with(['outputProductBatch.product', 'inputProductBatch.product', 'rawMaterialBatch.rawMaterial'])
            ->find($id);
        if (!$item) {
            return response()->json(['status' => 404, 'message' => 'Batch Not found'], 404);
        }
        return response()->json(['status' => 200, 'data' => $item]);
    }

    public function getByProductBatchID($productBatchID)
    {
        return response()->json([
            'status' => 200,
            'data' => Conversion::where('output_product_batch_id', $productBatchID)
                ->with(['outputProductBatch.product', 'inputProductBatch.product', 'rawMaterialBatch.rawMaterial'])
                ->get(),
        ]);
    }

    public function search(Request $request)
    {
        $query = Conversion::with([
            'outputProductBatch.product',
            'inputProductBatch.product',
            'rawMaterialBatch.rawMaterial',
        ]);

        if ($request->has('batch_type')) {
            $query->where('batch_type', $request->batch_type);
        }

        if ($request->has('raw_material_batch_id')) {
            $query->where('raw_material_batch_id', $request->raw_material_batch_id);
        }

        if ($request->has('input_product_batch_id')) {
            $query->where('input_product_batch_id', $request->input_product_batch_id);
        }

        if ($request->has('output_product_batch_id')) {
            $query->where('output_product_batch_id', $request->output_product_batch_id);
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // 🔍 Filter by component/product name
        if ($request->has('name')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('rawMaterialBatch.rawMaterial', function ($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->name . '%');
                })->orWhereHas('inputProductBatch.product', function ($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->name . '%');
                })->orWhereHas('outputProductBatch.product', function ($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->name . '%');
                });
            });
        }

        return response()->json([
            'status' => 200,
            'data' => $query->orderBy('created_at', 'desc')->get(),
        ]);
    }


}
