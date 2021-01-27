@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Dettagli</h1>
            <ul>
                    <li>{{ $post->title }}</li>
                    <li>{{ $post->content }}</li>
                    <li>{{ $post->slug }}</li>
            </ul>

        </div>
    </div>
</div>
@endsection
