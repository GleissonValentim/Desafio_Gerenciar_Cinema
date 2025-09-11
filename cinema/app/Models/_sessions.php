<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class _sessions extends Model
{

    // Permite que eu possa atualizar tudo
    protected $guarded = [];

    use Notifiable;
    
    // Pertence a um filme
    public function movie() {
        return $this->belongsTo(Movie::class, 'movies_id');
    }

    // Pertence a uma sala
    public function sala() {
        return $this->belongsTo(Room::class, 'rooms_id');
    }

    // Pertence a muitos ingressos
    public function sessoes() {
        return $this->belongsToMany('App\Models\Bookings');
    }
}
