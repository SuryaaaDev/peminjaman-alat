<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout successful.'
        ]);
    }
}
