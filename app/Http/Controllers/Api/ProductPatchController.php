<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversion;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\ProductMaterial;
use App\Models\RawMaterialBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductPatchController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => ProductBatch::with('product')
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

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

    public function getByProductId($productId)
    {
        $batches = ProductBatch::where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'product_id' => $productId,
            'data' => $batches
        ]);
    }

    public function search(Request $request)
    {
        $query = ProductBatch::with('product');

        if ($request->has('name')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('product', function ($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->name . '%');
                });
            });
        }

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
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

        $results = $query
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity_in' => 'required|numeric|min:1',
            'notes' => 'nullable|string',
            'status' => 'required|in:ready,needs_reproduction',
            'reproduction_count' => 'nullable|integer|min:0',
        ]);

        $userId = Auth::id();
        $product = Product::find($validated['product_id']);
        if (!$product) {
            return response()->json(['status' => 404, 'message' => 'Product Not found'], 404);
        }

        $qtyInKg = $validated['quantity_in'];
        $weightPerUnit = $product->weight_per_unit;
        $unitsProduced = $qtyInKg / $weightPerUnit;

        DB::beginTransaction();
        try {
            $batch = ProductBatch::create([
                'user_id' => $userId,
                'product_id' => $product->product_id,
                'quantity_in' => $qtyInKg,
                'quantity_out' => 0,
                'quantity_remaining' => $qtyInKg,
                'real_cost' => 0,
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status'] ?? 'ready',
                'reproduction_count' => $validated['reproduction_count'] ?? 0,
            ]);

            $totalCost = $this->allocateMaterials($product, $batch, $unitsProduced);
            $batch->real_cost = $totalCost;
            $batch->save();

            DB::commit();

            return response()->json([
                'status' => 201,
                'message' => 'Product batch created (kg → units) and materials allocated.',
                'data' => $batch->load('product','conversion'),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 422,
                'message' => 'Batch creation failed: ' . $e->getMessage(),
            ], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $batch = ProductBatch::find($id);

        if (!$batch) {
            return response()->json(['status' => 404, 'message' => 'Product batch not found'], 404);
        }

        $validated = $request->validate([
            'quantity_in' => 'sometimes|numeric|min:1',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:ready,needs_reproduction',
            'reproduction_count' => 'nullable|integer|min:0',
        ]);

        $originalQtyIn = $batch->quantity_in;
        $originalQtyOut = $batch->quantity_out;
        $newQtyIn = $validated['quantity_in'] ?? $batch->quantity_in;
        if ($newQtyIn < $originalQtyOut) {
            return response()->json([
                "status" => 422,
                'message' => 'Quantity in cannot be less that quantity out',
                'quantity_out' => $originalQtyOut,
            ]);
        }

        $product = $batch->product;
        $weightPerUnit = $product->weight_per_unit;
        $unitsProduced = $newQtyIn / $weightPerUnit;

        DB::beginTransaction();
        try {
            if (isset($validated['quantity_in']) && $newQtyIn != $originalQtyIn) {
                $this->resetPreviousConversions($batch);
                $totalCost = $this->allocateMaterials($product, $batch, $unitsProduced);

                $batch->real_cost = $totalCost;
                $batch->quantity_in = $newQtyIn;
                $batch->quantity_remaining = $newQtyIn - $originalQtyOut;
            }

            $batch->notes = $validated['notes'] ?? $batch->notes;
            $batch->status = $validated['status'] ?? $batch->status;
            $batch->reproduction_count = $validated['reproduction_count'] ?? $batch->reproduction_count;

            $batch->save();

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Product batch updated successfully.',
                'data' => $batch->load('product','conversion'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 422,
                'message' => 'Batch update failed: ' . $e->getMessage(),
            ], 422);
        }
    }

    public function destroy($id)
    {
        $batch = ProductBatch::find($id);

        if (!$batch) {
            return response()->json(['status' => 404, 'message' => 'Product batch not found'], 404);
        }

        $relativeConversions = Conversion::where('input_product_batch_id',$batch->product_batch_id)->get();
        if (count($relativeConversions) > 0) {
            return response()->json([
                'status' => 404,
                'message' => 'Cannot delete a batch used in production',
            ]);
        }

        DB::beginTransaction();
        try {
            // Revert and delete all related conversions
            $this->resetPreviousConversions($batch);

            $batch->delete();

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Product batch deleted successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 422,
                'message' => 'Batch deletion failed: ' . $e->getMessage(),
            ], 422);
        }
    }

    private function allocateMaterials(Product $product, ProductBatch $targetBatch, float $unitsProduced): float
    {
        $totalCost = 0;
        $componentType = $product->category === 'semi_to_finished' ? 'semi_product' : 'raw_material';

        foreach ($product->productMaterials as $item) {
            $neededQty = $unitsProduced * $item->quantity_required_per_unit;

            $sourceModel = $componentType === 'raw_material'
                ? RawMaterialBatch::class
                : ProductBatch::class;

            $column = $componentType === 'raw_material'
                ? 'raw_material_id'
                : 'product_id';

            $componentId = $item->{$componentType . '_id'};

            $sourceBatches = $sourceModel::where($column, $componentId)
                ->where('quantity_remaining', '>', 0)
                ->when($componentType === 'semi_product', fn($q) => $q->where('status', 'ready'))
                ->orderBy('created_at', 'asc')
                ->get();

            foreach ($sourceBatches as $src) {
                if ($neededQty <= 0) break;

                $take = min($src->quantity_remaining, $neededQty);
                $src->increment('quantity_out', $take);
                $src->decrement('quantity_remaining', $take);

                $unitCost = $src->real_cost / $src->quantity_in;
                $totalCost += $take * $unitCost;
                $neededQty -= $take;

                Conversion::create([
                    'raw_material_batch_id' => $componentType === 'raw_material' ? $src->raw_material_batch_id : null,
                    'input_product_batch_id' => $componentType === 'semi_product' ? $src->product_batch_id : null,
                    'output_product_batch_id' => $targetBatch->product_batch_id,
                    'batch_type' => $componentType,
                    'quantity_used' => $take,
                    'cost' => $take * $unitCost,
                ]);
            }

            if ($neededQty > 0) {
                throw new \Exception("Insufficient stock for component ID {$componentId}");
            }
        }

        return round($totalCost, 2);
    }

    private function resetPreviousConversions(ProductBatch $batch)
    {
        $conversions = Conversion::where('output_product_batch_id', $batch->product_batch_id)->get();

        foreach ($conversions as $conv) {
            $sourceBatch = null;

            if ($conv->batch_type === 'raw_material') {
                $sourceBatch = RawMaterialBatch::find($conv->raw_material_batch_id);
            } elseif ($conv->batch_type === 'semi_product') {
                $sourceBatch = ProductBatch::find($conv->input_product_batch_id);
            }

            if ($sourceBatch) {
                $sourceBatch->decrement('quantity_out', $conv->quantity_used);
                $sourceBatch->increment('quantity_remaining', $conv->quantity_used);
            }

            $conv->delete();
        }
    }
}
