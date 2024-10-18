<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Company;
use Laravel\Sanctum\Sanctum;
use App\Policies\CompanyPolicy;
use App\Policies\PostPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        Gate::policy(Company::class, CompanyPolicy::class);
        Gate::policy(Post::class, PostPolicy::class);

        // Gate::define('update-post', function (User $user, Post $post) {
        //     return $user->id === $post->user_id;
        // });

        // Gate::define('delete-post', function (User $user, Post $post) {
        //     return $user->id === $post->user_id;
        // });

        Gate::define('view-users', function (User $user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });

        // Gate::define('update-company', [CompanyPolicy::class, 'update']);
        // Gate::define('delete-company', [CompanyPolicy::class, 'delete']);
    }
}