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
                <h1>titolo Post: {{ $post->title }}</h1>
                <p>{{ $post->content }}</p>

                @if ($post->category != null) {{--mi assicuro che la categoria sia associata ad un post, altrimenti se fosse null mi darebbe errore nella generazione del link qui sotto--}}

                {{-- quando scrivo $post->category, posso omettere le parentesi () x riferirmi alla funzione presente nel model Post, perche' sto gia' accedendo all' istanza della categoria associata al post in questione e se faccio dd($post->category) vedro' che mi restituisce un oggetto che rappresenta la categoria collegata al post, quindi con ->name accedo al nome della categoria --}}

                    <a href="{{ route('categories.show', ['slug' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                @else
                    <p>Nessuna Categoria</p>
                @endif

                <p>I Tags sono: </p>
                    <ul>
                        @forelse ($post->tags as $item) {{--ciclo la collection $post->tags--}}
                            <li>{{ $item->name }}</li>
                        @empty
                            <p>Nessun Tag</p>
                        @endforelse
                    </ul>
            </div>
        </div>
    </div>

@endsection
