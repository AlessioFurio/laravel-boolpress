@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Creazione nuovo post</h1>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
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

            <form action="{{ route('admin.posts.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Titolo</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Inserisci il titolo" required> {{--la funzione old() mi permette di "salvare i dati dell' utente e mostrarglieli anche se la creazione del post fallisce in modo da non dover ricompilare i campi"--}}
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">
                    <label>Contenuto</label>
                    <textarea name="content" class="form-control" rows="10" placeholder="Inizia a scrivere qualcosa..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control" name="category_id"> {{-- per inviare i dati con il form dobbiamo associare un name che sara' category_id perche' la categoria che seleziono nella select, andra' ad impostarsi nella colonna category_id della tabella posts --}}
                        <option value="">-- seleziona categoria --</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected=selected' : ''}}> {{-- come value passo $category->id perche' deve collegarsi a category_id e definirlo --}}
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
                        <input type="checkbox" name="tags_selected[]" value="{{$tag->id}}" {{ in_array($tag->id, old('tags_selected', [])) ? 'checked=checked' : ''}}> {{--verifico con in_array che $tag->id sia presente nell'array old('tags_selected'), se non e' presente, la funzione old utilizzera' il valore di fallback [] array vuoto in modo da non restituire errore se l'utente non ha selezionato nessun tag--}}
                        <label for="">{{$tag->name}}</label>
                    @endforeach
                    @error('tags_selected')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Crea post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
