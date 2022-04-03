<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        //$this->middleware('admin', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @param  string  $post
     * @return \Illuminate\Http\Response
     */
    public function index($post)
    {
        if (Route::is('posts.comments.index')) {
            $post = Post::where('slug', $post)->firstOrFail();
            $searchIn = 'post_id';
            $searchBy = $post->id;
        } elseif (Route::is('users.comments.index')) {
            $searchIn = 'user_id';
            $searchBy = $post;
        }

        return view('comments.index')
            ->with('comments', Comment::where($searchIn, $searchBy)->with(['user', 'post'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  model  $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'description' => 'required',
            'post_id' => 'exists:posts,id'
        ]);

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->description = $request->input('description');
        $comment->post_id = $post->id;

        $comment->save();

        return redirect()->route('posts.show', $post->slug)
            ->with('message', ['success', 'Your comment has been added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $post_slug
     * @param  model  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($post_slug, Comment $comment)
    {
        return view('comments.show', compact('post_slug'))
            ->with('comment', $comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $post_slug
     * @param  model  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($post, Comment $comment)
    {
        if (!Gate::allows('update-comment', $comment)) {
            abort(403, 'nie możesz edytować czyjegoś komentarza!');
        }
        return view('comments.edit', compact('post'))
            ->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @param  string  $post_slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_slug, Comment $comment)
    {
        if (!Gate::allows('update-comment', $comment)) {
            abort(403, 'nie możesz edytować czyjegoś komentarza!');
        }
        $request->validate([
            'description' => 'required',
        ]);

        $comment->update([
            'description' => $request->input('description')
        ]);

        return redirect()->route('posts.show', $post_slug)
            ->with('message', ['success', 'Your comment has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $post_slug
     * @param  model  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_slug, Comment $comment)
    {
        if (!Gate::allows('update-comment', $comment)) {
            abort(403, 'nie możesz usunąć czyjegoś komentarza!');
        }
        $comment->delete();

        return redirect()->route('posts.show', $post_slug)
            ->with('message', ['danger', 'Your comment has been deleted!']);
    }
}
