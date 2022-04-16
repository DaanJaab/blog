<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    ##### OWN ACCOUNT HERE, USERS BELOW #####

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account.index')
            ->with('user', auth()->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('account.edit')
            ->with('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        auth()->user()->update($request->validated());

        return redirect()->route('account.index')
            ->with('message', ['success', 'Your account has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->user()->delete();
        Auth::logout();

        return redirect()->route('login')
            ->with('message', ['danger', 'Your profile has been deleted!']);
    }



    ##### USERS #####

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        return view('users.index')
            ->with('users', User::paginate());
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
            ->with('posts', Post::where('user_id', $user->id)->latest()->with(['user', 'category'])->paginate());
    }

    /**
     * Display a listing of the resource.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function showUserComments(User $user)
    {
        return view('comments.index')->with('comments', Comment::where('user_id', $user->id)->latest()->with(['user', 'post'])->paginate());
    }
}
