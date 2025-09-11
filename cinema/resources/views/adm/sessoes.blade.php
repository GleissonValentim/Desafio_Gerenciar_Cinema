@extends('layouts.app')

@section('title', 'HDC Events')

@section('content')

<h1 class="titulo">Sessões</h1>

<!-- Modal toggle -->
<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="button" type="button">
  Cadastrar Sessão
</button>

@if(count($sessoes) == 0)
    <p class="text-center">Não há Sessões cadastradas</p>
@else
    <div class="tabela">
        <table class="mt-10">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Filme</th>
                    <th scope="col">Horario</th>
                    <th scope="col">Data</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessoes as $sessao)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $sessao->movie->titulo }}</td>
                        <td>{{ $sessao->horario }}</td>
                        <td>{{ DateTime::createFromFormat('Y-m-d', $sessao->data)->format('d/m/Y') }}</td>
                        <td>R$ {{ $sessao->preco }},00</td>
                        <td>{{ $sessao->sala->nome }}</td>
                        <td>
                            <span><ion-icon class="editar atualizar_sessao" id="{{ $sessao->id }}" data-modal-target="edit-modal" data-modal-toggle="edit-modal" name="create-outline"></ion-icon></span>
                            <span><ion-icon class="delete apagar_sessao" id="{{ $sessao->id }}" name="trash-outline"></ion-icon></span>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginação -->
        <div class="mt-10">
            {{ $sessoes->links() }}
        </div>
    </div>
@endif

<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Cadastrar Sessão
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="/adm/sessoes" method="POST" enctype="multipart/form-data" id="cadastrar_sessao">
                    @csrf
                    <div>
                        <label for="horario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">horario</label>
                        <input type="time" name="horario" id="horario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <input type="date" name="data" id="data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o preço da sessão" required />
                    </div>
                    <div>
                        <label for="preco" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preço</label>
                        <input type="number" name="preco" id="titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o preço da sessão" required />
                    </div>
                    <div>
                        <label for="filme" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filme</label>
                        <select name="filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="">Selecione um Filme</option>
                            @foreach($filmes as $filme)
                                <option value="{{ $filme->id }}">{{ $filme->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sala" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sala</label>
                        <select name="sala" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="">Selecione uma Sala</option>
                            @foreach($salas as $sala)
                            <option value="{{ $sala->id }}">{{ $sala->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button class="button_cadastrar">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<!-- Editar -->
<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Editar Sessão
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="/adm/sessoes" method="POST" enctype="multipart/form-data" id="cadastrar_sessao">
                    @csrf
                    <div>
                        <label for="horario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">horario</label>
                        <input type="time" name="horario" id="edit_horario" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <input type="date" name="data" id="edit_sessao_data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o preço da sessão" required />
                    </div>
                    <div>
                        <label for="preco" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preço</label>
                        <input type="number" name="preco" id="edit_preco" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o preço da sessão" step="0.001" required />
                    </div>
                    <div>
                        <label for="filme" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filme</label>
                        <select name="filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="edit_movie" required>
                            <option value="">Selecione um Filme</option>
                            @foreach($filmes as $filme)
                                <option value="{{ $filme->id }}">{{ $filme->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="sala" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sala</label>
                        <select name="sala" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="edit_sala_id" required>
                            <option value="">Selecione uma Sala</option>
                            @foreach($salas as $sala)
                            <option value="{{ $sala->id }}">{{ $sala->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button class="button_cadastrar">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

@endsection