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
                        <h2><a href="{{ route('blog.index') }}">{{ __('global.blog_page') }}</a> -&rsaquo; {{ $user->name }}</h2>
                        <span>{{ __('user.list_desc') }}</span>
                    </div>
                </div>

                    @php
                        $admin_color = ($user->role === \App\Enums\UserRole::ADMIN) ? 'is-admin' : '';
                    @endphp
                    <div class="ibox-content forum-container posts {{ $admin_color }}">
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="forum-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>
                                    <a class="forum-item-title {{ $admin_color }} if-admin-color">{{ $user->name }}</a>
                                    <div class="forum-sub-title">
                                        {{ __('user.created_at') . $user->created_at->format('d-m-Y') }}
                                    </div>
                                </div>
                                <div class="col-md-2 forum-info">
                                    <span class="views-number">
                                        <a href="{{ route('users.posts.index', $user->name_slug) }}">{{ $user->posts_count }}</a>
                                    </span>
                                    <div>
                                        <small>{{ __('user.posts') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        <a href="{{ route('users.comments.index', $user->name_slug) }}">{{ $user->comments_count }}</a>
                                    </span>
                                    <div>
                                        <small>{{ __('user.comments') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-last">
                                        {{--  @if (null !== $post->latestComment)
                                            <a href="{{ route('users.show', $post->latestComment->user->name_slug) }}">
                                                <span class="{{ ($post->latestComment->user->role === \App\Enums\UserRole::ADMIN) ? 'is-admin' : ''; }} if-admin-color">{{ \Illuminate\Support\Str::limit($post->latestComment->user->name, 12, '...') }}</span>
                                            </a>
                                        @else
                                            --
                                        @endif--}}
                                    </span>
                                    <div>
                                        <small>
                                            {{-- @if (null !== $post->latestComment)
                                                {{ $post->latestComment->created_at->format('d-m-Y') }}
                                            @else
                                                {{ __('blog.comments.none') }}
                                            @endif--}}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
