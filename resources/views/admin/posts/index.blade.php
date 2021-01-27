@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>titolo</th>
                        <th>slug</th>
                        <th>azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                <a href="{{ route('admin.posts.show', ['post' => $item->id]) }}" class="btn btn-info">Dettagli</a>

                                <a href="{{ route('admin.posts.edit', ['post' => $item->id]) }}" class="btn btn-warning">Modifica</a>

                                <form class="d-inline-block" action="{{ route('admin.posts.destroy', ['post' => $item->id]) }}" method="post">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="btn btn-danger">
                                       Elimina
                                   </button>
                               </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
