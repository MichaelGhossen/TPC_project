<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfitLossReport;
use Illuminate\Http\Request;

class ProfitLossReportController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => ProfitLossReport::with([
                'damagedMaterial.productBatch.product',
                'damagedMaterial.rawMaterialBatch.rawMaterial',
                'productSale.productBatch.product',
            ])->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function show($id)
    {
        $report = ProfitLossReport::with([
            'damagedMaterial.productBatch.product',
            'damagedMaterial.rawMaterialBatch.rawMaterial',
            'productSale.productBatch.product',
        ])->find($id);

        if (!$report) {
            return response()->json([
                'status' => 404,
                'message' => 'Report not found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $report
        ]);
    }

    public function search(Request $request)
    {
        $query = ProfitLossReport::with([
            'damagedMaterial.productBatch.product',
            'damagedMaterial.rawMaterialBatch.rawMaterial',
            'productSale.productBatch.product',
        ]);

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->has('net_profit_loss')) {
            $query->where('net_profit_loss', $request->net_profit_loss);
        }
        if ($request->has('net_profit_loss_min')) {
            $query->where('net_profit_loss', '>=', $request->net_profit_loss_min);
        }

        if ($request->has('net_profit_loss_max')) {
            $query->where('net_profit_loss', '<=', $request->net_profit_loss_max);
        }

        if ($request->has('report_id')) {
            $query->where('report_id', $request->report_id);
        }

        if ($request->has('notes')) {
            $query->where('notes', 'like', '%' . $request->notes . '%');
        }


        if ($request->has('name')) {
            $query->whereHas('damagedMaterial.productBatch.product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            })->orWhereHas('productSale.productBatch.product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            })->orWhereHas('damagedMaterial.rawMaterialBatch.rawMaterial', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        return response()->json([
            'status' => 200,
            'data' => $query->orderBy('created_at', 'desc')->get()
        ]);
    }
}
