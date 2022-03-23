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
                    @foreach($posts as $post)
                        {<br>
                            ID: {{ $post->id }}<br>
                            Slug: {{ $post->slug }}<br>
                            Title: {{ $post->title }}<br>
                            Description: {{ $post->description }}<br>
                            Image_path: {{ $post->image_path }}<br>
                            Created_at: {{ $post->created_at }}<br>
                            Updated_at: {{ $post->updated_at }}<br>
                            User_id: {{ $post->user_id }}<br>
                            Category_id: {{ $post->category_id }}<br>
                        }<br><br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
