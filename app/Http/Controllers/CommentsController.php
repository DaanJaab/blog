<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        //$this->middleware('isadmin', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  object  $post
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        return view('comments.index')
            ->with('comments', Comment::where('post_id', $post->id)->with(['user', 'post'])->paginate(config('blog.pagination_items')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCommentRequest  $request
     * @param  object  $post
     * @return \Illuminate\Http\Response
     * @info Observer included!
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        Comment::create($request->validated());

        return redirect()->back()
            ->with('message', ['success', __('comments.messages.has_been_added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  object  $post
     * @param  object  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Comment $comment)
    {
        if ($post->id != $comment->post_id) {
            abort(403, __('comments.errors.not_belongs_to_this_post'));
        }
        return view('comments.show', compact('post'))
            ->with('comment', $comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  $post
     * @param  object  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment)
    {
        if (!Gate::allows('update-comment', $comment)) {
            abort(403, __('comments.errors.not_own_edit'));
        }
        if ($post->id != $comment->post_id) {
            abort(403, __('comments.errors.not_belongs_to_this_post'));
        }
        return view('comments.edit', compact('post'))
            ->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCommentRequest  $request
     * @param  object  $post
     * @param  object  $comment
     * @return \Illuminate\Http\Response
     * @info Observer included!
     */
    public function update(UpdateCommentRequest $request, Post $post, Comment $comment)
    {
        $comment->update($request->validated());

        return redirect()->route('posts.show', $post->slug)
            ->with('message', ['success', __('comments.messages.has_been_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $post_slug
     * @param  object  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_slug, Comment $comment)
    {
        if (!Gate::allows('update-comment', $comment)) {
            abort(403, __('comments.errors.not_own_delete'));
        }
        $comment->delete();

        return redirect()->back()
            ->with('message', ['danger', __('comments.messages.has_been_deleted')]);
    }
}
