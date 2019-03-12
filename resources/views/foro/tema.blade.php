@extends('layouts/master')

@section('title', 'Foro | Perros')

@section('content')

    <h1 class="mb-4">[Foro] {{ $nombreCategoria }}</h1>
    <a href={{ route('foro.create', ['id' => $idCategoria]) }}>Publicar nueva entrada</a>
    <hr><br>

    @if (count($entradas) > 0)
        <ul class="list-group">
            @foreach ($entradas as $entrada)
                <li class="list-group-item mb-3">
                    <strong class="d-block">
                        {{ $entrada['user']['nombre'] }} {{ $entrada['user']['apellido'] }}
                    </strong>
                    <small class="text-muted">
                        Publicado el {{\Carbon\Carbon::parse($entrada['entrada']['created_at'])->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($entrada['entrada']['created_at'])->format('H:i:s')}}
                    </small><br><br>
                    <p>{{ $entrada['entrada']['body'] }}</p>
                    <hr>
                    <h6>Comentarios ({{ count($entrada['comentarios']) }})</h6>
                    @if (count($entrada['comentarios']) > 0)
                        <ul class="list-group comentario-container">
                            @foreach ($entrada['comentarios'] as $comentario)
                                <li class="list-group-item p-2">
                                    <strong class="d-block">
                                        {{ $comentario['user']['nombre'] }} {{ $comentario['user']['apellido'] }}
                                    </strong>
                                    <p class="pl-1 my-0 comentario">{{ $comentario['comentario'] }}</p>
                                    <small class="text-muted">Comentario publicado el {{ \Carbon\Carbon::parse($comentario['created_at'])->format('d/m/Y H:i:s') }}</small>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3">
                            @auth
                                <form action={{ route('foro.comentar', ['id' => $entrada['entrada']['id']]) }} method="post">
                                    <div class="form-row">
                                        <div class="form-group col-md-11">
                                            <input type="text" name="comentario" id="comentario" class="form-control form-control-sm" placeholder="Haz un comentario..." required>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button type="submit" class="btn btn-success btn-sm">Comentar</button>
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                </form>   
                            @endauth
                            @guest
                                <p>
                                    <strong>Debes <a href={{ route('user.signin') }}>iniciar sesión</a> para poder comentar. </strong>
                                </p>   
                            @endguest
                        </div>
                    @else
                        <p>No hay comentarios</p>
                        @auth
                            <form action={{ route('foro.comentar', ['id' => $entrada['entrada']['id']]) }} method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-11">
                                        <input type="text" name="comentario" id="comentario" class="form-control form-control-sm" placeholder="Haz un comentario..." required>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="submit" class="btn btn-success btn-sm">Comentar</button>
                                    </div>
                                </div>
                                {{ csrf_field() }}
                            </form>   
                        @endauth
                        @guest
                            <p>
                                <strong>Debes <a href={{ route('user.signin') }}>iniciar sesión</a> para poder comentar. </strong>
                            </p>   
                        @endguest
                    @endif  
                    
                </li>
            @endforeach
        </ul>
    @else
        <h3>No hay entradas recientes</h3>
    @endif
    
@endsection