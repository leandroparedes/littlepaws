<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Compra;
use App\CompraProducto;
use Auth;
use Session;

class UserController extends Controller {

    public function getSignup() {
        return view('user/signup');
    }

    public function postSignup(Request $request) {
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);

        $user = new User([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->save();

        Auth::login($user);

        return redirect()->action('ProductoController@index');
    }

    public function getSignin() {
        return view('user/signin');
    }

    public function postSignin(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            return redirect()->route('producto.promociones');
        }

        return redirect()->back();
    }

    public function profile() {
        $compras = Compra::where('id_usuario', Auth::user()->id)->get();
        $totalCompras = [];
        foreach($compras as $compra) {

            $totalCompras[] = [
                'id' => $compra['id'],
                'fecha' => $compra['fecha'],
                'total' => $compra['total']
            ];

        }

        $user = User::find(Auth::user()->id);
        return view('user/profile', ['totalCompras' => $totalCompras, 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed'
        ]);

        $user = User::find($id);

        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return back();
    }

    public function getLogout(Request $request) {
        Auth::logout();
        if (Session::has('carrito')) $request->session()->forget('carrito');
        return redirect()->route('user.signin');
    }
}
