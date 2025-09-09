<?php

namespace App\Http\Controllers;

use App\Mail\Reserva;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingsController extends Controller
{
     public function addIngresso(Request $request){

        $user = Auth()->user();

        $ingresso = new Bookings();

        $ingresso->users_id = $user->id;
        $ingresso->_sessions_id = $request->sala;
        $ingresso->assentos = $request->assento;
        $ingresso->ocupado = true;

        if($ingresso->assentos == null){
            return response()->json([
                'mensagem' => 'Erro ao registrar o ingresso.',
                'erro' => true
            ]);
        }

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

    public function verificarAssento($lugar, $sessao){

        $assentoIgual = Bookings::where([
            ['assentos', '=', $lugar]
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

    public function addEmail(Request $request){

        $user = Auth()->user();

        $email = Mail::to($user->email, $user->name)->send(new Reserva([
            'nome' => $user->name
        ]));
    }
}
