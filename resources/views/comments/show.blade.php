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

                        {<br>
                            ID: {{ $comment->id }}<br>
                            Description: {{ $comment->description }}<br>
                            Created_at: {{ $comment->created_at }}<br>
                            Updated_at: {{ $comment->updated_at }}<br>
                            User ID / name: {{ $comment->user_id . ' / ' .  $comment->user->name }}<br>
                        }
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
