<?php

namespace App\Http\Controllers\Interfaces;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ChangeRoleRequest;

interface IUserController
{
    function index();
    function changeRole(ChangeRoleRequest $request, int $userId);
}