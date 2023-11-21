<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Models\User;
use App\Policies\BlogPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Blog::class => BlogPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //        Gate::define('update-blog','App\Policies\BlogPolicy@update');
        //        Gate::define('update-blog',fn(User $user,Blog $blog) => $user->id === $blog->user_id);
        //        Gate::define('delete-blog',fn(User $user,Blog $blog) => $user->id === $blog->user_id);

        Gate::before(function (User $user, $ability) {
            if ($user->isAdmin && in_array($ability, ['update', 'delete'])) {
                return true;
            }
        });
    }
}
