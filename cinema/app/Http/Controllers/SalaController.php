<?php

namespace App\Http\Controllers;

use App\Models\_sessions;
use App\Models\Bookings;
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

    public function edit($id){

        $salas = Room::find($id);

        return response()->json([
            $salas
        ]);
    }

    public function update(Request $request) {

        $data = $request->all();

        $sala = Room::findOrFail($request->id)->update($data);

        if($sala){
            return response()->json([
                'mensagem' => 'Sala editada com sucesso!',
                'erro' => false
            ]);
        } else {
            return response()->json([
                'mensagem' => 'Erro ao editar a sala.',
                'erro' => false
            ]);
        }
    }

    public function destroy(string $id){

        $sessao = _sessions::where([
            ['rooms_id', '=', $id]
        ])->get();
        
        $sala = Room::find($id);

        if(count($sessao) > 0){
            return response()->json([
                'mensagem' => 'Essa sala está vinculada há uma sessão. Por favor tente novamente.',
                'erro' => true
            ]);
        } else {
            if($sala->delete()){
                return response()->json([
                    'mensagem' => 'Sala removido com sucesso!',
                    'erro' => false
                ]);
            } else {
                return response()->json([
                    'mensagem' => 'Erro ao remover o sala!',
                    'erro' => true
                ]);
            }
        }
    }

    public function lugares(int $sala){

        $room = Room::find($sala);
        $ingresso = Bookings::all();

        return response()->json([
            'capacidade' => $room->capacidade,
            'itens' => $ingresso
        ]);
    }
}
