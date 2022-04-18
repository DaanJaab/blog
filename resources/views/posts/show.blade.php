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
                        <h2><a href="{{ route('blog.index') }}">{{ __('global.blog_page') }}</a> -&rsaquo; <a href="{{ route('blog.show', $post->category->name_slug) }}">{{ $post->category->name }}</a> -&rsaquo; {{ __('posts.post') }}</h2>
                        <span>{{ $post->category->description }}</span>

                    </div>
                </div>
                @php
                    if($post->authorInfo->role === \App\Enums\UserRole::ADMIN) { $admin_color = 'is-admin'; } else { $admin_color = ''; }
                @endphp
                <div class="ibox-content forum-container post {{ $admin_color }}">
                    <div class="forum-item active">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="col-md-12 forum-info">
                                    <div class="col-md-12 forum-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>
                                    <a href="{{ route('users.show', $post->authorInfo->name_slug) }}" class="forum-item-title">
                                            <span class="{{ $admin_color }} or-not">{{ $post->authorInfo->name }}</span>
                                    </a>
                                    <small>{{ __('posts.user.created_at') }}</small>
                                    <div>{{ $post->authorInfo->created_at->format('d-m-Y') }}</div>
                                    <div>{{ __('posts.user.posts_count') . $post->authorInfo->posts_count }}</div>
                                    <div>{{ __('posts.user.comments_count') . $post->authorInfo->comments_count }}</div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-12">
                                    <div class="float-start">
                                        <small>{{ __('posts.comments.created_at') . $post->created_at->format('H:i, d-m-Y') }}</small>
                                    </div>
                                    <div class="float-end">
                                        <small>#{{ $post->id }}</small>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <span class="views-number">
                                        {{ $post->title }}
                                    </span>
                                </div>
                                <div>
                                    {{ $post->text }}
                                </div>
                                <div class="col-md-12 user-desc">
                                    <div class="float-start">
                                        @if($post->created_at < $post->updated_at)
                                            <small>{{ __('posts.comments.updated_at') . $post->updated_at->format('H:i, d-m-Y') }}</small>
                                        @endif
                                    </div>
                                    <div class="float-end">
                                        <small>{{ __('posts.buttons.report') }}</small>
                                        <small>
                                            @can('update-post', $post)
                                                <a href="{{ route('posts.edit', $post->slug) }}">
                                                    {{ __('posts.buttons.edit') }}</a>
                                                <a href="{{ route('posts.destroy', $post->slug) }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('delete-post').submit();">
                                                    {{ __('posts.buttons.delete') }}</a>
                                                <form id="delete-post" method="post" class="delete_form" action="{{ route('posts.destroy', $post->slug) }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            @endcan
                                        </small>
                                    </div>
                                </div>
                                @if ($post->authorInfo->footer !== null)
                                    <div class="col-md-12">
                                        {{ $post->authorInfo->footer }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <a class="pagination">{{ $comments->onEachSide(1)->links() }}</a>
                @forelse($comments as $comment)
                    @php
                        if($comment->authorInfo->role === \App\Enums\UserRole::ADMIN) { $admin_color = 'is-admin'; } else { $admin_color = ''; }
                    @endphp
                    <div class="ibox-content forum-container comments {{ $admin_color }}">
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="col-md-12 forum-info">
                                        <div class="col-md-12 forum-icon">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <a href="{{ route('users.show', $comment->authorInfo->name_slug) }}" class="forum-item-title">
                                            <span class="{{ $admin_color }} or-not">{{ $comment->authorInfo->name }}</span>
                                        </a>
                                        <small>{{ __('posts.user.created_at') }}</small>
                                        <div>{{ $comment->authorInfo->created_at->format('d-m-Y') }}</div>
                                        <div>{{ __('posts.user.posts_count') . $comment->authorInfo->posts_count }}</div>
                                        <div>{{ __('posts.user.comments_count') . $comment->authorInfo->comments_count }}</div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="col-md-12">
                                        <div class="float-start">
                                            <small>{{ __('posts.comments.created_at') . $comment->created_at->format('H:i, d-m-Y') }}</small>
                                        </div>
                                        <div class="float-end">
                                            <small>#{{ $comment->id }}</small>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        {{ $comment->text }}
                                    </div>
                                    <div class="col-md-12 user-desc">
                                        <div class="float-start">
                                            @if($comment->created_at < $comment->updated_at)
                                                <small>{{ __('posts.comments.updated_at') . $comment->updated_at->format('H:i, d-m-Y') }}</small>
                                            @endif
                                        </div>
                                        <div class="float-end">
                                            <small>{{ __('posts.buttons.report') }}</small>
                                            <small>
                                                @can('update-comment', $comment)
                                                    <a href="{{ route('posts.comments.edit', [$post->slug, $comment->id]) }}">
                                                        {{ __('posts.buttons.edit') }}</a>
                                                    <a href="{{ route('posts.comments.destroy', [$post->slug, $comment->id]) }}"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('delete-comment').submit();">
                                                        {{ __('posts.buttons.delete') }}</a>
                                                    <form id="delete-comment" method="post" class="delete_form" action="{{ route('posts.comments.destroy', [$post->slug, $comment->id]) }}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                @endcan
                                            </small>
                                        </div>
                                    </div>
                                    @if ($comment->authorInfo->footer !== null)
                                        <div class="col-md-12">
                                            {{ $comment->authorInfo->footer }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="row mb-0">
                        <label for="text" class="col-form-label text-md-center">{{ __('posts.comments.none') }}</label>
                    </div>
                @endforelse
                <a class="pagination">{{ $comments->onEachSide(1)->links() }}</a>


                <div class="ibox-content forum-container add-comment">
                    @auth
                        <form method="POST" action="{{ route('posts.comments.store', $post->slug) }}">
                            @csrf
                            <div class="forum-item active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mb-3">
                                            <label for="text" class="col-md-4 col-form-label text-md-end">{{ __('posts.comments.add') }}</label>
                                            <div class="col-md-6">
                                                <textarea id="text" type="text" maxlength="4000" class="form-control @error('text') is-invalid @enderror" name="text">{{ old('text') }}</textarea>
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
                                                    {{ __('posts.buttons.add_comment') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endauth
                    @guest
                        <div class="row mb-0">
                            <label for="text" class="col-form-label text-md-center">{{ __('posts.comments.login_to_put') }}</label>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
