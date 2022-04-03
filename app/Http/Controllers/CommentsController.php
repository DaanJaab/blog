<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
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
            ->with('comments', Comment::where('post_id', $post->id)->with(['user', 'post'])->paginate());
    }

    /**
     * Display a listing of the resource.
     *
     * @param  object  $post
     * @return \Illuminate\Http\Response
     */
    public function indexByUser(User $user)
    {
        return view('comments.index')
            ->with('comments', Comment::where('user_id', $user->id)->with(['user', 'post'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $post
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
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
     * @param  object  $comment
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
     * @param  object  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($post_slug, Comment $comment)
    {

        return view('comments.edit', compact('post_slug'))
            ->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $post_slug
     * @param  object  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, $post_slug, Comment $comment)
    {
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
     * @param  object  $comment
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
