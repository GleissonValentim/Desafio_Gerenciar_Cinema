<?php

namespace App\Http\Controllers;

use App\Models\_sessions;
use App\Models\Movie;
use App\Models\Room;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    public function getSessoes(){

        $sessoes = _sessions::all();
        $filmes = Movie::all();
        $salas = Room::all();

        $sala = [];
        foreach($filmes as $filme){
            $sala[$filme->id] = Movie::find($filme->id);
        }

        return view('adm.sessoes', ['sessoes' => $sessoes, 'filmes' => $filmes, 'salas' => $salas, 'salass' => $sala]);
    }

    public function addSessao(Request $request) {

        $sessao = new _sessions();

        $sessao->horario = $request->horario;
        $sessao->movies_id = $request->filme;
        $sessao->rooms_id = $request->sala;

        $horarioIgual = _sessions::where([
            ['horario', '=', $sessao->horario]
        ])->get();

        $salaIgual = _sessions::where([
            ['rooms_id', '=', $sessao->rooms_id]
        ])->get();

        if(count($horarioIgual) > 0 && count($salaIgual) > 0){
            return response()->json([
                'mensagem' => 'Voçê não pode cadastrar uma sessão no mesmo hórario e na mesma sala ao mesmo tempo',
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
