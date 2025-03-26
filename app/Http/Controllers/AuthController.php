<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    /**
     * Authenticate the user and return a JWT token.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
                'result' => $user
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid email or password',
            'token' => null,
            'result' => null
        ], 401);
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
                'result' => $user
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
