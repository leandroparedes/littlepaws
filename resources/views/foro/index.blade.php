@extends('layouts/master')

@section('title', 'Foro')

@section('content')

    <h1 class="mb-4">Foros</h1>
    <hr><br>
    
    <div class="row mt-4">
        @foreach ($categorias as $categoria)
            <div class="col-md-4 text-center">
                <a href={{ route('foro.tema', ['idCategoria' => $categoria->id]) }}>
                    <h1 class="mb-5">{{ $categoria->categoria }}</h1>
                </a>
            </div>
        @endforeach
    </div>
@endsection