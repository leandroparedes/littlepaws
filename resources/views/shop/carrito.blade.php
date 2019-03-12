@extends('layouts/master')

@section('title', 'Mi carrito')

@section('content')
    <h1 class="mb-4">Mi carrito de compras</h1>
    <hr><br>
    
    @if (Session::has('carrito'))
        <div class="row">
            <div class="col-12">
                <ul class="list-group">
                    @foreach ($productos as $producto)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-1">
                                    <img src={{$producto['item']['image_url'] }} alt="" class="img-carrito m-2">
                                </div>
                                <div class="col-10">
                                    <strong>{{ $producto['item']['nombre'] }}</strong>
                                    <p class="m-0"><span class="badge badge-primary ">Cantidad: {{ $producto['cantidad'] }}</span></p>
                                    <small class="d-block">Precio unitario: ${{ $producto['item']['precio'] }}</small>
                                    @if ($producto['item']['descuento'] > '0')
                                        <small class="d-block text-success">Descuento: -%{{ $producto['item']['descuento'] }}</small>
                                        <small class="d-block">Subtotal: ${{ round(intval($producto['item']['precio']) * ((100 - intval($producto['item']['descuento'])))/100) }}</small>
                                    @else
                                        <small class="d-block">Subtotal: ${{ $producto['precio'] }}</small>
                                    @endif
                                </div>
                                <div class="col-1">
                                    <div class="dropdown float-right pt-3">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">Acción <span class="caret"></span></button>
                                        <div class="dropdown-menu">
                                            <a href={{ route('producto.reduceByOne', ['id' => $producto['item']['id']]) }} class="dropdown-item">Eliminar 1</a>
                                            <a href={{ route('producto.removeAll', ['id' => $producto['item']['id']]) }} class="dropdown-item">Eliminar todo</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
                <h3 class="mt-4">Total: ${{ $precioTotal }}</h3 class="mt-3">
            </div>
            <div class="col-12">
                @auth
                <a class="btn btn-success mt-3" href={{ route('checkout') }} role="button">Pagar <i class="fas fa-credit-card"></i></a>
                @endauth

                @guest
                    <small class="d-block">Debes iniciar sesión para continuar al pago <a href={{ route('user.signin') }}>Iniciar sesión</a></small>
                @endguest
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <h3>No tienes productos en tu carrito. <a href={{ route('producto.index') }}>Ir al inicio</a></h3>
            </div>
        </div>
    @endif
@endsection