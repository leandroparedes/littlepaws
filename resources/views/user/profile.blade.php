@extends('layouts/master')

@section('title', 'Mi cuenta')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Mi cuenta de usuario</h1>
        <hr><br>
        <h3>Mis datos</h3><br>

        <form method="post" action={{route('user.update', $user->id)}}>
            {{ csrf_field() }}
            {{ method_field('patch') }}

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre"  value="{{ $user->nombre }}" class="form-control"/>
            </div>

            <div class="form-group">
                <input type="text" name="apellido"  value="{{ $user->apellido }}" class="form-control"/>
            </div>

            <div class="form-group">
                <input type="email" name="email"  value="{{ $user->email }}" class="form-control"/>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña"/>
                </div>
                <div class="form-group col-md-6">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña"/>
                </div>
            </div>
        
            <button type="submit" class="btn btn-success">Confirmar cambios</button>
        </form><br><hr>

        <h3>Mis compras</h3><br>
        @if (count($totalCompras) > 0)
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($totalCompras as $compra)
                        <tr>
                            <th>{{ $compra['id'] }}</th>
                            <td>{{ $compra['fecha'] }}</td>
                            <td>${{ $compra['total'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h5>No tienes compras registradas</h5>
        @endif
    </div>
</div>
@endsection