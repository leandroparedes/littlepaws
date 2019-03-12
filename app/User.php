<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function compras() {
        return $this->hasMany('App\User', 'id_user');
    }

    function sugerencias() {
        return $this->hasMany('App\Sugerencia', 'id_user');
    }

    function entradasForo() {
        return $this->hasMany('App\EntradaForo', 'id_user');
    }

    function comentarios() {
        return $this->hasMany('App\ComentarioEntrada', 'id_user');
    }
}