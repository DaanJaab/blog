<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostsCategory;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'allCategoriesCount' => PostsCategory::count(),
            'allPostsCount' => Post::count(),
            'allCommentsCount' => Comment::count(),
            'allUsersCount' => User::count(),
            'allAdminUsersCount' => User::where('role', UserRole::ADMIN)->count(),
            'allVerifyUsersCount' => User::where('email_verified_at', '!=', null)->count(),
            'allNotVerifyUsersCount' => User::where('email_verified_at', null)->count(),
            'allSoftDeletedUsersCount' => User::where('deleted_at', '!=', null)->count(),
            'allBannedUsersCount' => User::where('banned_at', '!=', null)->count(),

            'allActivedUsersCount' => User::where('email_verified_at', '!=', null)
                ->where('deleted_at', null)
                ->where('banned_at', null)
                ->count(),
        ]);
    }
}
