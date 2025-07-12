<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\ProductSale;
use App\Models\ProfitLossReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSaleController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => ProductSale::with('product', 'productBatch')
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    public function show($id)
    {
        $productSale = ProductSale::with('product', 'productBatch')->find($id);
        if (!$productSale) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Sale Not Found'
            ]);
        }
        return response()->json([
            'status' => 200,
            'data' => $productSale
        ]);
    }

    private function adjustBatchQuantity(ProductBatch $batch, float $qty, bool $increment = false)
    {
        if ($increment) {
            $batch->increment('quantity_remaining', $qty);
            $batch->decrement('quantity_out', $qty);
        } else {
            $batch->decrement('quantity_remaining', $qty);
            $batch->increment('quantity_out', $qty);
        }
    }

    private function calculateProfit(float $unit_price, float $qty_sold, float $costPerUnit): array
    {
        $revenue = $unit_price * $qty_sold;
        $cost = $costPerUnit * $qty_sold;
        $netProfit = $revenue - $cost;
        $type = $netProfit >= 0 ? 'profit' : 'loss';

        return [
            'net_profit' => round($netProfit, 2),
            'type' => $type,
            'revenue' => $revenue,
            'cost' => $cost,
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'product_batch_id' => 'required|exists:product_batches,product_batch_id',
            'quantity_sold' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
            'customer' => 'nullable|string',
        ]);

        $batch = ProductBatch::where('product_batch_id', $validated['product_batch_id'])->where('product_id', $validated['product_id'])->first();
        if (!$batch) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Batch Not Found'
            ]);
        }

        if ($batch->quantity_remaining < $validated['quantity_sold']) {
            return response()->json([
                'status' => 422,
                'message' => 'Not enough quantity remaining in the batch.',
                'available' => $batch->quantity_remaining,
            ], 422);
        }

        DB::beginTransaction();
        try {
            $this->adjustBatchQuantity($batch, $validated['quantity_sold']);
            $costPerUnit = $batch->real_cost / $batch->quantity_in;
            $profit = $this->calculateProfit($validated['unit_price'], $validated['quantity_sold'], $costPerUnit);

            $sale = ProductSale::create([
                'user_id' => Auth::id(),
                'product_id' => $validated['product_id'],
                'product_batch_id' => $validated['product_batch_id'],
                'quantity_sold' => $validated['quantity_sold'],
                'unit_price' => $validated['unit_price'],
                'revenue' => $profit['revenue'],
                'customer' => $validated['customer'] ?? null,
                'net_profit' => $profit['net_profit'],
            ]);

            ProfitLossReport::create([
                'product_sale_id' => $sale->product_sale_id,
                'type' => $profit['type'],
                'net_profit_loss' => $profit['net_profit'],
                'notes' => 'Generated from product sale ID ' . $sale->product_sale_id,
            ]);

            DB::commit();

            return response()->json([
                'status' => 201,
                'message' => 'Sale recorded successfully.',
                'data' => $sale->load('product', 'productBatch')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to record sale: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)  //changing product id not valid(in this case delete the sale and make new one)
    {
        $sale = ProductSale::find($id);
        if (!$sale) {
            return response()->json(['status' => 404, 'message' => 'Sale not found'], 404);
        }
        if ($request->has('product_id')) {
            $productChanged = $sale->product_id != $request->input('product_id');
            if ($productChanged) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Product cannot be modified.',
                ]);
            }
        }

        $validated = $request->validate([
            'product_batch_id' => 'sometimes|exists:product_batches,product_batch_id',
            'quantity_sold' => 'sometimes|numeric|min:0.0001',
            'unit_price' => 'sometimes|numeric|min:0',
            'customer' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $this->adjustBatchQuantity($sale->productBatch, $sale->quantity_sold, true);

            $sale->fill($validated);
            $batch = ProductBatch::where('product_batch_id', $sale->product_batch_id)->where('product_id', $sale->product_id)->first();
            if (!$batch) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Product Batch Not Found'
                ]);
            }

            if ($batch->quantity_remaining < $sale->quantity_sold) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Not enough quantity remaining in the batch.',
                    'available' => $batch->quantity_remaining,
                ], 422);
            }

            $this->adjustBatchQuantity($batch, $sale->quantity_sold);

            $costPerUnit = $batch->real_cost / $batch->quantity_in;
            $profit = $this->calculateProfit($sale->unit_price, $sale->quantity_sold, $costPerUnit);

            $sale->net_profit = $profit['net_profit'];
            $sale->revenue = $profit['revenue'];
            $sale->save();

            ProfitLossReport::updateOrCreate(
                ['product_sale_id' => $sale->product_sale_id],
                [
                    'type' => $profit['type'],
                    'net_profit_loss' => $profit['net_profit'],
                    'notes' => 'Updated from product sale ID ' . $sale->product_sale_id,
                ]
            );

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Sale updated successfully.',
                'data' => $sale->load('product', 'productBatch')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update sale: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $sale = ProductSale::find($id);
        if (!$sale) {
            return response()->json(['status' => 404, 'message' => 'Sale not found'], 404);
        }

        DB::beginTransaction();
        try {
            $this->adjustBatchQuantity($sale->productBatch, $sale->quantity_sold, true);

            ProfitLossReport::where('product_sale_id', $sale->product_sale_id)->delete();
            $sale->delete();

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Sale deleted successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete sale: ' . $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $query = ProductSale::with('product', 'productBatch');

        if ($request->has('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->has('name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->has('customer')) {
            $query->where('customer', 'like', '%' . $request->customer . '%');
        }

        if ($request->has('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->has('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->has('min_price')) {
            $query->where('unit_price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('unit_price', '<=', $request->max_price);
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->has('type')) {
            $query->whereHas('profitLossReport', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        return response()->json([
            'status' => 200,
            'data' => $query->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function getByProductId($productId)
    {
        $query = ProductSale::with('product')->where('product_id', $productId)->get();
        return response()->json([
            'status' => 200,
            'data' => $query
        ]);
    }

    public function getByProductBatchId($productBatchId)
    {
        $query = ProductSale::with('product')->where('product_batch_id', $productBatchId)->get();
        return response()->json([
            'status' => 200,
            'data' => $query
        ]);
    }

    public function getMonthlySales()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        $currentMonthSales = ProductSale::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth);

        $totalSales = $currentMonthSales->sum('revenue');
        $totalProfit_loss = $currentMonthSales->sum('net_profit');

        return response()->json([
            'status' => 200,
            'total_sales' => $totalSales,
            'total_profit_loss' => $totalProfit_loss,
        ]);
    }
}
