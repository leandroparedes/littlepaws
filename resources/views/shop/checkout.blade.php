@extends('layouts/master')

@section('title', 'Finalizando pago')

@section('content')
    <h1 class="mb-4">Pago</h1>
    <h4>Total de la compra: ${{ $total }}</h4>
    <hr><br>

    <h4 class="mb-3">Información del pago</h4   >
    <form action={{ route('checkout') }} method="post" class="form">
        <div class="form-row">
            <div class="form-group col-md-8 col-sm-12">
                <label for="nroTarjeta">Número de tarjeta</label>
                <input type="text" class="form-control" id="nroTarjeta" name="nroTarjeta" placeholder="XXXX-XXXX-XXXX" required>
            </div>
            <div class="form-group col-md-2 col-sm-12">
                <label for="codTarjeta">Código de tarjeta</label>
                <input type="text" class="form-control" id="codTarjeta" name="codTarjeta" placeholder="XXX" required>
            </div>
            <div class="form-group col-md-2 col-sm-12">
                <label for="fechaExpiracion">Fecha de expiración</label>
                <input type="text" class="form-control" id="fechaExpiracion" name="fechaExpiracion" placeholder="DD/MM" required>
            </div>
            <div class="form-group col-12">
                <label for="direccionDespacho">Direccion de despacho</label>
                <input type="text" class="form-control" id="direccionDespacho" name="direccionDespacho" placeholder="Ingrese su dirección de despacho" required>
            </div>
            <div class="form-group col-12">
                <button type="submit" class="btn btn-success btn-lg mt-3">Finalizar pago</button>
            </div>
        </div>

        {{ csrf_field() }}
    </form>
@endsection