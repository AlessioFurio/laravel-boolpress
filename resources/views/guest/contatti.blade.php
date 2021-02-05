@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content">
                    <div class="title m-b-md">
                        <h1>contatti</h1>
                    </div>

                    <form action="{{ route('contatti.sent') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" placeholder="Inserisci Nome" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Inserisci mail" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>messaggio</label>
                            <textarea name="message" rows="8" cols="80" placeholder="scrivi messaggio" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Invia">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
