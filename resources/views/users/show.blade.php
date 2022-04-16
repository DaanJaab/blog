@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.messages_box')
            <div class="card">
                <div class="card-header">{{ __('Blog.h') }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">User role</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col">Akcje</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->description }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    @can('update-user', $user)
                                        <a href="{{ route('account.edit') }}">
                                            <button class="btn btn-success btn-sm">E</button></a>
                                        <form method="post" class="delete_form" action="{{ route('account.destroy') }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm delete" data-id="{{ $user->id }}">D</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="info-body">
                        Liczba napisanych postów: <a href="{{ route('users.posts.index', $user->id) }}">{{ $postsSum }}</a> | Liczba napisanych komentarzy: <a href="{{ route('users.comments.index', $user->id) }}">{{ $commentsSum }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
