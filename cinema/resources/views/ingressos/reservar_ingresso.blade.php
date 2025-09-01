@extends('layouts.main')

@section('title', 'Reservar ingresso')

@section('content')

    <div class="mt-10">
        <h1 class="titulo">{{ $movie->titulo }}</h1>
        <img class="info-image" src="/img/movies/{{ $movie->image }}" alt="{{ $movie->title }}">
        <p>{{ $movie->descricao }}</p>
    </div>

@endsection