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
                        <h2><a href="{{ route('blog.index') }}">{{ __('global.blog_page') }}</a> -&rsaquo; <a href="{{ route('blog.show', $post->category->slug) }}">{{ $post->category->name }}</a> -&rsaquo; <a href="{{ route('posts.show', $post->slug) }}">{{ \Illuminate\Support\Str::limit($post->title, 40, '...') }}</a> -&rsaquo; {{ __('posts.post') }}</h2>
                        <span>YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY666666666666666666666666666666666666666666666666666666666</span>
                    </div>
                </div>

                    @php
                        $admin_color = ($comment->authorInfo->role === \App\Enums\UserRole::ADMIN) ? 'is-admin' : '';
                    @endphp
                    <div class="ibox-content forum-container comments {{ $admin_color }}">
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="col-md-12 forum-info">
                                        <div class="col-md-12 forum-icon">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <a href="{{ route('users.show', $comment->authorInfo->slug) }}" class="forum-item-title">
                                            <span class="{{ $admin_color }} if-admin-color">{{ $comment->authorInfo->name }}</span>
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
                                        {{ $comment->content }}
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
                                                        document.getElementById('delete-comment-{{ $comment->id }}').submit();">
                                                        {{ __('posts.buttons.delete') }}</a>
                                                    <form id="delete-comment-{{ $comment->id }}" method="post" class="delete_form" action="{{ route('posts.comments.destroy', [$post->slug, $comment->id]) }}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                @endcan
                                            </small>
                                        </div>
                                    </div>
                                    @if ($comment->authorInfo->signature !== null)
                                        <div class="col-md-12">
                                            {{ $comment->authorInfo->signature }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
        </div>
    </div>
</div>
@endsection
