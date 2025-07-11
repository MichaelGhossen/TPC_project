<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversion;
use App\Models\RawMaterial;
use App\Models\RawMaterialBatch;
use App\Models\RawMaterialPatch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RawMaterialPatchController extends Controller
{
    // Get all
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => RawMaterialBatch::with('rawMaterial')->get()
        ]);
    }

    // Get one
    public function show($id)
    {
        $batch = RawMaterialBatch::with('rawMaterial')->find($id);

        if (!$batch) {
            return response()->json(['status' => 404, 'message' => 'Not found'], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $batch
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'raw_material_id' => 'required|exists:raw_materials,raw_material_id',
            'quantity_in' => 'required|numeric|min:0',
            'real_cost' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'supplier' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $validated['user_id'] = Auth::id();
        // Auto-set quantity_out = 0, quantity_remaining = quantity_in
        $validated['quantity_out'] = 0;
        $validated['quantity_remaining'] = $validated['quantity_in'];

        // ✅ Use correct model name
        $batch = RawMaterialBatch::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Batch Created Successfully',
            'data' => $batch
        ]);
    }


    // Update
    public function update(Request $request, $id)
    {
        $batch = RawMaterialBatch::find($id);
        $oldQuantityOut = $batch->quantity_out;

        if (!$batch) {
            return response()->json(['status' => 404, 'message' => 'Not found'], 404);
        }

        $validated = $request->validate([
            'quantity_in' => 'sometimes|numeric|min:0',
            'real_cost' => 'sometimes|numeric|min:0',
            'payment_method' => 'sometimes|string|max:50',
            'supplier' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);
        if ($validated['quantity_in'] < $oldQuantityOut) {
            return response()->json([
                'status' => 404,
                'message' => 'Quantity in cannot be less than Quantity out',
                'quantity_out' => $oldQuantityOut,
            ]);
        }
        $validated['quantity_remaining'] = $validated['quantity_in'] - $oldQuantityOut;

        $batch->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Updated',
            'data' => $batch
        ]);
    }

    // Delete
    public function destroy($id)
    {
        $batch = RawMaterialBatch::find($id);

        if (!$batch) {
            return response()->json(['status' => 404, 'message' => 'Not found'], 404);
        }
        $relativeConversions = Conversion::where('raw_material_batch_id', $id)->get();
        if (count($relativeConversions) > 0) {
            return response()->json([
                'status' => 404,
                'message' => 'Cannot delete a batch used in production',
            ]);
        }


        $batch->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted successfully'
        ]);
    }

    public function getByRawMaterialId($raw_material_id)
    {
        $batches = RawMaterialBatch::where('raw_material_id', $raw_material_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'raw_material_id' => $raw_material_id,
            'data' => $batches
        ]);
    }

    public function search(Request $request)
    {
        $query = RawMaterialBatch::with('rawMaterial');

        if ($request->has('name')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('rawMaterial', function ($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->get('name') . '%');
                });
            });
        }

        if ($request->has('raw_material_id')) {
            $query->where('raw_material_id', $request->raw_material_id);
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('payment_method')) {
            $query->where('payment_method', 'like', '%' . $request->payment_method . '%');
        }

        if ($request->has('supplier')) {
            $query->where('supplier', 'like', '%' . $request->supplier . '%');
        }

        if ($request->has('quantity_in_min')) {
            $query->where('quantity_in', '>=', $request->quantity_in_min);
        }

        if ($request->has('quantity_in_max')) {
            $query->where('quantity_in', '<=', $request->quantity_in_max);
        }

        if ($request->has('quantity_remaining_min')) {
            $query->where('quantity_remaining', '>=', $request->quantity_remaining_min);
        }

        if ($request->has('quantity_remaining_max')) {
            $query->where('quantity_remaining', '<=', $request->quantity_remaining_max);
        }

        if ($request->has('real_cost_min')) {
            $query->where('real_cost', '>=', $request->real_cost_min);
        }

        if ($request->has('real_cost_max')) {
            $query->where('real_cost', '<=', $request->real_cost_max);
        }

        $results = $query
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }


}
