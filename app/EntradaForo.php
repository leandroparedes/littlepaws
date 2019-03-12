<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaForo extends Model
{
    protected $fillable = [
        'id_user',
        'body',
        'id_categoria_foro'
    ];

    function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    function comentarios() {
        return $this->hasMany('App\ComentarioEntrada', 'id_entrada_foro');
    }
}
