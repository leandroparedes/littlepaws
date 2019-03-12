@extends('layouts/master')

@section('title', 'Promociones y descuentos')

@section('content')

    <h1>Productos con descuentos</h1><hr>

    @if (Session::has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{!! Session::get('status') !!}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-sm-6 col-md-4 producto mt-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top"   src={{ $producto->image_url }} alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <del class="card-text my-0">${{ $producto->precio }}</del>
                    <p class="my-0">Precio con descuento: ${{ round(intval($producto->precio) * ((100 - intval($producto->descuento)))/100) }}</p>
                        <small class="d-block mb-2 text-success">Descuento: - %{{ $producto->descuento }}</small>

                        @if ($producto->stock > 0)
                            <a href={{ route('producto.addToCart', ['id' => $producto->id])}} class="btn btn-primary btn-block">Añadir al carrito <i class="fas fa-shopping-cart"></i></a>
                        @else
                            <a href="#" class="btn btn-danger disabled btn-block">Producto sin stock</a>
                        @endif
                    </div>
                </div>
            </div>   
        @endforeach
    </div>

@endsection