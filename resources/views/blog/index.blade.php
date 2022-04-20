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
                        <div class="pull-right m-r-md">
                            <a href="{{ route('posts.create') }}">
                                <button class="btn btn-primary">
                                    {{ __('blog.buttons.add_post') }}
                                </button>
                            </a>
                        </div>
                        <h2>{{ __('global.app_name') }}</h2>
                        <span>{{ __('global.app_description') }}</span>
                    </div>
                </div>
                <div class="ibox-content forum-container">
                    <div class="forum-title">
                        <div class="pull-right forum-desc">
                            <small>
                                {{ __('blog.posts.sum') . $allPostsCount }}<br>
                                {{  __('blog.comments.sum') . $allCommentsCount }}
                            </small>
                        </div>
                        <h3>{{ __('blog.subjects') }}</h3>
                    </div>
                    @foreach($categories as $category)
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="forum-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>
                                    <a href="{{ route('blog.show', $category->name_slug) }}" class="forum-item-title">
                                        {{ $category->name }}
                                    </a>
                                    <div class="forum-sub-title">
                                        {{ $category->description }}
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $category->posts_count }}
                                    </span>
                                    <div>
                                        <small>{{ __('blog.posts.quantity') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $category->comments_count }}
                                    </span>
                                    <div>
                                        <small>{{ __('blog.comments.quantity') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-last">
                                        @if (null !== $category->latestPost)
                                            <a href="{{ route('posts.show', $category->latestPost->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($category->latestPost->title, 12, '...') }}
                                            </a>
                                        @else
                                            --
                                        @endif
                                    </span>
                                    <div>
                                        <small>
                                            @if (null !== $category->latestPost)
                                                <a href="{{ route('users.show', $category->latestPost->user->name_slug) }}">
                                                    <span class="{{ ($category->latestPost->user->role === \App\Enums\UserRole::ADMIN) ? 'is-admin' : ''; }} if-admin-color">
                                                        {{ \Illuminate\Support\Str::limit($category->latestPost->user->name, 12, '...') }}
                                                    </span>
                                                </a>
                                                <br>
                                                {{ $category->latestPost->created_at->format('d-m-Y') }}
                                            @else
                                                {{ __('blog.posts.none_in_list') }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
