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
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">User role</th>
                            <th scope="col">Description</th>
                            {{-- <thscope="col">Image_path</th> --}}
                            <th scope="col">Created_at</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col">Akcje</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{ $profile->id }}</th>
                                <td>{{ $profile->name }}</td>
                                <td>{{ $profile->email }}</td>
                                <td>{{ $profile->role }}</td>
                                <td>{{ $profile->description }}</td>
                                {{-- <td>{{ $post->image_path }}</td> --}}
                                <td>{{ $profile->created_at }}</td>
                                <td>{{ $profile->updated_at }}</td>
                                <td>
                                    @can('update-user', $profile)
                                        <a href="{{ route('profile.edit', $profile->id) }}">
                                            <button class="btn btn-success btn-sm">E</button></a>
                                        <form method="post" class="delete_form" action="{{ route('profile.destroy', $profile->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm delete" data-id="{{ $profile->id }}">D</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-header">{{ __('Posts') }}</div>
                <div class="card">
                    <div class="card-body">
                        @isset($profile->posts[0])
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">User ID / name</th>
                                <th scope="col">Category ID / name</th>
                                <th scope="col">Akcje</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($profile->posts as $post)
                                    <tr>
                                        <th scope="row">{{ $post->id }}</th>
                                        <td>{{ $post->slug }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->updated_at }}</td>
                                        <td>{{ $post->user_id . ' / ' . $post->user->name }}</td>
                                        <td>{{ $post->category_id . ' / ' . $post->category->name }}</td>
                                        <td>
                                            <a href="{{ route('blog.show', $post->slug) }}">
                                                <button class="btn btn-primary btn-sm">S</button></a>
                                            @can('update-post', $post)
                                                <a href="{{ route('blog.edit', $post->slug) }}">
                                                    <button class="btn btn-success btn-sm">E</button></a>
                                                <form method="post" class="delete_form" action="{{ route('blog.destroy', $post->slug) }}">
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
                                <label for="description" class="col-form-label text-md-center">{{ __('Ten użytkownik nie napisał jeszcze żadnego posta.') }}</label>
                            </div>
                        @endisset
                    </div>
                </div>


                <div class="card-header">{{ __('Comments') }}</div>
                <div class="card">
                    <div class="card-body">
                        @isset($profile->comments[0])
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
                                @foreach($profile->comments as $comment)
                                    <tr>
                                        <th scope="row">{{ $comment->id }}</th>
                                        <td>{{ $comment->description }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td>{{ $comment->updated_at }}</td>
                                        <td>{{ $comment->user_id . ' / ' . $comment->user->name }}</td>
                                        <td>{{ $comment->post_id }}</td>
                                        <td>
                                            <a href="{{ route('comment.show', $comment->id) }}">
                                                <button class="btn btn-primary btn-sm">S</button></a>
                                            @can('update-comment', $comment)
                                                <a href="{{ route('comment.edit', $comment->id) }}">
                                                    <button class="btn btn-success btn-sm">E</button></a>
                                                <form method="post" class="delete_form" action="{{ route('comment.destroy', $comment->id) }}">
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
                                <label for="description" class="col-form-label text-md-center">{{ __('Ten użytkownik nie napisał jeszcze żadnego komentarza.') }}</label>
                            </div>
                        @endisset
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
