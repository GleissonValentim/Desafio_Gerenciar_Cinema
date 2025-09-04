@extends('layouts.app')

@section('title', 'HDC Events')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h1 class="titulo">Programação</h1>

    @if(count($movies) == 0)
        <p class="text-center">Não há filmes cadastrados</p>
    @else
        <div class="movies">
            @foreach($movies as $movie)
            <a href="ingressos/reservar_ingresso/{{ $movie->id }}">
                <div class="movie">
                    <img class="img" src="/img/movies/{{ $movie->image }}" alt="{{ $movie->title }}">

                    <!-- <div class="description">
                        <h1>{{ $movie->titulo }}</h1>
                        <p>{{ $movie->genero }}</p>
                        <a href="ingressos/reservar_ingresso/{{ $movie->id }}"><button>Comprar ingresso</button></a>
                    </div> -->
                    <h1 class="titulo_filme">{{ $movie->titulo }}</h1>
                </div>
            </a>
            @endforeach
        </div>
     @endif

@endsection