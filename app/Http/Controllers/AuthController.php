<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login Function
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Dashboard Access
    public function dashboard()
    {
        return response()->json([
            'message' => 'Welcome to the dashboard!',
            'user' => Auth::user()
        ]);
    }

    // Logout Function
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
