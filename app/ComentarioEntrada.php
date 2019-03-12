<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioEntrada extends Model
{
    protected $fillable = [
        'id_entrada_foro',
        'id_user',
        'comentario'
    ];

    function entradas() {
        return $this->belongsTo('App\EntradaForo', 'id_entrada_foro');
    }

    function user() {
        return $this->belongsTo('App\User', 'id_user');
    }
}
