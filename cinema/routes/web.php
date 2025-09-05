<?php

use App\Http\Controllers\IngressoController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\SessaoController;
use App\Http\Middleware\CheckIfIsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/adm/sessoes/{id}/edit', [SessaoController::class, 'edit'])->middleware(CheckIfIsAdmin::class);
Route::delete('/adm/sessoes/{id}/destroy', [SessaoController::class, 'destroy'])->middleware(CheckIfIsAdmin::class);
Route::post('/adm/sessoes', [SessaoController::class, 'addSessao'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/sessoes', [SessaoController::class, 'getSessoes'])->name('sessoes')->middleware(CheckIfIsAdmin::class);
Route::post('/adm/salas/update', [SalaController::class, 'update'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/salas/{id}/edit', [SalaController::class, 'edit'])->middleware(CheckIfIsAdmin::class);
Route::delete('/adm/salas/{id}/destroy', [SalaController::class, 'destroy'])->middleware(CheckIfIsAdmin::class);
Route::post('/adm/salas', [SalaController::class, 'addSalas'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/salas', [SalaController::class, 'getSalas'])->name('salas')->middleware(CheckIfIsAdmin::class);
Route::get('/ingressos/reservar_lugar/{sala}', [SalaController::class, 'lugares']);
Route::get('/ingressos/reservar_ingresso/{movie}', [IngressoController::class, 'reservar']);
Route::post('/adm/filmes/update', [MovieController::class, 'update'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/filmes/{id}/edit', [MovieController::class, 'edit'])->middleware(CheckIfIsAdmin::class);
Route::delete('/adm/filmes/{id}/destroy', [MovieController::class, 'destroy'])->middleware(CheckIfIsAdmin::class);
Route::post('/adm/filmes', [MovieController::class, 'addFilme'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/filmes', [MovieController::class, 'getFilmes'])->name('filmes')->middleware(CheckIfIsAdmin::class);
Route::get('/', [MovieController::class, 'home'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [MovieController::class, 'dashboard'])->name('dashboard');;
});
