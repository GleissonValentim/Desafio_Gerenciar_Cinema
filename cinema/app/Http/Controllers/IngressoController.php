<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class IngressoController extends Controller
{
    public function reservar(string $id) {

        $movie = Movie::find($id);

        return view('ingressos.reservar_ingresso', ['movie' => $movie]);
    }
}
