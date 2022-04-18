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
            ->with('users', User::paginate(config('blog.pagination_users')));
    }

    /**
     * Display the specified resource.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'postsSum' => Post::where('user_id', $user->id)->count(),
            'commentsSum' => Comment::where('user_id', $user->id)->count()
        ]);
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
            ->with('posts', Post::where('user_id', $user->id)->latest()->with(['user', 'category'])->paginate(config('blog.pagination_posts')));
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
