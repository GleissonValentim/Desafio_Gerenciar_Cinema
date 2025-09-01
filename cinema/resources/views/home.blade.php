@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

    <h1 class="titulo">Programação</h1>

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

@endsection