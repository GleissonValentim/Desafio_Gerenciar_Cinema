<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class _sessions extends Model
{
    // Pertence a um filme
    public function movie() {
        return $this->belongsTo('App\Models\Movie');
    }

    // Pertence a uma sala
    public function sala() {
        return $this->belongsTo('App\Models\Room');
    }
}
