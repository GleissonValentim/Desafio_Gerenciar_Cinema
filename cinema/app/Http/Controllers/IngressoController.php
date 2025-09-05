<?php

namespace App\Http\Controllers;

use App\Models\_sessions;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Room;

class IngressoController extends Controller
{
    public function reservar(string $id) {

        $movie = Movie::find($id);

        $sessoes = _sessions::where([
            ['movies_id', '=', $movie->id]
        ])->get();

        return view('ingressos.reservar_ingresso', ['movie' => $movie, 'sessoes' => $sessoes]);
    }
}
