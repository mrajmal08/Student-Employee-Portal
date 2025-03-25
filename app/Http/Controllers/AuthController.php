<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{
    /**
     * Authenticate the user and return a JWT token.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    /**
     * Get the authenticated user.
     */
    public function profile(Request $request)
    {
        $user = $request->user();

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User profile retrieved successfully',
                'token' => $request->bearerToken(),
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Your token is expired or invalid',
                'token' => null
            ], 401);
        }
    }

    /**
     * Logout the user (invalidate the token).
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => false,
            'message' => 'Logged out successfully',
        ], 200);
    }
}
