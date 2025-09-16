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

    <!-- <form class="text-center" action="/ingressos/qrCode" method="get" accept-charset="utf-8">
			<div class="row mt-5">
				<div class="col-md-12">
					<h2>How to Generate QR Codes in Laravel 11 Example - Techsolutionstuff</h2>
					<button class="btn btn-success" type="submit">Generate</button> 
					<a href="{{asset('qrcode.png')}}" class="btn btn-primary" download>Download</a><br>
					<img class="img-thumbnail" src="{{asset('qrcode.png')}}" width="150" height="150" style="margin-top: 20px">
				</div>
			</div>
		</form> -->

@endsection