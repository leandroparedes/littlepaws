@extends('layouts/master')

@section('title', 'Sugerencias')

@section('content')

    <h1 class="mb-4">Publicar sugerencia</h1>
    <hr><br>

    <form action={{ route('sugerencias.store') }} method="post">
        <div class="form-group">
            <textarea class="form-control" rows="5" placeholder="Escribir sugerencia..." name="comentario"></textarea>
        </div>
        <button type="submit" class="btn btn-success btn-lg d-block mb-3">Publicar</button>
        <a href={{ route('sugerencias.index') }}>Volver</a>
        {{ csrf_field() }}
    </form>

@endsection