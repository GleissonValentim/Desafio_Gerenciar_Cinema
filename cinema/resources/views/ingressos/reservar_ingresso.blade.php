@extends('layouts.main')

@section('title', 'Reservar ingresso')

@section('content')

    <div class="mt-10">
        <h1 class="titulo_filme">{{ $movie->titulo }}</h1>
        <p>{{ $movie->genero }}</p>
        <img class="info-image mt-5" src="/img/movies/{{ $movie->image }}" alt="{{ $movie->title }}">
        <p>{{ $movie->descricao }}</p>
    </div>

@endsection