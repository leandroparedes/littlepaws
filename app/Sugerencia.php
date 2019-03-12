<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
    protected $fillable = [
        'id_user',
        'comentario'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }
}
