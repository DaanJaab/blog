<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        $this->middleware('admin', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('comments.index')
            ->with('comments', Comment::oldest()->with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'post_id' => 'exists:posts,id'
        ]);

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->description = $request->input('description');
        $comment->post_id = $request->input('post_id');

        $comment->save();

        return redirect()->route('blog.show', Post::where('id', $comment->post_id)->first()->slug)
            ->with('message', ['success', 'Your comment has been added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('comments.show')
            ->with('comment', $comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        if (!Gate::allows('update-comment', $comment)) {
            abort(403, 'nie możesz edytować czyjegoś komentarza!');
        }
        return view('comments.edit')
            ->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
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

        return redirect()->route('blog.show', Post::where('id', $comment->post_id)->first()->slug)
            ->with('message', ['success', 'Your comment has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (!Gate::allows('update-comment', $comment)) {
            abort(403, 'nie możesz usunąć czyjegoś komentarza!');
        }
        $comment->delete();

        return redirect()->route('blog.show', Post::where('id', $comment->post_id)->first()->slug)
            ->with('message', ['danger', 'Your comment has been deleted!']);
    }
}
