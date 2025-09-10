<?php

namespace App\Http\Controllers;

use App\Mail\Reserva;
use App\Models\_sessions;
use App\Models\Bookings;
use App\Models\Movie;
use App\Models\Room;
use DateTime;
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

        $sessao = _sessions::find($request->sala);
        $filme = Movie::find($sessao->movies_id);
        $sala = Room::find($sessao->rooms_id);
        $assentos = count($request->assentos);

        $subject = $filme->titulo.', '.$sala->nome.', '.DateTime::createFromFormat('Y-m-d', $sessao->data)->format('d/m/Y').', '.$sessao->horario.', '.$assentos.'assentos';

        $sent = Mail::to('gleisson8452@hotmail.com', 'Gleisson')->send(new Reserva([
            'email' => $user->email,
            'nome' => $user->name,
            'subject' => $subject
            // 'sala' => $sala->nome,
            // 'horario' => $sessao->horario,
            // 'data' => $sessao->data,
            // 'filme' => $filme->titulo,
            // 'assentos' => $assentos,
        ]));

        if($sent){
            return response()->json([
                'mensagem' => 'Ingressos registrados com sucesso! Um email de confirmação foi enviado.',
                'erro' => false
            ]);
        } else {
            return response()->json([
                'mensagem' => 'Erro ao registrar o ingresso',
                'erro' => false
            ]);
        }
    }
}
