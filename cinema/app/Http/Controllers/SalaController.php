<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class SalaController extends Controller
{
    public function getSalas(){

        $salas = room::all();
        return view('adm.salas', ['salas' => $salas]);
    }

    public function addSalas(Request $request) {

        $sala = new Room();

        $sala->nome = $request->nome;
        $sala->capacidade = $request->capacidade;

        $nome = Room::where([
            ['nome', '=', $sala->nome]
        ])->get();

        if(count($nome) > 0){
            return response()->json([
                'mensagem' => 'Essa sala já foi cadastrada. Por favor tente novamente.',
                'erro' => true
            ]);
        } else {
            if($sala->save()){
                return response()->json([
                    'mensagem' => 'Sala cadastrada com sucesso!',
                    'erro' => false
                ]);
            } else {
                return response()->json([
                    'mensagem' => 'Erro ao cadastrar a sala. Por favor tente novamente.',
                    'erro' => true
                ]);
            }
        }
    }

    public function destroy(string $id){

        $sala = Room::find($id);

        $sala->delete($id);
        
        $menssagem = ["menssagem" => "Por favor preencha todos os campos!", "erro" => true];

        header('Content-Type: aplication/json');
        echo json_encode($menssagem);
    }
}
