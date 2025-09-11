<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    // Permite que eu possa atualizar tudo
    protected $guarded = [];
    
    // Pertence a muitas sessoes
    public function sessoes() {
        return $this->belongsToMany('App\Models\_sessions');
    }
}
