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
    public function getReservas() {

        $reservas = Bookings::paginate(15);

        return view('adm.reservas', ['reservas' => $reservas]);
    }

    public function getReservasCliente() {

        $user = Auth()->user();

        $reservas = Bookings::where([
            ['users_id', '=', $user->id]
        ])->paginate(15);

        return view('clientes.reserva', ['reservas' => $reservas]);
    }

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

            $sessao = _sessions::find($ingresso->_sessions_id);
            $filme = Movie::find($sessao->movies_id);
            $sala = Room::find($sessao->rooms_id);

            $subject = 'Confirmação dos ingressos para o filme '.$filme->titulo;

            $sent = Mail::to('gleisson8452@hotmail.com', 'Gleisson')->send(new Reserva([
                'email' => $user->email,
                'nome' => $user->name,
                'subject' => $subject,
                'data' => DateTime::createFromFormat('Y-m-d', $sessao->data)->format('d/m/Y'),
                'sala' => $sala->nome,
                'horario' => $sessao->horario,
                'filme' => $filme->titulo,
                'assentos' => $ingresso->assentos,
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
        } else {
            return response()->json([
                'mensagem' => 'Erro ao registrar o ingresso.',
                'erro' => true
            ]);
        }

        // if($ingresso->save()){
        //     return response()->json([
        //         'mensagem' => 'Ingresso registrado com sucesso!',
        //         'erro' => false
        //     ]);
        // } else {
        //     return response()->json([
        //         'mensagem' => 'Erro ao registrar o ingresso.',
        //         'erro' => true
        //     ]);
        // }
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

    public function destroyCliente($id) {

        $reserva = Bookings::find($id);

        if($reserva->delete()){
            return response()->json([
                'mensagem' => 'Reserva cancelada com sucesso!',
                'erro' => false
            ]);
        } else {
            return response()->json([
                'mensagem' => 'Erro ao cancelar a reserva!',
                'erro' => true
            ]);
        }
    }

    public function destroy($id) {

        $reserva = Bookings::find($id);

        if($reserva->delete()){
            return response()->json([
                'mensagem' => 'Reserva removida com sucesso!',
                'erro' => false
            ]);
        } else {
            return response()->json([
                'mensagem' => 'Erro ao remover a reserva!',
                'erro' => true
            ]);
        }
    }

    // public function addEmail(Request $request){

    //     $user = Auth()->user();

    //     $sessao = _sessions::find($request->sala);
    //     $filme = Movie::find($sessao->movies_id);
    //     $sala = Room::find($sessao->rooms_id);

    //     $subject = 'Confirmação dos ingressos para o filme '.$filme->titulo;

    //     $sent = Mail::to('gleisson8452@hotmail.com', 'Gleisson')->send(new Reserva([
    //         'email' => $user->email,
    //         'nome' => $user->name,
    //         'subject' => $subject,
    //         'data' => DateTime::createFromFormat('Y-m-d', $sessao->data)->format('d/m/Y'),
    //         'sala' => $sala->nome,
    //         'horario' => $sessao->horario,
    //         'filme' => $filme->titulo,
    //         'assentos' => $request->cadeiras,
    //     ]));

    //     if($sent){
    //         return response()->json([
    //             'mensagem' => 'Ingressos registrados com sucesso! Um email de confirmação foi enviado.',
    //             'erro' => false
    //         ]);
    //     } else {
    //         return response()->json([
    //             'mensagem' => 'Erro ao registrar o ingresso',
    //             'erro' => false
    //         ]);
    //     }
    // }
}
