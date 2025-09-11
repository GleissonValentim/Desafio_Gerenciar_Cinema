<?php

namespace App\Http\Controllers;

use App\Models\_sessions;
use App\Models\Movie;

class IngressoController extends Controller
{
    public function reservar(string $id) {

        $movie = Movie::find($id);

        $sessoes = _sessions::where([
            ['movies_id', '=', $movie->id]
        ])->paginate(5);

        return view('ingressos.reservar_ingresso', ['movie' => $movie, 'sessoes' => $sessoes]);
    }
}
