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
                            <a href="{{ route('blog.posts.create', $category->name_slug) }}">
                                <button class="btn btn-primary">
                                    {{ __('blog.buttons.add_post_in_this_category') }}
                                </button>
                            </a>
                        </div>
                        <h2><a href="{{ route('blog.index') }}">{{ __('global.blog_page') }}</a> -&rsaquo; {{ $category->name }}</h2>
                        <span>{{ $category->description }}</span>
                    </div>
                </div>
                <a class="pagination">{{ $posts->onEachSide(1)->links() }}</a>
                @forelse ($posts as $post)
                    @php
                        $admin_color = ($post->user->role === \App\Enums\UserRole::ADMIN) ? 'is-admin' : '';
                    @endphp
                    <div class="ibox-content forum-container posts {{ $admin_color }}">
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="forum-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>
                                    <a href="{{ route('posts.show', $post->slug) }}" class="forum-item-title">{{ $post->title }}</a>
                                    <div class="forum-sub-title">{{ __('blog.posts.by') }}
                                        <a href="{{ route('users.show', $post->user->name_slug) }}">
                                            <span class="{{ $admin_color }} if-admin-color">{{ $post->user->name }}</span>
                                        </a>
                                        {{ __('blog.posts.create_date') . $post->created_at->format('d-m-Y') }}
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-number">
                                        {{ $post->comments_count }}
                                    </span>
                                    <div>
                                        <small>{{ __('blog.comments.quantity') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 forum-info">
                                    <span class="views-last">
                                        @if (null !== $post->latestComment)
                                            <a href="{{ route('users.show', $post->latestComment->user->name_slug) }}">
                                                <span class="{{ ($post->latestComment->user->role === \App\Enums\UserRole::ADMIN) ? 'is-admin' : ''; }} if-admin-color">{{ \Illuminate\Support\Str::limit($post->latestComment->user->name, 12, '...') }}</span>
                                            </a>
                                        @else
                                            --
                                        @endif
                                    </span>
                                    <div>
                                        <small>
                                            @if (null !== $post->latestComment)
                                                {{ $post->latestComment->created_at->format('d-m-Y') }}
                                            @else
                                                {{ __('blog.comments.none') }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="row mb-0">
                        <label for="description" class="col-form-label text-md-center">{{ __('blog.posts.none_in_category') }}</label>
                    </div>
                @endforelse
                <a class="pagination">{{ $posts->onEachSide(1)->links() }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
