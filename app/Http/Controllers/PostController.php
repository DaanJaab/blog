<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostsCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\throwException;

class PostController extends Controller
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
        return view('blog.index')
            ->with('posts', Post::latest()->with(['user', 'category'])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create', [
            'categories' => PostsCategory::all()
        ]);
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
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        // $newImageName = SlugService::createSlug(Post::class, 'slug', $request->title) . '-' . uniqid() . '.' . $request->image->extension();
        // $request->image->move(public_path('images'), $newImageName);

        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        // $post->image_path = $newImageName;
        $post->category_id = $request->category;

        $post->save();

        return redirect()->route('blog.index')
            ->with('message', ['success', 'Your post has been added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Post $blog)
    {
        return view('blog.show')
            ->with('post', Post::where('slug', $blog->slug)->with(['comments.user'])->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $blog)
    {
        if (!Gate::allows('update-post', $blog)) {
            abort(403, 'nie możesz edytować czyjegoś posta!');
        }
        return view('blog.edit')
            ->with('post', Post::where('slug', $blog->slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $blog)
    {
        if (!Gate::allows('update-post', $blog)) {
            abort(403);
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Post::where('slug', $blog->slug)
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);

        return redirect()->route('blog.show', $blog->slug)
            ->with('message', ['success', 'Your post has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $blog)
    {
        if (!Gate::allows('update-post', $blog)) {
            abort(403, 'nie możesz usunąć czyjegoś posta!');
        }
        $blog->delete();

        return redirect()->route('blog.index')
            ->with('message', ['danger', 'Your post has been deleted!']);
    }
}
