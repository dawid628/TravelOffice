<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ChangeRoleRequest;
use App\Http\Controllers\Interfaces\IUserController;
use App\Http\Services\UserService;

class UserController extends Controller implements IUserController
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }


    public function index()
    {
        $users = User::all();
        return view('management.management_users')->with('users', $users);
    }

    public function changeRole(ChangeRoleRequest $request, int $userId)
    {
        $role = $request->input('role');
        $user = User::find($userId);
        
        if(!is_null($user)) {
            $this->service->changeRole($user, $role); 
            return redirect()->route('index')->with('success', 'Rola została zmieniona pomyślnie.');
        }
        return redirect()->route('index')->with('error', 'Zmiana roli nie powiodła się.');
    }
}
