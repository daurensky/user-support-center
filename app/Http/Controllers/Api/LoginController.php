<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function store()
    {
        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => __('Неверный логин или пароль'),
            ], 400);
        }

        $user = User::where('email', request('email'))->first();

        return response()->json([
            'message'      => __('Успешная авторизация'),
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'token_type'   => 'bearer',
        ]);
    }

    public function destroy()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => __('Успешный выход из аккаунта'),
        ]);
    }
}
