<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    // Pertence a muitas sessoes
    public function sessoes() {
        return $this->belongsToMany('App\Models\Sessions');
    }
}
