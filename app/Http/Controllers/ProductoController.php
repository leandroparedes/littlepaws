<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\Carrito;
use App\Compra;
use App\CompraProducto;
use Session;
use Auth;
use Carbon\Carbon;

class ProductoController extends Controller {
    
    public function index() {
        $productos = Producto::all();
        $categorias = Categoria::all();

        return view('shop/index', ['productos' => $productos, 'categorias' => $categorias]);
    }

    public function addToCart(Request $request, $id) {
        $producto = Producto::find($id);
        $oldCart = Session::has('carrito') ? Session::get('carrito') : null;

        $carrito = new Carrito($oldCart);
        $carrito->add($producto, $producto->id);

        $request->session()->put('carrito', $carrito);
        Session::flash('status', 'Producto añadido al carrito');
        return redirect()->back();
    }

    public function carrito() {
        if (!Session::has('carrito')) {
            return view('shop/carrito', ['productos' => null]);
        }

        $oldCart = Session::get('carrito');
        $cart = new Carrito($oldCart);
        return view('shop/carrito', ['productos' => $cart->items, 'precioTotal' => $cart->precioTotal]);
    }

    public function getCheckout() {
        if (!Session::has('carrito')) {
            return view('shop/carrito', ['productos' => null]);
        }

        $oldCart = Session::get('carrito');
        $cart = new Carrito($oldCart);
        $total = $cart->precioTotal;
        return view('shop/checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request) {
        if (!Session::has('carrito')) {
            return view('producto.index');
        }

        //generamos una compra
        $compra = new Compra;
        $compra->fecha = Carbon::now()->toDateTimeString();
        $compra->total = Session::get('carrito')->precioTotal;
        $compra->id_usuario = Auth::user()->id;
        $compra->save();

        $carrito = Session::get('carrito')->items;

        foreach($carrito as $item) {
            $compraProducto = new CompraProducto();
            $compraProducto->id_compra = $compra->id;
            $compraProducto->id_producto = $item['item']['id'];
            $compraProducto->cantidad = $item['cantidad'];
            $compraProducto->subtotal = $item['precio'];
            $compraProducto->save();

            $producto = Producto::find($item['item']['id']);
            $producto->stock -= ($item['cantidad'] > $producto->stock ? $producto->stock : $item['cantidad']);
            $producto->save();
        }

        Session::flash('status', 'Compra realizada con éxito por un total de $' . Session::get('carrito')->precioTotal);

        //borramos el carrito
        $request->session()->forget('carrito');

        return redirect()->route('producto.index');
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('carrito') ? Session::get('carrito') : null;
        $cart = new Carrito($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('carrito', $cart);
        } else {
            Session::forget('carrito');
        }

        return redirect()->route('producto.carrito');
    }

    public function getRemoveAll($id) {
        $oldCart = Session::has('carrito') ? Session::get('carrito') : null;
        $cart = new Carrito($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('carrito', $cart);
        } else {
            Session::forget('carrito');
        }

        return redirect()->route('producto.carrito');
    }

    public function promociones() {
        $productos = Producto::where('descuento', '>', '0')->get();
        return view('shop/promociones', ['productos' => $productos]);
    }

    public function filtrar(Request $request, Producto $producto) {
        $producto = $producto->newQuery();
        
        if ($request->filled('producto')) {
            $producto->where('nombre', $request->producto)->orWhere('nombre', 'like', '%' . $request->producto . '%');
        }

        if ($request->selectCategoria != '0') {
            $producto->where('id_categoria', $request->selectCategoria);
        }

        $categorias = Categoria::all();
        return view('shop/index', ['productos' => $producto->get(), 'categorias' => $categorias]);
    }
}
