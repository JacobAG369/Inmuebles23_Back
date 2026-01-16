<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = Auth::guard('api')->login($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['message' => 'Credenciales invalidas'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => Auth::guard('api')->user(),
        ]);
    }

    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Sesion cerrada']);
    }

    public function refresh()
    {
        return response()->json([
            'access_token' => Auth::guard('api')->refresh(),
            'token_type' => 'bearer',
        ]);
    }
}
