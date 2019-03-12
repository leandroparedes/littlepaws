@extends('layouts/master')

@section('title', 'Foro')

@section('content')

    <h1 class="mb-4">Crear nueva entrada en el foro</h1>
    <hr><br>

    <form action={{ route('foro.store') }} method="post">
        <div class="form-group">
            <label for="categoriasForo">Seleccione una categoria</label>
            <select name="categoriasForo" id="categoriasForo" class="form-control">
                @foreach ($categoriasForo as $categoria)
                    @if ($categoria->id == $categoriaId)
                        <option value={{ $categoria->id }} selected>{{ $categoria->categoria }}</option>
                    @else
                        <option value={{ $categoria->id }}>{{ $categoria->categoria }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="5" placeholder="Escribir entrada..." name="body" id="body"></textarea>
        </div>
        <button type="submit" class="btn btn-success btn-lg d-block mb-3">Publicar entrada</button>
        <a href={{ route('foro.index') }}>Volver</a>
        {{ csrf_field() }}
    </form>
@endsection