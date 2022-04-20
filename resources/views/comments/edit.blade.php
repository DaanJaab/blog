@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.messages_box')
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content m-b-sm border-bottom">
                    <div class="p-xs">
                        <div class="pull-left m-r-md">
                            <i class="fa fa-globe text-navy mid-icon"></i>
                        </div>
                        <h2>
                            <a href="{{ route('blog.index') }}">{{ __('global.blog_page') }}</a> -&rsaquo; <a href="{{ route('blog.show', $comment->post->category->name_slug) }}">{{ $comment->post->category->name }}</a> -&rsaquo;  <a href="{{ route('posts.show', $comment->post->slug) }}">{{ \Illuminate\Support\Str::limit($comment->post->title, 30, '...') }}</a> -&rsaquo; {{ __('comments.editing') }}
                        </h2>
                        <span>{{ __('comments.editing_desc') }}</span>
                    </div>
                </div>
                <div class="ibox-content forum-container">
                    <div class="forum-item active">
                        <form method="POST" action="{{ route('posts.comments.update', [$post->slug, $comment->id]) }}">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row mb-3">
                                <label for="text" class="col-md-4 col-form-label text-md-end">{{ __('comments.content') }}</label>
                                <div class="col-md-6">
                                    <textarea id="text" type="text" maxlength="4000" class="form-control @error('text') is-invalid @enderror" name="text" required>@if(old('text') !== null){{ old('text') }}@else{{ $comment->text }}@endif</textarea>
                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('comments.buttons.save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
