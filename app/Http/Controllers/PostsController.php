<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostsCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, $category = null)
    {
        // $newImageName = SlugService::createSlug(Post::class, 'slug', $request->title) . '-' . uniqid() . '.' . $request->image->extension();
        // $request->image->move(public_path('images'), $newImageName);

        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        // $post->image_path = $newImageName;
        $post->category_id = $request->category; // take category from request, or if not exist take from route

        $post->save();

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
        return view('posts.show')
            ->with('post', Post::where('slug', $post_slug)->with(['comments.user'])->firstOrFail());
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
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

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
