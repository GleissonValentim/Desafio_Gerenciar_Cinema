<?php

namespace App\Http\Controllers;

use App\Models\_sessions;
use App\Models\Bookings;
use App\Models\Movie;
use App\Models\Room;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    public function getSessoes(){

        $sessoes = _sessions::paginate(15);
        $filmes = Movie::all();
        $salas = Room::all();

        return view('adm.sessoes', ['sessoes' => $sessoes, 'filmes' => $filmes, 'salas' => $salas]);
    }

    public function addSessao(Request $request) {

        $sessao = new _sessions();

        $sessao->horario = $request->horario;
        $sessao->movies_id = $request->filme;
        $sessao->rooms_id = $request->sala;
        $sessao->preco = $request->preco;
        $sessao->data = $request->data;

        $sessaoIgual = _sessions::where([
            ['horario', '=', $sessao->horario]
        ])->where([['rooms_id', '=', $sessao->rooms_id]])
          ->where([['data', '=', $sessao->data]])->get();

        $movieData = Movie::where([
            ['id', '=', $sessao->movies_id]
        ])->where([['data', '>', $sessao->data]])->get();

        if(count($movieData) > 0){
            return response()->json([
                'mensagem' => 'Você não pode cadastrar uma data anterior a data de exibição do filme',
                'erro' => true
            ]);
        } else {
            if(count($sessaoIgual) > 0){
                return response()->json([
                    'mensagem' => 'Você não pode cadastrar mais de uma sessão na memsa data, horário e sala ao mesmo tempo',
                    'erro' => true
                ]);
            } else {
                if($sessao->save()){
                    return response()->json([
                        'mensagem' => 'Sessão cadastrada com sucesso!',
                        'erro' => false
                    ]);
                } else {
                    return response()->json([
                        'mensagem' => 'Erro ao cadastrar a sessão. Por favor tente novamente.',
                        'erro' => true
                    ]);
                }
            }
        }
    }

    public function edit($id){

        $sessoes = _sessions::find($id);

        return response()->json([
            $sessoes
        ]);
    }

    public function destroy(string $id){

        $sessao = _sessions::find($id);

        $reservas = Bookings::where([
            ['_sessions_id', '=', $sessao->id]
        ])->get();

        if(count($reservas) > 0){
            return response()->json([
                'mensagem' => 'Você não pode deletar essa sessão pois há reservas ativas cadastradas nessa mesma sessão.',
                'erro' => true
            ]);
        } else {
            if($sessao->delete()){
                return response()->json([
                    'mensagem' => 'Sessão removida com sucesso!',
                    'erro' => false
                ]);
            } else {
                return response()->json([
                    'mensagem' => 'Erro ao remover a sessão!',
                    'erro' => true
                ]);
            }
        }
    }
}
