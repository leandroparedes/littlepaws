@extends('layouts/master')

@section('title', 'Inicia sesión')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Iniciar sesión</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('user.signin') }}" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection