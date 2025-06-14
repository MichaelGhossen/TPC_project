<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => 'Expenses retrieved successfully',
            'data' => Expense::with('user')->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'employee_salaries' => 'numeric',
            'transportation' => 'numeric',
            'taxes' => 'numeric',
            'utility_bills' => 'numeric',
            'phone_bills' => 'numeric',
            'maintenance' => 'numeric',
            'administrative_costs' => 'numeric',
            'other_costs' => 'numeric',
            'type' => 'required|in:real,estimated'
        ]);

        $expense = Expense::create($data);
        return response()->json([
            'status' => 201,
            'message' => 'Expense created successfully',
            'data' => $expense
        ], 201);
    }

    public function show($id)
    {
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json([
                'status' => 404,
                'message' => 'Expense not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Expense retrieved successfully',
            'data' => $expense
        ]);
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json([
                'status' => 404,
                'message' => 'Expense not found'
            ], 404);
        }

        $data = $request->validate([
            'employee_salaries' => 'numeric',
            'transportation' => 'numeric',
            'taxes' => 'numeric',
            'utility_bills' => 'numeric',
            'phone_bills' => 'numeric',
            'maintenance' => 'numeric',
            'administrative_costs' => 'numeric',
            'other_costs' => 'numeric',
            'type' => 'in:real,estimated'
        ]);

        $expense->update($data);
        return response()->json([
            'status' => 200,
            'message' => 'Expense updated successfully',
            'data' => $expense
        ]);
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json([
                'status' => 404,
                'message' => 'Expense not found'
            ], 404);
        }

        $expense->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Expense deleted successfully'
        ]);
    }
}
