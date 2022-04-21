<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')
            ->with('users', User::withCount('posts', 'comments')->paginate(config('blog.pagination_users')));
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $name_slug
     * @return \Illuminate\Http\Response
     */
    public function show($name_slug)
    {
        return view('users.show')
            ->with('user', User::where('slug', $name_slug)->withCount('posts', 'comments')->firstOrFail());
    }

    /**
     * Display a listing of the resource.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function showUserPosts(User $user)
    {
        return view('posts.index')
            ->with('posts', Post::where('user_id', $user->id)->latest()->withCount('comments')->with(['user', 'category', 'latestComment.user'])->paginate(config('blog.pagination_posts')));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function showUserComments(User $user)
    {
        return view('comments.index')->with('comments', Comment::where('user_id', $user->id)->latest()->with(['user', 'post'])->paginate(config('blog.pagination_comments')));
    }
}
