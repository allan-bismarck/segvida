<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identity' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['identity'])
                    ->orWhere('user_name', $credentials['identity'])
                    ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'identity' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $token = JWT::encode(['user_id' => $user->id], env('JWT_SECRET'), 'HS256');

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function logout()
    {
        return response()->json(['message' => 'Logout bem-sucedido']);
    }
}