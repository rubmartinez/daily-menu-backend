<?php

namespace App\UseCases\Auth;

use App\Models\User;

class GetMeUseCase
{
    public function execute(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ];
    }
}
