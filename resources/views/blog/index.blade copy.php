@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.messages_box')
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <div>{{ __('blog.page_index_title') }}</div>
                            <div>{{ __('blog.page_index_description') }}</div>
                        </div>
                        <div class="col-md-1 offset-md-8">
                        <a href="{{ route('posts.create') }}">
                            <button class="btn btn-primary">
                                {{ __('Dodaj posta') }}
                            </button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            a
                        </div>
                        <div class="col-md-9">
                                <div class="float-end">
                                    {{__('blog.posts.sum') . $postsCount }}<br>
                                {{__('blog.comments.sum') . $commentsCount }}
                            </div>
                        </div>
                            @foreach($categories as $category)
                            <div class="col-md-3">
                                <div><a href="{{ route('blog.show', $category->name) }}">{{ $category->name }}</a></div>
                                <div>{{__('blog.posts.quantity') . $category->posts->count() }}</div>
                            </div>
                            <div class="col-md-9">
                                <div class="float-end">
                                    @if (null !== $category->posts->last())
                                    {{ $category->posts->last()->created_at . __('blog.by') . $category->posts->last()->user->name }}
                                    @else
                                    {{ __('blog.posts.none') }}
                                    @endif
                                </div>
                            </div>
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
