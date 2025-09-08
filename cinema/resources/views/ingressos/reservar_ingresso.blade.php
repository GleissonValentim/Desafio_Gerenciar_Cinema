@extends('layouts.app')

@section('title', 'Reservar ingresso')

@section('content')

    <div class="info-ingresso mt-10">
        <div class="filme">
            <h1 class="titulo_filme_ingresso">{{ $movie->titulo }}</h1>
            @if($movie->classificacao >= 18)
                <span class="classificao bg-red-600">{{ $movie->classificacao }} </span><span>{{ $movie->genero }}</span>
            @elseif($movie->classificacao >= 16)
                <span class="classificao especial">{{ $movie->classificacao }} </span><span>{{ $movie->genero }}</span>
            @elseif($movie->classificacao >= 12)
                <span class="classificao bg-yellow-500">{{ $movie->classificacao }} </span><span>{{ $movie->genero }}</span>
            @elseif($movie->classificacao == 0)
                <span class="classificao livre bg-green-600 pb-4 ">L</span><span class="genero">{{ $movie->genero }}</span>
            @endif
            <img class="info-image mt-5" src="/img/movies/{{ $movie->image }}" alt="{{ $movie->title }}">
            <p>Data de estréia: {{ DateTime::createFromFormat('Y-m-d', $movie->data)->format('d/m/Y') }}</p>
            <p class="descricao">{{ $movie->descricao }}</p>
        </div>
        <div class="form-ingresso">
            @if(count($sessoes) > 0)
                <form class="space-y-4" action="/adm/filmes" method="POST" id="cadastrar_filme">
                    <div class="tabela">
                        <table class="mt-10">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">horário</th>
                                    <th scope="col">preço</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessoes as $sessao)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ DateTime::createFromFormat('Y-m-d', $sessao->data)->format('d/m/Y') }}</td>
                                        <td>{{ $sessao->horario }}</td>
                                        <td>{{ $sessao->preco }}</td>
                                        <td><button class="ingresso_button reservar_lugar" id="{{ $sessao->rooms_id }}" data-modal-target="cadeiras-modal" 
                                        data-modal-toggle="cadeiras-modal" name="create-outline">Reservar</button></td>
                                        <input class="eu" type="hidden" value="{{ $sessao->id }}">
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- @csrf
                    <div>
                        <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <select name="data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="data_ingresso">
                            <option value="">Selecione uma data</option>
                            @foreach($sessoes as $sessao)
                                <option value="{{ $sessao->id }}">{{ DateTime::createFromFormat('Y-m-d', $sessao->data)->format('d/m/Y') }}</option>
                            @endforeach
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
                    </div> -->
                </form>
            @endif
        </div>
    </div>

    <!-- Main modal -->
<div id="cadeiras-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-1/2 max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Escolha seus assentos
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="cadeiras-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="space-y-4" action="/adm/filmes" method="POST" enctype="multipart/form-data" id="cadastrar_filme">
                @csrf
                <div class="p-4 md:p-5 lugares">
                    

                        <!-- <div class="flex justify-end">
                            <button class="button_cadastrar">Cadastrar</button>
                        </div> -->
                </div>
                <div>
                    <p class="text-center">Tela</p>
                </div>
                <div class="reservar_lugares">
                    <div class="numero_assentos">
                        <p>Capacidade da sala: </p>
                        <input id="e" type="number" value="12" disabled>
                    </div>
                    <button id="concluir_reserva">Reservar sala</button>
                </div>
            </form>
        </div>
    </div>
</div> 

@endsection