@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.messages_box')
            <div class="card">
                <div class="card-header">{{ $category->name }}
                    <div class="col-md-2 offset-md-10">
                        <a href="{{ route('blog.posts.create', $category->name) }}">
                        <button class="btn btn-primary">
                            {{ __('blog.buttons.add_post_in_this_category') }}
                        </button></a>
                    </div>
                </div>
                <div class="card-body">
                    @isset($posts[0])
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('blog.title') }}</th>
                            <th scope="col">{{ __('blog.description') }}</th>
                            <th scope="col">{{ __('blog.created_at') }}</th>
                            <th scope="col">{{ __('blog.updated_at') }}</th>
                            <th scope="col">{{ __('blog.author_name') }}</th>
                            <th scope="col">{{ __('blog.comments.quantity') }}</th>
                            <th scope="col">{{ __('blog.comments.last_time') }}</th>
                            <th scope="col">{{ __('blog.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->description }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->comments->count() }}</td>
                                    <th>
                                        @if (null !== $post->comments->last())
                                            {{ $post->comments->last()->created_at . __('blog.by') . $post->comments->last()->user->name }}
                                        @else
                                            {{ __('blog.comments.none') }}
                                        @endif
                                    </th>
                                    <td>
                                        <a href="{{ route('posts.show', $post->slug) }}">
                                            <button class="btn btn-primary btn-sm">S</button></a>
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
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="row mb-0">
                            <label for="description" class="col-form-label text-md-center">{{ __('blog.posts.none') }}</label>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
