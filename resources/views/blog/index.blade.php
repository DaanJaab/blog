@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.messages_box')
            <div class="card">
            <div class="card-header">{{ __('Blog') }}</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Łączna liczba postów: {{ $postsCount }}</th>
                                <th>Łączna liczba komentarzy: {{ $commentsCount }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row"><a href="{{ route('blog.show', $category->name) }}">{{ $category->name }}</a></th>
                                    <th>Liczba postów: {{ $category->posts->count() }}</th>
                                    <th>
                                        @php
                                            if (null !== $category->posts->last()) {
                                                echo 'Najnowszy post napisano: '. $category->posts->last()->created_at . ', przez ' . $category->posts->last()->user->name;
                                            } else {
                                                echo 'Brak postów';
                                            }
                                        @endphp
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
