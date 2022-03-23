@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('message'))
        <div class="col-md-4 alert alert-{{ session('message.0') }}" role="alert">
                {{ session('message.1') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Blog') }}</div>
                <div class="card-body">
                            ID: {{ $post->id }}<br>
                            Slug: {{ $post->slug }}<br>
                            Title: {{ $post->title }}<br>
                            Description: {{ $post->description }}<br>
                            Image_path: {{ $post->image_path }}<br>
                            Created_at: {{ $post->created_at }}<br>
                            Updated_at: {{ $post->updated_at }}<br>
                            User ID / name: {{ $post->user_id . ' / ' }}<br>
                            Category ID / name: {{ $post->category_id . ' / ' . $post->category->name }}<br>
                </div>
            </div>
            <div class="card-header">{{ __('Comments') }}</div>
            @foreach($post->comments as $comment)
                <div class="card">
                    <div class="card-body">
                        ID: {{ $comment->id }}<br>
                        Description: {{ $comment->description }}<br>
                        By: <br>
                        Post id: {{ $comment->post_id }}
                    </div>
                </div>
            @endforeach
            @auth
            <div class="card">
                <div class="card-header">{{ __('Add comment') }}</div>
                <div class="card-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('comment.store') }}">
                            @csrf
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('You\'r comment') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" maxlength="1500" class="form-control @error('description') is-invalid @enderror" name="description" required></textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input id="post_id" hidden class="form-control" name="post_id" value="{{ $post->id }}" required>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add comment') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
