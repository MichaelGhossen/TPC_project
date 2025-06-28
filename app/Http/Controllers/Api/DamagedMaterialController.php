<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DamagedMaterial;
use App\Models\ProfitLossReport;
use App\Models\ProductBatch;
use App\Models\RawMaterialBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DamagedMaterialController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => DamagedMaterial::with(['rawMaterialBatch.rawMaterial', 'productBatch.product'])
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    public function show($id)
    {
        $damaged = DamagedMaterial::with(['rawMaterialBatch.rawMaterial', 'productBatch.product'])->find($id);
        if (!$damaged) {
            return response()->json(['status' => 404, 'message' => 'Damaged Material Not Found']);
        }
        return response()->json(['status' => 200, 'data' => $damaged]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric|min:0.0001',
            'notes' => 'nullable|string',
            'product_batch_id' => 'nullable|exists:product_batches,product_batch_id',
            'raw_material_batch_id' => 'nullable|exists:raw_material_batches,raw_material_batch_id',
        ]);

        // Automatically determine the material type
        $materialType = 'product';
        if (!empty($validated['raw_material_batch_id'])) {
            $materialType = 'raw';
        } elseif (!empty($validated['product_batch_id'])) {
            $batch = ProductBatch::find($validated['product_batch_id']);
            $materialType = $batch->product->category === 'semi_raw' ? 'semi' : 'product';
        }

        DB::beginTransaction();
        try {
            $batch = null;
            $lostCost = 0;

            if ($materialType === 'raw') {
                $batch = RawMaterialBatch::findOrFail($validated['raw_material_batch_id']);
            } else {
                $batch = ProductBatch::findOrFail($validated['product_batch_id']);
            }

            if ($batch->quantity_remaining < $validated['quantity']) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Not enough quantity in batch.',
                    'available' => $batch->quantity_remaining
                ], 422);
            }

            $batch->decrement('quantity_remaining', $validated['quantity']);
            $batch->increment('quantity_out', $validated['quantity']);

            $unitCost = $batch->real_cost / $batch->quantity_in;
            $lostCost = $unitCost * $validated['quantity'];

            $damaged = DamagedMaterial::create([
                'user_id' => Auth::id(),
                'product_batch_id' => $validated['product_batch_id'] ?? null,
                'raw_material_batch_id' => $validated['raw_material_batch_id'] ?? null,
                'quantity' => $validated['quantity'],
                'material_type' => $materialType,
                'notes' => $validated['notes'] ?? null,
                'lost_cost' => round($lostCost, 2),
            ]);

            ProfitLossReport::create([
                'damaged_material_id' => $damaged->damaged_material_id,
                'type' => 'loss',
                'net_profit_loss' => round($lostCost, 2),
                'notes' => 'Damage loss recorded for material ID ' . $damaged->damaged_material_id
            ]);

            DB::commit();

            return response()->json(['status' => 201, 'message' => 'Damage recorded.', 'data' => $damaged]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $damaged = DamagedMaterial::find($id);
        if (!$damaged) {
            return response()->json(['status' => 404, 'message' => 'Damage not found']);
        }

        $validated = $request->validate([
            'quantity' => 'sometimes|numeric|min:0.0001',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $oldQty = $damaged->quantity;
            $batch = $damaged->material_type === 'raw'
                ? RawMaterialBatch::find($damaged->raw_material_batch_id)
                : ProductBatch::find($damaged->product_batch_id);

            $batch->increment('quantity_remaining', $oldQty);
            $batch->decrement('quantity_out', $oldQty);


            if (isset($validated['quantity']) && $batch->quantity_remaining < $validated['quantity']) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Not enough quantity in batch for update.',
                    'available' => $batch->quantity_remaining
                ], 422);
            }

            $newQty = $validated['quantity'] ?? $oldQty;
            $batch->decrement('quantity_remaining', $newQty);
            $batch->increment('quantity_out', $newQty);
            $unitCost = $batch->real_cost / $batch->quantity_in;
            $lostCost = $unitCost * $newQty;

            $damaged->quantity = $newQty;
            $damaged->notes = $validated['notes'] ?? $damaged->notes;
            $damaged->lost_cost = round($lostCost, 2);
            $damaged->save();

            ProfitLossReport::updateOrCreate(
                ['damaged_material_id' => $damaged->damaged_material_id],
                [
                    'type' => 'loss',
                    'net_profit_loss' => round($lostCost, 2),
                    'notes' => 'Updated damage report for material ID ' . $damaged->damaged_material_id
                ]
            );

            DB::commit();

            return response()->json(['status' => 200, 'message' => 'Damage updated.', 'data' => $damaged]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $damaged = DamagedMaterial::find($id);
        if (!$damaged) {
            return response()->json(['status' => 404, 'message' => 'Damage not found']);
        }

        DB::beginTransaction();
        try {
            $batch = $damaged->material_type === 'raw'
                ? RawMaterialBatch::find($damaged->raw_material_batch_id)
                : ProductBatch::find($damaged->product_batch_id);

            $batch->increment('quantity_remaining', $damaged->quantity);
            $batch->decrement('quantity_out', $damaged->quantity);

            ProfitLossReport::where('damaged_material_id', $damaged->damaged_material_id)->delete();
            $damaged->delete();

            DB::commit();

            return response()->json(['status' => 200, 'message' => 'Damage deleted.']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $query = DamagedMaterial::with(['rawMaterialBatch.rawMaterial', 'productBatch.product']);

        if ($request->has('material_type')) {
            $query->where('material_type', $request->material_type);
        }
        if ($request->has('notes')) {
            $query->where('notes', 'like', '%' . $request->notes . '%');
        }
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->has('product_name')) {
            $query->whereHas('productBatch.product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->product_name . '%');
            });
        }
        if ($request->has('raw_material_name')) {
            $query->whereHas('rawMaterialBatch.rawMaterial', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->raw_material_name . '%');
            });
        }

        return response()->json([
            'status' => 200,
            'data' => $query->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function getByProductId($productId)
    {
        $damaged = DamagedMaterial::whereHas('productBatch', function ($q) use ($productId) {
            $q->where('product_id', $productId);
        })->with(['productBatch.product'])->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $damaged,
        ]);
    }

    public function getByRawMaterialId($rawMaterialId)
    {
        $damaged = DamagedMaterial::whereHas('rawMaterialBatch', function ($q) use ($rawMaterialId) {
            $q->where('raw_material_id', $rawMaterialId);
        })->with(['rawMaterialBatch.rawMaterial'])->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $damaged,
        ]);
    }
}
