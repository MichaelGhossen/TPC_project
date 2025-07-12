<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductSummaryReport;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\ProductSale;
use App\Models\Expense;
use App\Models\ProductionSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class ProductSummaryReportController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => ProductSummaryReport::with('product')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function show($id)
    {
        $report = ProductSummaryReport::with('product')->find($id);
        if (!$report) {
            return response()->json(['status' => 404, 'message' => 'Report not found']);
        }
        return response()->json(['status' => 200, 'data' => $report]);
    }

    public function refreshReport($id)
    {
        $report = ProductSummaryReport::find($id);
        if (!$report) {
            return response()->json(['status' => 404, 'message' => 'Report not found'], 404);
        }

        try {
            DB::beginTransaction();
            $this->applyReportData($report);
            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Report refreshed successfully',
                'data' => $report->fresh()
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to refresh report',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function refreshAllReports()
    {
        $successCount = 0;
        $errorCount = 0;

        ProductSummaryReport::chunk(100, function ($reports) use (&$successCount, &$errorCount) {
            foreach ($reports as $report) {
                try {
                    DB::beginTransaction();
                    $this->applyReportData($report);
                    DB::commit();
                    $successCount++;
                } catch (Exception $e) {
                    DB::rollBack();
                    $errorCount++;
                    Log::error("Failed to refresh report {$report->id}: {$e->getMessage()}");
                }
            }
        });

        return response()->json([
            'status' => 200,
            'message' => 'Reports refresh completed',
            'success_count' => $successCount,
            'error_count' => $errorCount
        ]);
    }

    public function search(Request $request)
    {
        $query = ProductSummaryReport::query()->with('product');

        $filters = [
            'product_id' => 'product_id',
            'type' => 'type',
            'min_profit' => ['net_profit', '>='],
            'max_profit' => ['net_profit', '<='],
            'min_quantity_sold' => ['quantity_sold', '>='],
            'max_quantity_sold' => ['quantity_sold', '<='],
            'min_income' => ['total_income', '>='],
            'max_income' => ['total_income', '<='],
            'min_costs' => ['total_costs', '>='],
            'max_costs' => ['total_costs', '<='],
        ];

        foreach ($filters as $key => $condition) {
            if ($request->filled($key)) {
                is_array($condition)
                    ? $query->where($condition[0], $condition[1], $request->input($key))
                    : $query->where($condition, $request->input($key));
            }
        }

        if ($request->filled('name')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        return response()->json([
            'status' => 200,
            'data' => $query->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function generateSummaryReportForPeriod(string $type, $processDate)
    {
//        [$dataStart, , ,] = $this->getPeriodBoundaries($type, $processDate);
        $expectedCreatedAt = $this->getExpectedCreatedAt($processDate, $type);


        foreach (Product::all() as $product) {
            $reportData = $this->calculateReportData($product, $type, $processDate);

            $existingReport = ProductSummaryReport::where('product_id', $product->product_id)
                ->where('type', $type)
                ->whereDate('created_at', $expectedCreatedAt)
                ->first();

            if ($existingReport) {
                $this->refreshReport($existingReport->report_id);
            } else {
                ProductSummaryReport::create(array_merge([
                    'product_id' => $product->product_id,
                    'type' => $type,
                    'created_at' => $expectedCreatedAt,
                ], $reportData));
            }
        }
        $this->refreshAllReports();
    }

    public function getMonthlyProfit()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->addDay();
        $endOfMonth = Carbon::now()->endOfMonth()->addDay();

        $totalProfit = ProductSummaryReport::where('type', 'daily')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('net_profit');

        return response()->json([
            'status' => 200,
            'month' => $startOfMonth->format('F Y'),
            'total_profit' => $totalProfit
        ]);
    }


    protected function getExpectedCreatedAt(Carbon $date, string $type): Carbon
    {
        return match ($type) {
            'daily' => $date->copy()->addDay()->startOfDay(),
            'monthly' => $date->copy()->addMonth()->startOfDay(),
            'yearly' => $date->copy()->addYear()->startOfDay(),
            default => throw new \InvalidArgumentException("Invalid type: $type")
        };
    }


    protected function applyReportData(ProductSummaryReport $report)
    {
        $product = $report->product;
        if (!$product) {
            throw new Exception("Product not found");
        }

        $data = $this->calculateReportData($product, $report->type, Carbon::parse($report->created_at));
        $report->update($data);
    }

    protected function calculateReportData(Product $product, string $type, Carbon $date): array
    {
        [$dataStart, $dataEnd, $settingsStart, $settingsEnd] = $this->getPeriodBoundaries($type, $date);

        $quantityProduced = ProductBatch::where('product_id', $product->product_id)
            ->whereBetween('created_at', [$dataStart, $dataEnd])
            ->sum('quantity_in');

        $sales = ProductSale::with('productBatch')
            ->where('product_id', $product->product_id)
            ->whereBetween('created_at', [$dataStart, $dataEnd])
            ->get();

        $totalSold = 0;
        $totalIncome = 0;
        $totalCostSold = 0;

        foreach ($sales as $sale) {
            $totalSold += $sale->quantity_sold;
            $totalIncome += $sale->quantity_sold * $sale->unit_price;

            if ($sale->productBatch && $sale->productBatch->quantity_in > 0) {
                $unitCost = $sale->productBatch->real_cost / $sale->productBatch->quantity_in;
                $totalCostSold += $unitCost * $sale->quantity_sold;
            }
        }

        $totalProduction = $this->getTotalProduction($type, $settingsStart, $settingsEnd);

        $estimatedExpenses = Expense::where('type', 'estimated')
            ->whereBetween('created_at', [$settingsStart, $settingsEnd])
            ->sum('amount');

        $realExpenses = Expense::where('type', 'real')
            ->whereBetween('created_at', [$settingsStart, $settingsEnd])
            ->sum('amount');

        if ($type !== 'yearly' && $estimatedExpenses <= 0) {
            $prevMonthStart = $date->copy()->subMonth()->startOfMonth();
            $prevMonthEnd = $date->copy()->subMonth()->endOfMonth();
            $estimatedExpenses = Expense::where('type', 'real')
                ->whereBetween('created_at', [$prevMonthStart, $prevMonthEnd])
                ->sum('amount');
        }

        $scaledEstimated = $totalProduction > 0 ? ($estimatedExpenses / $totalProduction) * $totalSold : 0;
        $scaledActual = $totalProduction > 0 ? ($realExpenses / $totalProduction) * $totalSold : 0;

        $expensesForProfit = $scaledActual > 0 ? $scaledActual : $scaledEstimated;
        $netProfit = $totalIncome - ($totalCostSold + $expensesForProfit);

        return [
            'quantity_produced' => $quantityProduced,
            'quantity_sold' => $totalSold,
            'total_costs' => $totalCostSold,
            'total_estimated_expenses' => $scaledEstimated,
            'total_actual_expenses' => $scaledActual,
            'total_income' => $totalIncome,
            'net_profit' => $netProfit,
        ];
    }

    protected function getPeriodBoundaries($type, $baseDate)
    {
        return [
            'daily' => [
                $baseDate->copy()->startOfDay(),
                $baseDate->copy()->endOfDay(),
                $baseDate->copy()->startOfMonth(),
                $baseDate->copy()->endOfMonth(),
            ],
            'monthly' => [
                $baseDate->copy()->startOfMonth(),
                $baseDate->copy()->endOfMonth(),
                $baseDate->copy()->startOfMonth(),
                $baseDate->copy()->endOfMonth(),
            ],
            'yearly' => [
                $baseDate->copy()->startOfYear(),
                $baseDate->copy()->endOfYear(),
                $baseDate->copy()->startOfYear(),
                $baseDate->copy()->endOfYear(),
            ],
        ][$type];
    }

    public function getTotalProduction($type, $start, $end)
    {
        return $type === 'yearly'
            ? $this->getYearlyProductionTotal($start, $end)
            : $this->getMonthlyProductionSetting($start, $end);
    }

    public function getMonthlyProductionSetting($start, $end)
    {
        $real = ProductionSetting::where('type', 'real')->whereBetween('created_at', [$start, $end])->first();
        if ($real) return $real->total_production;

        $estimated = ProductionSetting::where('type', 'estimated')->whereBetween('created_at', [$start, $end])->first();
        if ($estimated) return $estimated->total_production;

        $fallbackStart = $start->copy()->subMonth();
        $fallbackEnd = $end->copy()->subMonth();
        $fallback = ProductionSetting::where('type', 'real')->whereBetween('created_at', [$fallbackStart, $fallbackEnd])->first();

        return $fallback->total_production ?? 1;
    }

    public function getYearlyProductionTotal($start, $end)
    {
        $settings = ProductionSetting::whereBetween('created_at', [$start, $end])->get();
        return $settings->groupBy(fn($item) => $item->created_at->format('Y-m'))->sum(function ($group) {
            $setting = $group->where('type', 'real')->first() ?? $group->where('type', 'estimated')->first();
            return $setting?->total_production ?? 0;
        }) ?: 1;
    }
}
