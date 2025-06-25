<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductionSetting;
use Illuminate\Validation\Rule;

class ProductionSettingController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => ProductionSetting::orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_production' => 'required|numeric|min:0.01',
            'type' => ['required', Rule::in(['real', 'estimated'])],
            'profit_ratio' => 'required|numeric|min:0|max:1',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
            'notes' => 'nullable|string',
        ]);
        if (ProductionSetting::where('month', $validated['month'])
            ->where('year', $validated['year'])
            ->where('type', $validated['type'])
            ->exists()) {

            return response()->json([
                'status' => 422,
                'message' => 'You already submitted settings for this month and type.',
            ], 422);
        }


        $setting = ProductionSetting::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Production setting created',
            'data' => $setting
        ]);
    }

    public function show($id)
    {
        $setting = ProductionSetting::find($id);
        if (!$setting) {
            return response()->json(['status' => 404, 'message' => 'Not Found'], 404);
        }
        return response()->json([
            'status' => 200,
            'data' => $setting
        ]);
    }

    public function update(Request $request, $id)
    {
        $setting = ProductionSetting::find($id);
        if (!$setting) {
            return response()->json(['status' => 404, 'message' => 'Not Found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'total_production' => 'sometimes|numeric|min:0.01',
            'type' => ['sometimes', Rule::in(['real', 'estimated'])],
            'profit_ratio' => 'sometimes|numeric|min:0|max:1',
            'month' => 'sometimes|integer|min:1|max:12',
            'year' => 'sometimes|integer|min:2000|max:2100',
            'notes' => 'nullable|string',
        ]);

        $setting->update($validated);

        return response()->json([
            'status' => 200,
            'message' => 'Production setting updated',
            'data' => $setting
        ]);
    }

    public function destroy($id)
    {
        $setting = ProductionSetting::find($id);
        if (!$setting) {
            return response()->json(['status' => 404, 'message' => 'Not Found'], 404);
        }
        $setting->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Production setting deleted'
        ]);
    }

    public function getByMonth(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'month' => 'required|integer|min:1|max:12'
        ]);

        $settings = ProductionSetting::where('year', $validated['year'])
            ->where('month', $validated['month'])
            ->get();

        if ($settings->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No settings found for this month and year.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $settings
        ]);
    }
}


