@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Modifica post {{ $post->id }}</h1>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg> Tutti i posts
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Titolo</label>
                    <input type="text" name="title" class="form-control" placeholder="Inserisci il titolo" value="{{old('title', $post->title) }}" required>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Contenuto</label>
                    <textarea name="content" class="form-control" rows="10" placeholder="Inizia a scrivere qualcosa..." required>{{old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control" name="category_id"> {{-- per inviare i dati con il form dobbiamo associare un name che sara' category_id perche' la categoria che seleziono nella select, andra' ad impostarsi nella colonna category_id della tabella posts --}}
                        <option value="">-- seleziona categoria --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id)  ? 'selected=selected' : '' }}> {{-- come value passo $category->id perche' deve collegarsi a category_id e definirlo --}}
                                {{ $category->name }} {{-- popolo la option con le varie categorie prese dal model Category --}}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <p>Tags</p>
                    @foreach ($tags as $tag)

                        @if($errors->any())
                            <input type="checkbox" name="tags_selected[]" value="{{$tag->id}}" {{ in_array($tag->id, old('tags_selected', [])) ? 'checked=checked' : ''}}> {{--verifico con in_array che $tag->id sia presente nell'array old('tags_selected'), se non e' presente, la funzione old utilizzera' il valore di fallback [] array vuoto in modo da non restituire errore se l'utente non ha selezionato nessun tag--}}
                        @else
                            <input type="checkbox" name="tags_selected[]" value="{{$tag->id}}"
                            {{ $post->tags->contains($tag) ? 'checked=checked' : '' }}> {{--controllo che nella collection $post->tags contiene il tag corrente?--}}
                        @endif
                        <label for="">{{$tag->name}}</label>
                    @endforeach
                    @error('tags_selected')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Salva post
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
