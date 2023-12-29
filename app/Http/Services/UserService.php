<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\IUserService;
use App\Models\User;

class UserService implements IUserService
{
    public function changeRole(User $user, string $role)
    {
        $user->role = $role;
        $user->save();
    }
}