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
                            <th scope="col">Description</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col">User ID / name</th>
                            <th scope="col">Post title</th>
                            <th scope="col">Akcje</th>
                        </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <th scope="row">{{ $comment->id }}</th>
                                    <td>{{ $comment->description }}</td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>{{ $comment->updated_at }}</td>
                                    <td>{{ $comment->user_id . ' / ' . $comment->user->name }}</td>
                                    <td>{{ $comment->post->title }}</td>
                                    <td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
