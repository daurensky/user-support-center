<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserCreateRequest;

class UserController extends Controller
{
    public function store(UserCreateRequest $request)
    {
        User::create($request->validated());

        return response()->json([
            'message' => 'Пользователь успешно создан',
        ]);
    }
}
