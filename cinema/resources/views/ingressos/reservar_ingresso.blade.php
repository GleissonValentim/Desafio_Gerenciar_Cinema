@extends('layouts.app')

@section('title', 'Reservar ingresso')

@section('content')

    <div class="info-ingresso mt-10">
        <div class="filme">
            <h1 class="titulo_filme_ingresso">{{ $movie->titulo }}</h1>
            @if($movie->classificacao >= 18)
                <div><p class="classificao bg-red-600">{{ $movie->classificacao }}</p><p>{{ $movie->genero }}</p></div>
            @elseif($movie->classificacao >= 16)
                <div><p class="classificao especial">{{ $movie->classificacao }}</p><p>{{ $movie->genero }}</p></div>
            @elseif($movie->classificacao >= 12)
                <div><p class="classificao bg-yellow-500">{{ $movie->classificacao }}</p><p>{{ $movie->genero }}</p></div>
            @elseif($movie->classificacao == 0)
                <div><p class="classificao livre bg-green-600 pb-4">L</p><p>{{ $movie->genero }}</p></div>
            @endif
            <img class="info-image mt-5" src="/img/movies/{{ $movie->image }}" alt="{{ $movie->title }}">
            <p>Data de estréia: {{ DateTime::createFromFormat('Y-m-d', $movie->data)->format('d/m/Y') }}</p>
            <p>Duração: {{ $movie->duracao }}m</p>
            <p class="descricao">{{ $movie->descricao }}</p>
        </div>

        @if(count($sessoes) > 0)
            <div class="form-ingresso">
                <form action="/search" method="GET">
                    <div class="pesquisa">
                        <ion-icon class="search" type="submit" name="search-outline" id="search"></ion-icon>
                        <input type="text" id="pesquisa" name="pesquisa">
                        <input type="hidden" name="filme" value="{{ $movie->id }}">
                    </div>
                </form>
                
                <form class="space-y-4" action="/adm/filmes" method="POST" id="cadastrar_filme">
                    <div class="tabela esp">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Horário</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessoes as $sessao)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ DateTime::createFromFormat('Y-m-d', $sessao->data)->format('d/m/Y') }}</td>
                                        <td>{{ $sessao->horario }}</td>
                                        <td>R$ {{ $sessao->preco }},00</td>
                                        <td><button class="ingresso_button reservar_lugar" id="{{ $sessao->rooms_id }}" name="{{ $sessao->id }}" data-modal-target="cadeiras-modal" 
                                        data-modal-toggle="cadeiras-modal">Reservar</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Paginação -->
                        <div class="mt-10">
                            {{ $sessoes->links() }}
                        </div>
                    </div>
                </form>
            </div>
        @else
            <p class="text-center mt-10 nn">Nenhuma sessão foi encontrada</p>
        @endif
    </div>

    <!-- Main modal -->
<div id="cadeiras-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 max-h-full largura">
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
            <form class="space-y-4" method="POST">
                @csrf
                <div>
                    <p class="text-center mt-10">Tela</p>
                </div>
                <div class="sala_lugar">
                    <div class="colunas">
    
                    </div>
                    <div class="p-4 md:p-5 lugares">
                    
                    </div>
                </div>
                <div class="reservar_lugares">
                    <div class="numero_assentos">
                        <p>Capacidade da sala:</p>
                        <input id="total" type="number" disabled>
                    </div>
                    <button id="concluir_registro_reserva">Reservar sala</button>
                </div>
            </form>
        </div>
    </div>
</div> 
@endsection