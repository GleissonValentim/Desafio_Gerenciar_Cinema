<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class AdmController extends Controller
{

    public function getFilmes() {

        $movies = Movie::all();

        return view('adm.filmes', ['movies' => $movies]);
    }

    public function addFilme(Request $request) {

        $movie = new Movie();

        $movie->titulo = $request->titulo;
        $movie->descricao = $request->descricao;
        $movie->genero = $request->genero;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/movies'), $imageName);

            $movie->image = $imageName;
        }

        $movie->save();

        return redirect('/adm/filmes')->with('msg', 'Evento criado com sucesso!', ['movies' => $movie]);
        // $menssagem = ["menssagem" => "Por favor preencha todos os campos!", "erro" => true];

        // header('Content-Type: aplication/json');
        // echo json_encode($menssagem);
    }
}
