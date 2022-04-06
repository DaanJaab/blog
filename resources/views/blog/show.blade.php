@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.messages_box')
            <div class="card">
                <div class="card-header">{{ __('Blog') }}
                    <div class="col-md-2 offset-md-10">
                        <a href="{{ route('blog.posts.create', $category->name) }}">
                        <button class="btn btn-primary">
                            {{ __('Dodaj posta w tym dziale') }}
                        </button></a>
                    </div>
                </div>
                <div class="card-body">
                    @isset($posts[0])
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col">User name</th>
                            <th scope="col">Liczba komentarzy</th>
                            <th scope="col">Ostatni komentarz z</th>
                            <th scope="col">Akcje</th>
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
                                        @php
                                            if (null !== $post->comments->last()) {
                                                echo $post->comments->last()->created_at . ', przez ' . $post->comments->last()->user->name;
                                            } else {
                                                echo 'Brak komentarzy';
                                            }
                                        @endphp
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
                            <label for="description" class="col-form-label text-md-center">{{ __('W tym dziale nie ma postów.') }}</label>
                        </div>
                    @endisset
                </div>
            </div>

            {{--  <div class="card">
                <div class="card-header">{{ __('Add post') }}</div>
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
                                        {{ __('Add post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endauth
                    @guest
                        <div class="row mb-0">
                            <label for="description" class="col-form-label text-md-center">{{ __('Must login to put a post!') }}</label>
                        </div>
                    @endguest
                </div>
            </div>--}}
        </div>
    </div>
</div>
@endsection
