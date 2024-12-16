<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Gate::before(function (User $user) {
        //     return $user->isSuperAdmin();
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerGates();
    }
    protected function registerGates(): void
    {
        // Gate::policy(Company::class, CompanyPolicy::class);
        // Gate::policy(Post::class, PostPolicy::class);
        // Gate::policy(Job::class, JobPolicy::class);
        // Gate::policy(User::class, AdminPolicy::class);

        // Gate::define('create-users', function (User $user) {
        //     return $user->isAdmin() || $user->isSuperAdmin()
        //         ? Response::allow()
        //         : Response::deny('You must be an administrator.');
        // });

        // Gate::define('edit-users', function (User $user) {
        //     return $user->isAdmin() || $user->isSuperAdmin()
        //         ? Response::allow()
        //         : Response::deny('You must be an administrator.');
        // });

        // Gate::define('delete-users', function (User $user) {
        //     return $user->isAdmin() || $user->isSuperAdmin()
        //         ? Response::allow()
        //         : Response::deny('You must be an administrator.');
        // });

        // Gate::define('listAll.users', function (User $user) {
        //     return $user->isAdmin() || $user->isSuperAdmin();
        // });

        try {
            foreach (Permission::pluck('name') as $permission) {
                Gate::define($permission, function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        } catch (\Exception $e) {
            info('registerPermissions(): Database not found or not yet migrated. Ignoring user permissions while booting app.');
        }
    }
}