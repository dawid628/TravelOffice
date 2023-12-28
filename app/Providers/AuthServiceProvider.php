<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Enums\UserRole;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
       $this->defineUserRoleGate('isAdmin', UserRole::ADMIN);
       $this->defineUserRoleGate('isModerator', UserRole::MODERATOR);
       $this->defineUserRoleGate('isUser', UserRole::USER);
    }

    private function defineUserRoleGate(string $name, string $role) : void
    {
        Gate::define($name, function(User $user) use ($name, $role){
            return $user->role == $role;
        });
    }
}
