<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comme = Comment::orderBy('created_at', 'ASC')->get();
        return view('comments.index')
            ->with('comments', $comme);
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
        ]);

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->description = $request->input('description');
        $comment->post_id = $request->input('post_id');

        $comment->save();

        return redirect('/blog/' . Post::where('id', $comment->post_id)->first()->slug)
            ->with('message', ['success', 'Your comment has been added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (isset(Comment::where('id', $id)->first()->id)) {
            return view('comments.show')
                ->with('comment', Comment::where('id', $id)->first());
        } else {
            return redirect('/comment')
                ->with('message', ['warning', 'Comment isn\'t exists!']);
        }
    }
}
