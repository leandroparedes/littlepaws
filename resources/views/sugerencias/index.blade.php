@extends('layouts/master')

@section('title', 'Sugerencias')

@section('content')

    <h1 class="mb-4">Sugerencias</h1>
    <a href={{ route('sugerencias.create') }}>Publicar sugerencia</a>
    <hr><br>

    @if(count($sugerencias) <= 0)
        <h3>Actualmente no hay sugerencias</h3>
    @else
        <div class="row">
            <div class="col-12">
                <ul class="list-group">
                    @foreach ($sugerencias as $sug)
                        <li class="list-group-item sugerencia">
                            <strong class="d-block">{{$sug->user['nombre']}} {{$sug->user['apellido']}}</strong>
                            <small class="text-muted">Publicado el {{\Carbon\Carbon::parse($sug['created_at'])->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($sug['created_at'])->format('H:i:s')}}</small><br><br>
                            <p class="comentario">{{ $sug->comentario }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

@endsection