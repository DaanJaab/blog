<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('user-exhausted', function (User $user) {
            if ($user->last_action_time > now()->addSeconds(-config('blog.exhausted_time'))->toDateTimeString()) {
                throw new HttpResponseException(redirect()->back()->withInput()
                    ->with('message', ['danger', __('global.exhausted')]));
            } else {
                return true;
            }
        });
        Gate::define('update-user', function (User $user, User $auth_user) {
            return ($user->id === $auth_user->id);
        });
        Gate::define('update-post', function (User $user, Post $post) {
            return ($user->id === $post->user_id);
        });
        Gate::define('update-comment', function (User $user, Comment $comment) {
            return ($user->id === $comment->user_id);
        });
        Gate::define('isAdmin', function (User $user) {
            return ($user->id === UserRole::ADMIN);
        });
        Gate::define('isModer', function (User $user) {
            return ($user->id === UserRole::MODER);
        });
        Gate::before(function (User $user) { // dopuszcza admina we wszystkich autoryzacjach!
            if ($user->role === UserRole::ADMIN) {
                return true;
            }
        });
    }
}
