@extends('layouts.app')

@section('title', 'HDC Events')

@section('content')

<h1 class="titulo">Histórico de reservas</h1>

@if(count($reservas) == 0)
    <p class="text-center">Não há nenhum histórico de reservas anteriores</p>
@else
    <div class="tabela">
        <table class="mt-10">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Filme</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Assentos</th>
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $reserva->sessao->movie->titulo }}</td>
                        <td>{{ $reserva->sessao->sala->nome }}</td>
                        <td>{{ $reserva->assentos }}</td>
                        <td>{{ DateTime::createFromFormat('Y-m-d', $reserva->sessao->data)->format('d/m/Y') }}</td>
                        <td>{{ $reserva->sessao->horario }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginação -->
        <div class="mt-10">
            {{ $reservas->links() }}
        </div>
    </div>
@endif

@endsection