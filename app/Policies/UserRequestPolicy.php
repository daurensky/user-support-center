<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRequest;

class UserRequestPolicy
{
    public function create(User $user): bool
    {
        return $user->cannot('resolve requests');
    }

    public function delete(User $user, UserRequest $userRequest): bool
    {
        return $user->id === $userRequest->user_id;
    }
}
