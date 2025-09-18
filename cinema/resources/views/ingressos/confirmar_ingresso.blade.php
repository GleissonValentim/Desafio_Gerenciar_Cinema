@extends('layouts.app')

@section('title', 'Confirmar ingresso')

@section('content')

<h1 class="titulo text-center">Confirmar ingresso</h1>

@if($reservas)
    <form class="space-y-4 mt-10 queimar_ingresso" action="/ingressos/confirmar" method="POST" id="queimar_ingresso">
        @csrf
        <input type="hidden" name="id" value="{{ $reservas->id }}">
        <div>
            <label for="filme" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filme</label>
            <input type="text" name="filme" id="filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o titulo do filme" value="{{ $reservas->sessao->movie->titulo }}"  readonly required />
        </div>
        <div>
            <label for="sala" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sala</label>
            <input type="text" name="sala" id="sala" placeholder="Digite a descrição do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $reservas->sessao->sala->nome }}" readonly required />
        </div>
        <div>
            <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
            <input type="date" name="data" id="edit_data" placeholder="Digite a data do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $reservas->sessao->data }}" readonly required />
        </div>
        <div>
            <label for="horario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Horário</label>
            <input type="time" name="horario" id="horario" placeholder="Digite a data do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $reservas->sessao->horario }}" readonly required />
        </div>
        <div>
            <label for="assento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assento</label>
            <input type="text" name="assento" id="assento" placeholder="Digite a data do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $reservas->assentos }}" readonly required />
        </div>
        <div class="flex justify-end mt-5">
            <button class="button_cadastrar">Validar reserva</button>
        </div>
    </form>
@else
    <p class="text-center mt-10">Não há reservas disponiveis</p>
@endif

@endsection