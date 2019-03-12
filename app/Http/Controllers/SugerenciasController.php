<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sugerencia;
use Auth;

class SugerenciasController extends Controller
{
    public function index() {
        $sugerencias = Sugerencia::with('user')->get();
        return view('sugerencias/index', ['sugerencias' => $sugerencias]);
    }

    public function create() {
        return view('sugerencias/create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'comentario' => 'required'
        ]);

        $sugerencia = new Sugerencia([
            'id_user' => Auth::user()->id,
            'comentario' => $request->input('comentario')
        ]);
        $sugerencia->save();

        return redirect()->route('sugerencias.index');
    }
}
