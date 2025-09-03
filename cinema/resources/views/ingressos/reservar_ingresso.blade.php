@extends('layouts.app')

@section('title', 'Reservar ingresso')

@section('content')

    <div class="info-ingresso mt-10">
        <div>
            <h1 class="titulo_filme_ingresso">{{ $movie->titulo }}</h1>
            @if($movie->classficacao >= 18)
                <span class="classificao bg-red-600">{{ $movie->classificacao }} </span><span>{{ $movie->genero }}</span>
            @elseif($movie->classficacao >= 16)
                <span class="classificao bg-orange-600">{{ $movie->classificacao }} </span><span>{{ $movie->genero }}</span>
            @elseif($movie->classficacao >= 12)
                <span class="classificao bg-yellow-600">{{ $movie->classificacao }} </span><span>{{ $movie->genero }}</span>
            @elseif($movie->classficacao == 0)
                <span class="classificao livre bg-green-600 pb-4 ">L</span><span class="genero">{{ $movie->genero }}</span>
            @endif
            <img class="info-image mt-5" src="/img/movies/{{ $movie->image }}" alt="{{ $movie->title }}">
            <p>{{ DateTime::createFromFormat('Y-m-d', $movie->data)->format('d/m/Y') }}</p>
            <p class="descricao">{{ $movie->descricao }}</p>
        </div>
        <div class="form-ingresso">
            <form class="space-y-4" action="/adm/filmes" method="POST" id="cadastrar_filme">
                @csrf
                <div>
                    <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                    <select name="data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        <option value="">Selecione uma data</option>
                    </select>
                </div>
                <div>
                    <label for="horario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Horário</label>
                    <select name="horario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        <option value="">Selecione um horário</option>
                    </select>
                </div>
                <div>
                    <label for="preco" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preço</label>
                    <input type="text" name="preco" id="preco" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="R$ 12,00" readonly />
                </div>
                <div>
                    <label for="filme" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filme</label>
                    <input type="text" name="descricao" id="descricao" placeholder="Digite a descrição do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $movie->titulo }}" readonly />
                </div>
                <div>
                    <button class="assentos" data-modal-target="static-modal" data-modal-toggle="static-modal" require>Reservar assentos</button>
                </div>
                <div class="flex justify-end">
                    <button class="button_cadastrar">Reservar</button>
                </div>
            </form>
        </div>
    </div>

@endsection