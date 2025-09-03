<?php

namespace App\Http\Controllers;

use App\Models\_sessions;
use App\Models\Movie;
use DateTime;
use Illuminate\Http\Request;

class MovieController extends Controller
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
        $movie->classificacao = $request->classificacao;
        $movie->data = $request->data;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/movies'), $imageName);

            $movie->image = $imageName;
        }

        $titulo = Movie::where([
            ['titulo', '=', $movie->titulo]
        ])->get();

        if(count($titulo) > 0){
            return response()->json([
                    'mensagem' => 'Esse filme já foi cadastrado. Por favor tente novamente.',
                    'erro' => true
                ]);
        } else {
            if($movie->save()){
                return response()->json([
                    'mensagem' => 'Filme cadastrado com sucesso!',
                    'erro' => false
                ]);
            }else{
                return response()->json([
                    'mensagem' => 'Erro ao cadastrar o filme. Por favor tente novamente.',
                    'erro' => true
                ]);
            }
        }
    }

    public function update(Request $request){

      
        return response()->json([
            'mensagem' => 'Filme removido com sucesso!',
            'erro' => false
        ]);
    }

    public function destroy($id){

        $sessao = _sessions::where([
            ['movies_id', '=', $id]
        ])->get();
        
        $movie = Movie::find($id);

        if(count($sessao) > 0){
            return response()->json([
                'mensagem' => 'Esse filme está vinculado há uma sessão. Por favor tente novamente.',
                'erro' => true
            ]);
        } else {
            if($movie->delete()){
                return response()->json([
                    'mensagem' => 'Filme removido com sucesso!',
                    'erro' => false
                ]);
            } else {
                return response()->json([
                    'mensagem' => 'Erro ao remover o filme!',
                    'erro' => true
                ]);
            }
        }
    }
}
