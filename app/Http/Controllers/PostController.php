<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostsCategory;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

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
            ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
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
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = SlugService::createSlug(Post::class, 'slug', $request->title) . '-' . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        $post->image_path = $newImageName;
        $post->category_id = $request->category;

        $post->save();

        return redirect('/blog')
            ->with('message', ['success', 'Your post has been added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $check = Post::where('slug', $slug)->first();
        if (true) {
            return view('blog.show')
                ->with('post', $check)
                ->with('comments', Comment::where('post_id', $check->id)->with('user')->get());
        } else {
            return redirect('/blog')
                ->with('message', ['warning', 'Post isn\'t exists!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (isset(Post::where('slug', $slug)->first()->slug)) {
            return view('blog.edit')
                ->with('post', Post::where('slug', $slug)->first());
        } else {
            return redirect('/blog')
                ->with('message', ['warning', 'Post isn\'t exists!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Post::where('slug', $slug)
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);

        return redirect('/blog')
            ->with('message', ['success', 'Your post has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();

        return redirect('/blog')
            ->with('message', ['danger', 'Your post has been deleted!']);
    }
}