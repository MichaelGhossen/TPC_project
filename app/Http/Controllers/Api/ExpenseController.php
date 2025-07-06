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
{ public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Expense::all()
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
            'user_id' => 'required|exists:users,id'
        ]);

        $currentMonth = Carbon::now()->format('Y-m');

        $count = Expense::where('user_id', $validated['user_id'])
            ->where('type', $validated['type'])
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        if ($count >= 1) {
            return response()->json([
                'status' => 403,
                'message' => 'Only one entries allowed per type per month.'
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
            'expense_category_id' => 'sometimes|exists:expense_categories,expense_category_id',
            'amount' => 'sometimes|numeric|min:0',
            'notes' => 'nullable|string'
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
            'total real expenses' => round($expenses->where('type','real')->sum('amount'),2),
            'total estimated expenses' => round($expenses->where('type','estimated')->sum('amount'),2)
        ]);
    }

}
