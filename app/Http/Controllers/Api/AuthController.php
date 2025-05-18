<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'gender' => 'required|in:male,female,other',
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'gender' => $validated['gender'],
        ]);

        $token = $user->createToken('api_token')->plainTextToken;
        
        return response()->json([
            'message' => 'Success',
            'user' => $user,
            'token' => $token
        ],201);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user()->only(['id','email']));
    }
}
