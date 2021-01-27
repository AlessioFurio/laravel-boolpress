@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Dettagli</h1>
            <ul>
                    <li>Titolo: {{ $post->title }}</li>
                    <li>Contenuto: {{ $post->content }}</li>
                    <li>Slug: {{ $post->slug }}</li>
                    <li>Categoria: {{$post->category != null ? $post->category->name : 'Nessuna Categoria' }}</li>
            </ul>

        </div>
    </div>
</div>
@endsection
