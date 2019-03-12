<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EntradaForo;
use App\CategoriaForo;
use App\ComentarioEntrada;
use Auth;

class ForoController extends Controller
{
    public function index () {
        $categorias = CategoriaForo::all();
        return view('foro/index', ['categorias' => $categorias]);
    }

    public function tema($id) {
        $data = EntradaForo::with('user', 'comentarios')->where('id_categoria_foro',$id)->orderBy('created_at', 'desc')->get();

        $nombreCategoria = CategoriaForo::find($id);

        if ($nombreCategoria == null) {
            return redirect()->back();
        } else {
            $nombreCategoria = $nombreCategoria->categoria;
        }

        $entradas = [];

        foreach($data as $d) {
            $comentarios = ComentarioEntrada::with('user')->where('id_entrada_foro', $d['id'])->get();
            $entradas[] = ['user' => $d['user'], 'entrada' => $d, 'comentarios' => $comentarios];
        }

        return view('foro/tema', ['entradas' => $entradas, 'idCategoria' => $id, 'nombreCategoria' => $nombreCategoria]);
    }

    public function create($id) {
        $categoriasForo = CategoriaForo::all();
        return view('foro/create', ['categoriasForo' => $categoriasForo, 'categoriaId' => $id]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required',
            'categoriasForo' => 'required'
        ]);

        $entradaForo = new EntradaForo([
            'id_user' => Auth::user()->id,
            'body' => $request->input('body'),
            'id_categoria_foro' => $request->input('categoriasForo')
        ]);

        $entradaForo->save();

        return redirect()->route('foro.tema', ['idCategoria' => $request->input('categoriasForo')]);
    }

    public function comentar(Request $request, $id) {
        $this->validate($request, [
            'comentario' => 'required'
        ]);

        $comentario = new ComentarioEntrada([
            'id_entrada_foro' => $id,
            'id_user' => Auth::user()->id,
            'comentario' => $request->input('comentario')
        ]);

        $comentario->save();

        return redirect()->back();
    }
}
