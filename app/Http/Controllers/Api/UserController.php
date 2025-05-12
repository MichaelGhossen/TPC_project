<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'message' => 'User get successfully',
            'user' => $user,
            'status'=>'200'
        ], 200);
    }
    public function update(Request $request, $id)
{
    $authUser = $request->user();

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found',
        'status'=>'404'
    ], 404);
    }


    $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'phone' => 'nullable|string|max:20',
        'user_role' => ['required', Rule::in(['admin', 'accountant', 'warehouse_keeper'])],
        'password' => 'nullable|string|min:6',
    ]);

    $user->name = $request->get('name');
    $user->email = $request->get('email');
    $user->phone = $request->get('phone');
    $user->user_role = $request->get('user_role');

    if ($request->filled('password')) {
        $user->password = Hash::make($request->get('password'));
    }

    $user->save();

    return response()->json([
        'message' => 'User updated successfully',
        'user' => $user,
        'status'=>'200'
    ], 200);
}
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully',
        'status'=>'200'
    ], 200);
    }

    public function showAllUsers(Request $request)
{
    $authUser = $request->user();

    // Allow only admin to view all users
    if (!$authUser || $authUser->user_role !== 'admin') {
        return response()->json(['message' => 'Unauthorized',
        'status'=>'403'
    ], 403);
    }

    $users =User::all();

    return response()->json([
        'message' => 'All users retrieved successfully',
        'users' => $users,
        'status'=>'200'
    ],200);
}


public function updateUserById(Request $request, $id)
{
    $authUser = $request->user();

    // Only admin can perform this action
    if (!$authUser || $authUser->user_role !== 'admin') {
        return response()->json(['message' => 'Unauthorized – admin only',
        'status'=>'403'
    ], 403);
    }

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found',
        'status'=>'404'
    ], 404);
    }

    $validated = $request->validate([
        'name'       => 'required|string|max:255',
        'email'      => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'phone'      => 'nullable|string|max:20',
        'user_role'  => ['required', Rule::in(['admin', 'accountant', 'warehouse_keeper'])],
        'password'   => 'nullable|string|min:6',
    ]);

    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->phone = $validated['phone'] ?? $user->phone;
    $user->user_role = $validated['user_role'];

    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return response()->json([
        'message' => 'User updated successfully by admin',
        'user' => $user,
        'status'=>'200'
    ], 200);
}
}
