<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Room;
use Illuminate\Http\Request;

class AdmController extends Controller
{

    public function dashboard() {

        $movies = Movie::all();

        return view('dashboard', ['movies' => $movies]);
    }

    public function home() {

        $movies = Movie::all();

        return view('home', ['movies' => $movies]);
    }

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

    public function destroy(string $id){

        // if(Auth::user()){
        //     if(Auth::user()->id == $user->id){
        //         return back()->route('users.index')->with('message', 'você não pode deletar o seu próprio perfil');
        //     }
        // }

        $movie = Movie::find($id);

        $movie->delete();
        return redirect('/adm/filmes');
    }

    public function getSalas(){

        $salas = room::all();
        return view('adm.salas', ['salas' => $salas]);
    }

    public function addSalas(Request $request) {

        $sala = new Room();

        $sala->nome = $request->nome;
        $sala->capacidade = $request->capacidade;

        $sala->save();

        return redirect('/adm/salas')->with('msg', 'Evento criado com sucesso!', ['salas' => $sala]);
        // $menssagem = ["menssagem" => "Por favor preencha todos os campos!", "erro" => true];

        // header('Content-Type: aplication/json');
        // echo json_encode($menssagem);
    }
}
