<?php

namespace App\Providers;

use App\Models\User;
use App\Models\PermissionLevel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AdminProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('manage-user', function (User $user) {
            return $user->permission->hasPermission(
                PermissionLevel::ADMIN,
            );
        });
    }
}
