@extends('layouts.app')

@section('title', 'Confirmar ingresso')

@section('content')

<h1 class="titulo">Confirmar ingresso</h1>

<form class="space-y-4 mt-10" action="/adm/filmes" method="POST" enctype="multipart/form-data" id="editar_filme">
    @csrf
    <div>
        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagem</label>
        <input type="file" id="image" name="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Digite o titulo do filme">
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


@endsection