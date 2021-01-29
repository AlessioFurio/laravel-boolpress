@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
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

                <strong>qui stampo nome categoria</strong>
                <h1>La categoria: {{ $category->name }}</h1>

                <strong>I post relativi a questa categoria sono:</strong>
                <ul>
                @foreach ($category->posts as $item)
                    <li>
                        {{$item->title }}
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
