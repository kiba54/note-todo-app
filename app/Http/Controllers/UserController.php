<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get user profile information.
     */
    public function show($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        return response()->json($user);
    }

    /**
     * Update user profile information.
     */
    public function update(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|required|string|max:255|unique:users,username,' . $userId,
            'email' => 'sometimes|required|email|max:255|unique:users,email,' . $userId,
            'profile_pic' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $user->update($request->only(['username', 'email', 'profile_pic']));

        return response()->json($user);
    }
}
