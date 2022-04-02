<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show(Test $key)
    {
        return $key->name;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {

        $request->validate([
            'description' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->description = $request->input('description');
        $comment->post_id = Post::where('slug', $slug)->first()->id;

        $comment->save();

        return redirect('/blog/' . $slug)
            ->with('message', ['success', 'Your comment has been added!']);
    }
}
