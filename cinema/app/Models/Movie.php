<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    
    protected $dates = ['date'];

    // Permite que eu possa atualizar tudo
    protected $guarded = [];

    // Pertence a muitas sessoes
    public function sessoes() {
        return $this->belongsToMany('App\Models\Sessions');
    }
}
