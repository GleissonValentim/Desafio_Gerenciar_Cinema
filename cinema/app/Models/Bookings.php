<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    // Pertence a uma sessão
    public function sessao() {
        return $this->belongsTo('App\Models\_sessions');
    }

    // Pertence a um usuario
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
