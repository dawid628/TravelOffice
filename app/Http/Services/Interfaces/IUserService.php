<?php

namespace App\Http\Services\Interfaces;

use App\Models\User;

interface IUserService
{
    function changeRole(User $user, string $role);
}