@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

    <h1 class="titulo">Programação</h1>

    @if(count($movies) == 0)
        <p class="text-center">Não há filmes cadastrados</p>
    @else
        <div class="movies">
            @foreach($movies as $movie)
                <div class="movie">
                    <img class="img" src="/img/movies/{{ $movie->image }}" alt="{{ $movie->title }}">

                    <div class="description">
                        <h1>{{ $movie->titulo }}</h1>
                        <p>{{ $movie->genero }}</p>
                        <a href="ingressos/reservar_ingresso/{{ $movie->id }}"><button>Comprar ingresso</button></a>
                    </div>
                </div>
            @endforeach
        </div>
     @endif

@endsection