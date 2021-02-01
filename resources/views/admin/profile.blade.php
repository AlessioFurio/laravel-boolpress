@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>i miei dati</h1>
                    <ul>
                        <li>Nome: {{ Auth::user()->name }}</li>
                        <li>Mail: {{ Auth::user()->email }}</li>
                        @if (Auth::user()->api_token)
                            <li>Api Token: {{ Auth::user()->api_token }}</li>
                        @else
                            <form class="" action="{{ route('admin.generate_token') }}" method="post">
                                @csrf
                                <button type="submit" name="button">Genera token</button>
                            </form>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
