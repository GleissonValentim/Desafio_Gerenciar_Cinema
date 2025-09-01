
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div> -->

            <h1 class="titulo">Programação</h1>

            <div class="movies">
                @foreach($movies as $movie)
                    <div class="movie">
                        <img class="img" src="/img/movies/{{ $movie->image }}" alt="{{ $movie->title }}">

                        <div class="description">
                            <h1>{{ $movie->titulo }}</h1>
                            <p>{{ $movie->genero }}</p>
                            <button>Comprar ingresso</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
