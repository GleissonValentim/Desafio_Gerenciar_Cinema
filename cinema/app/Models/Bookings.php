<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    // Pertence a uma sessão
    public function sessao() {
        return $this->belongsTo(_sessions::class, '_sessions_id');
    }

    // Pertence a um usuario
    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }
}
