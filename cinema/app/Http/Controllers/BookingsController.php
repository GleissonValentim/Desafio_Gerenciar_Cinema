<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
     public function addIngresso(Request $request){

        $user = Auth()->user();

        $ingresso = new Bookings();

        $ingresso->users_id = $user->id;
        $ingresso->_sessions_id = $request->sala;
        $ingresso->assentos = $request->assento;

        if($ingresso->save()){
            return response()->json([
                'mensagem' => 'Ingresso registrado com sucesso!',
                'erro' => false
            ]);
        } else {
            return response()->json([
                'mensagem' => 'Erro ao registrar o ingresso.',
                'erro' => true
            ]);
        }
    }

    public function verificarAssento($assento, $sessao){

        $assentoIgual = Bookings::where([
            ['assentos', '=', $assento]
        ])->where([['_sessions_id', '=', $sessao]])->get();

        if(count($assentoIgual) > 0){
            return response()->json([
                'mensagem' => 'Esse assento já foi ocupado',
                'erro' => true
            ]);
        } else {
            return response()->json([
                'mensagem' => 'Assento livre',
                'erro' => false
            ]);
        }
    }
}
