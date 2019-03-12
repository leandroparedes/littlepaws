<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    function user() {
        return $this->belongsTo('App\Compra', 'id');
    }
}
