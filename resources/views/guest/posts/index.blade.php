@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            <h1>Post Pubblici</h1>
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Docs</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://blog.laravel.com">Blog</a>
            <a href="https://nova.laravel.com">Nova</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://vapor.laravel.com">Vapor</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>

        <ul>
            @foreach ($posts as $item)
                <a href="{{ route('posts.show', ['post'=> $item->id]) }}">
                    <li>
                        {{ $item->title }}
                    </li>
                </a>
            @endforeach
        </ul>
@endsection
