@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.messages_box')
            <div class="card">
                <div class="card-header">{{ __('Blog') }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            {{-- <thscope="col">Image_path</th> --}}
                            <th scope="col">Created_at</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col">User ID / name</th>
                            <th scope="col">Category ID / name</th>
                            <th scope="col">Akcje</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->description }}</td>
                                {{-- <td>{{ $post->image_path }}</td> --}}
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td>{{ $post->user_id . ' / ' . $post->user->name }}</td>
                                <td>{{ $post->category_id . ' / ' . $post->category->name }}</td>
                                <td>
                                    @can('update-post', $post)
                                        <a href="{{ route('posts.edit', $post->slug) }}">
                                            <button class="btn btn-success btn-sm">E</button></a>
                                        <form method="post" class="delete_form" action="{{ route('posts.destroy', $post->slug) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm delete" data-id="{{ $post->slug }}">D</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Comments') }}</div>
                    <div class="card-body">
                        @isset($post->comments[0])
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">User ID / name</th>
                                <th scope="col">Post ID</th>
                                <th scope="col">Akcje</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($post->comments as $comment)
                                    <tr>
                                        <th scope="row">{{ $comment->id }}</th>
                                        <td>{{ $comment->description }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td>{{ $comment->updated_at }}</td>
                                        <td>{{ $comment->user_id . ' / ' . $comment->user->name }}</td>
                                        <td>{{ $comment->post_id }}</td>
                                        <td>
                                            <a href="{{ route('posts.comments.show', [$post->slug, $comment->id]) }}">
                                                <button class="btn btn-primary btn-sm">S</button></a>
                                            @can('update-comment', $comment)
                                                <a href="{{ route('posts.comments.edit', [$post->slug, $comment->id]) }}">
                                                    <button class="btn btn-success btn-sm">E</button></a>
                                                <form method="post" class="delete_form" action="{{ route('posts.comments.destroy', [$post->slug, $comment->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm delete" data-id="{{ $comment->id }}">D</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="row mb-0">
                                <label for="description" class="col-form-label text-md-center">{{ __('Nie ma komentarzy do tego posta.') }}</label>
                            </div>
                        @endisset
                    </div>
                </div>
            <div class="card">
                <div class="card-header">{{ __('Add comment') }}</div>
                <div class="card-body">
                    @auth
                        <form method="POST" action="{{ route('posts.comments.store', $post->slug) }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('You\'r comment') }}</label>
                                <div class="col-md-6">
                                    <textarea id="description" maxlength="1500" class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add comment') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endauth
                    @guest
                        <div class="row mb-0">
                            <label for="description" class="col-form-label text-md-center">{{ __('Must login to put a comment!') }}</label>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
