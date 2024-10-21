<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use App\Models\Company;
use App\Models\Permission;
use App\Policies\JobPolicy;
use App\Policies\PostPolicy;
use App\Policies\CompanyPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
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
        Gate::policy(Company::class, CompanyPolicy::class);
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(Job::class, JobPolicy::class);

        Gate::define('create-users', function (User $user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });

        Gate::define('view-users', function (User $user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });

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