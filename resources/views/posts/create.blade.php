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
                        <h2><a href="{{ route('blog.index') }}">{{ __('global.blog_page') }}</a> -&rsaquo; @isset($category) <a href="{{ route('blog.show', $category->name_slug) }}">{{ $category->name }}</a> -&rsaquo; @endisset {{ __('posts.adding') }}</h2>
                        <span>{{ __('posts.adding_desc') }}</span>
                    </div>
                </div>

                <div class="ibox-content forum-container">
                    <div class="forum-item active">
                        @isset($category)
                            <form method="POST" action="{{ route('blog.posts.store', $category->id) }}">
                        @else
                            <form method="POST" action="{{ route('posts.store') }}">
                        @endisset
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('posts.title') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" maxlength="80" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="text" class="col-md-4 col-form-label text-md-end">{{ __('posts.content') }}</label>
                                <div class="col-md-6">
                                    <textarea id="text" type="text" maxlength="4000" class="form-control @error('text') is-invalid @enderror" name="text" required>{{ old('text') }}</textarea>
                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @if(!isset($category))
                                <div class="row mb-3">
                                    <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('posts.category') }}</label>
                                    <div class="col-md-6">
                                        <select id="category" class="form-control @error('category') is-invalid @enderror" name="category" required>
                                            @foreach($categories as $category)
                                                @if (old('category') == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('posts.buttons.add_post') }}
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
