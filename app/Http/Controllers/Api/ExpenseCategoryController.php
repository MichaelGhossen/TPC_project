<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 201,
            'data' => ExpenseCategory::all()
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:expense_categories,name|string|max:255',
            'description' => 'nullable|string'
        ]);
        $category = ExpenseCategory::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Created',
            'data' => $category
        ]);
    }

    public function show($id)
    {
        $category = ExpenseCategory::find($id);
        if (!$category) return response()->json(['status' => 404,'message' => 'Not Found'], 404);

        return response()->json([
            'status' => 201,
            'data' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = ExpenseCategory::find($id);
        if (!$category) return response()->json(['status' => 404,'message' => 'Not Found'], 404);

        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update($validated);

        return response()->json(['status' => 201,'message' => 'Updated', 'data' => $category]);
    }

    public function destroy($id)
    {
        $category = ExpenseCategory::find($id);
        if (!$category) return response()->json(['status' => 404,'message' => 'Not Found'], 404);

        $category->delete();

        return response()->json(['status' => 201,'message' => 'Deleted']);
    }
    public function searchByName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $name = $request->input('name');

        $category = ExpenseCategory::where('name', 'like', '%' . $name . '%')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }
}





