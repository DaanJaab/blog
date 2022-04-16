<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostsCategory;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
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
        return view('posts.index')
            ->with('posts', Post::latest()->with(['user', 'category'])->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => PostsCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithSpecificCategory(PostsCategory $category)
    {
        return view('posts.createWithSpecificCategory', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @param  int  $category
     * @return \Illuminate\Http\Response
     * @info Observer included!
     */
    public function store(StorePostRequest $request, $category = null)
    {
        Post::create($request->validated());

        return redirect()->route('posts.index')
            ->with('message', ['success', 'Your post has been added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $post_slug
     * @return \Illuminate\Http\Response
     */
    public function show($post_slug)
    {
        $post = Post::where('slug', $post_slug)->with([
            'authorInfo' => function ($query) {
                return $query->withCount('posts', 'comments');
            }
        ])->firstOrFail();

        $comments = $post->comments()->with([
            'authorInfo' => function ($query) {
                return $query->withCount('posts', 'comments');
            }
        ])->paginate(config('blog.pagination_items'));

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (!Gate::allows('update-post', $post)) {
            abort(403, 'nie możesz edytować czyjegoś posta!');
        }
        return view('posts.edit')
            ->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePostRequest  $request
     * @param  object  $post
     * @return \Illuminate\Http\Response
     * @info Observer included!
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('posts.show', $post->slug)
            ->with('message', ['success', 'Your post has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!Gate::allows('update-post', $post)) {
            abort(403, 'nie możesz usunąć czyjegoś posta!');
        }
        $post->delete();

        return redirect()->route('posts.index')
            ->with('message', ['danger', 'Your post has been deleted!']);
    }
}
