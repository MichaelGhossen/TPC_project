<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Expense::orderBy('created_at', 'desc')->get()
        ]);
    }

    // POST create new expense
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,expense_category_id',
            'type' => 'required|in:real,estimated',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $count = Expense::where('type', $validated['type'])
            ->where('expense_category_id', $validated['expense_category_id'])
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        if ($count >= 1) {
            return response()->json([
                'status' => 403,
                'message' => 'Only one entry allowed per type per month.'
            ], 403);
        }

        $expense = Expense::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Expense created',
            'data' => $expense
        ]);
    }

    // GET specific expense
    public function show($id)
    {
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json(['status' => 404, 'message' => 'Not Found'], 404);
        }
        return response()->json(['status' => 200, 'data' => $expense]);
    }

    // PUT update expense
    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        if (!$expense) return response()->json(['status' => 404, 'message' => 'Not Found'], 404);

        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $expense->update($validated);

        return response()->json(['status' => 200, 'message' => 'Updated', 'data' => $expense]);
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        if (!$expense) return response()->json(['status' => 404, 'message' => 'Not Found'], 404);

        $expense->delete();

        return response()->json(['status' => 200, 'message' => 'Deleted']);
    }

    public function getByMonth(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'month' => 'required|integer|min:1|max:12'
        ]);

        $expenses = Expense::whereYear('created_at', $validated['year'])
            ->whereMonth('created_at', $validated['month'])
            ->get();

        return response()->json([
            'status' => 200,
            'year' => $validated['year'],
            'month' => $validated['month'],
            'data' => $expenses,
            'total real expenses' => round($expenses->where('type', 'real')->sum('amount'), 2),
            'total estimated expenses' => round($expenses->where('type', 'estimated')->sum('amount'), 2)
        ]);
    }

    public function searchByCategoryName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $name = $request->input('name');

        $expenses = Expense::with('category')
            ->whereHas('category', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $expenses
        ]);
    }

    function getByCategoryId($id)
    {
        $expenses = Expense::where('expense_category_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $expenses
        ]);
    }

}
