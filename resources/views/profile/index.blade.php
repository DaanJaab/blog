@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.messages_box')
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
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
                            @foreach($profiles as $profile)
                            <tr>
                                <th scope="row">{{ $profile->id }}</th>
                                <td>{{ $profile->name }}</td>
                                <td>{{ $profile->email }}</td>
                                <td>{{ $profile->role }}</td>
                                <td>{{ $profile->description }}</td>
                                <td>{{ $profile->created_at }}</td>
                                <td>{{ $profile->updated_at }}</td>
                                <td>
                                    <a href="{{ route('profile.show', $profile->id) }}">
                                        <button class="btn btn-primary btn-sm">S</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
