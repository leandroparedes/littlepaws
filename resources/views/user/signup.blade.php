@extends('layouts/master')

@section('title', 'Registrate')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Registrate</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('user.signup') }}" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="email" placeholder="Nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Aceptar</button>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection