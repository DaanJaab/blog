<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-user', function (User $user, User $profile) {
            return ($user->id === $profile->id);
        });
        Gate::define('update-post', function (User $user, Post $post) {
            return ($user->id === $post->user_id);
        });
        Gate::define('update-comment', function (User $user, Comment $comment) {
            return ($user->id === $comment->user_id);
        });
        Gate::before(function (User $user) { // dopuszcza admin we wszystkich autoryzacjach!
            if ($user->role === UserRole::ADMIN) {
                return true;
            }
        });
    }
}
