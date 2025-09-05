@extends('layouts.app')

@section('title', 'HDC Events')

@section('content')

<h1 class="titulo">Filmes</h1>

<!-- Modal toggle -->
<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="button" type="button">
  Cadastrar Filme
</button>

@if(count($movies) == 0)
    <p class="text-center">Não há filmes cadastrados</p>
@else
    <div class="tabela">
        <table class="mt-10">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td class="link_filme"><a href="/ingressos/reservar_ingresso/{{ $movie->id }}">{{ $movie->titulo }}</a></td>
                        <td>{{ $movie->genero }}</td>
                        <td>
                            <span><ion-icon class="editar atualizar_filme" id="{{ $movie->id }}" data-modal-target="edit-modal" data-modal-toggle="edit-modal" name="create-outline"></ion-icon></span>
                            <span><ion-icon class="delete apagar_filme" id="{{ $movie->id }}" name="trash-outline"></ion-icon></span>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                    Cadastrar filme
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
                <form class="space-y-4" action="/adm/filmes" method="POST" enctype="multipart/form-data" id="cadastrar_filme">
                    @csrf
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagem</label>
                        <input type="file" id="image" name="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o titulo do filme" required>
                    </div>
                    <div>
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo</label>
                        <input type="text" name="titulo" id="titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o titulo do filme" required />
                    </div>
                    <div>
                        <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <input type="text" name="descricao" id="descricao" placeholder="Digite a descrição do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <input type="date" name="data" id="descricao" placeholder="Digite a data do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="genero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gênero</label>
                        <select name="genero" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="">Selecione um gênero</option>
                            <option value="aventura">Aventura</option>
                            <option value="acao">Ação</option>
                            <option value="romance">Romance</option>
                            <option value="terror">Terror</option>
                            <option value="terror">Comédia</option>
                        </select>
                    </div>
                    <div>
                        <label for="classificacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Classificação</label>
                        <select name="classificacao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="">Selecione uma Classificação de idade</option>
                            <option value="0">Livre</option>
                            <option value="12">12</option>
                            <option value="16">16</option>
                            <option value="18">18</option>
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
                    Editar filme
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
                <form class="space-y-4" action="/adm/filmes" method="POST" enctype="multipart/form-data" id="editar_filme">
                    @csrf
                    <input type="hidden" name="id" id="identificador">
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagem</label>
                        <input type="file" id="image" name="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o titulo do filme" required>
                    </div>
                    <div>
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo</label>
                        <input type="text" name="titulo" id="edit_titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o titulo do filme" required />
                    </div>
                    <div>
                        <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <input type="text" name="descricao" id="edit_descricao" placeholder="Digite a descrição do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                        <input type="date" name="data" id="edit_data" placeholder="Digite a data do filme" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <div>
                        <label for="genero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gênero</label>
                        <select name="genero" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="edit_genero" require>
                            <option value="">Selecione um gênero</option>
                            <option value="aventura">Aventura</option>
                            <option value="acao">Ação</option>
                            <option value="romance">Romance</option>
                            <option value="terror">Comédia</option>
                            <option value="terror">Terror</option>
                        </select>
                    </div>
                    <div>
                        <label for="classificacao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Classificação</label>
                        <select name="classificacao" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="edit_classificacao" required>
                            <option value="">Selecione uma Classificação de idade</option>
                            <option value="0">Livre</option>
                            <option value="12">12</option>
                            <option value="16">16</option>
                            <option value="18">18</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button class="button_cadastrar" id="editar_filme">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

@endsection