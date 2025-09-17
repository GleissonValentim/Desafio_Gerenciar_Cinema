<?php

use App\Http\Controllers\BookingsController ;
use App\Http\Controllers\IngressoController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\SessaoController;
use App\Http\Middleware\CheckIfIsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/search', [SessaoController::class, 'search']);
Route::get('qr-code', [QrCodeController::class, 'create']);
Route::delete('/clientes/reservas/{id}/destroy', [BookingsController::class, 'destroyCliente'])->middleware('auth');
Route::delete('/adm/reservas/{id}/destroy', [BookingsController::class, 'destroy'])->middleware(CheckIfIsAdmin::class);
Route::get('/clientes/historico', [BookingsController::class, 'getHistoricoCliente'])->name('historico')->middleware('auth');
Route::get('/clientes/reservas', [BookingsController::class, 'getReservasCliente'])->name('reservas_cliente')->middleware('auth');
Route::get('/adm/reservas', [BookingsController::class, 'getReservas'])->name('reservas')->middleware(CheckIfIsAdmin::class);
Route::post('/ingressos/confirmar', [BookingsController::class, 'confirmar']);
Route::get('/ingressos/confirmar/{id}', [BookingsController::class, 'getConfirmar'])->middleware('auth');
Route::post('/ingressos/email', [BookingsController::class, 'addEmail']);
Route::post('/ingressos/reservar', [BookingsController::class, 'addIngresso']);
Route::get('/ingressos/{id}/reservar/{sessao}', [BookingsController::class, 'verificarAssento']);
Route::post('/adm/sessoes/update', [SessaoController::class, 'update'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/sessoes/{id}/edit', [SessaoController::class, 'edit'])->middleware(CheckIfIsAdmin::class);
Route::delete('/adm/sessoes/{id}/destroy', [SessaoController::class, 'destroy'])->middleware(CheckIfIsAdmin::class);
Route::post('/adm/sessoes', [SessaoController::class, 'addSessao'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/sessoes', [SessaoController::class, 'getSessoes'])->name('sessoes')->middleware(CheckIfIsAdmin::class);
Route::post('/adm/salas/update', [SalaController::class, 'update'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/salas/{id}/edit', [SalaController::class, 'edit'])->middleware(CheckIfIsAdmin::class);
Route::delete('/adm/salas/{id}/destroy', [SalaController::class, 'destroy'])->middleware(CheckIfIsAdmin::class);
Route::post('/adm/salas', [SalaController::class, 'addSalas'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/salas', [SalaController::class, 'getSalas'])->name('salas')->middleware(CheckIfIsAdmin::class);
Route::get('/ingressos/reservar_lugar/{sala}', [SalaController::class, 'lugares'])->middleware('auth');
Route::get('/ingressos/reservar_ingresso/{movie}', [IngressoController::class, 'reservar'])->middleware('auth');
Route::post('/adm/filmes/update', [MovieController::class, 'update'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/filmes/{id}/edit', [MovieController::class, 'edit'])->middleware(CheckIfIsAdmin::class);
Route::delete('/adm/filmes/{id}/destroy', [MovieController::class, 'destroy'])->middleware(CheckIfIsAdmin::class);
Route::post('/adm/filmes', [MovieController::class, 'addFilme'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/filmes', [MovieController::class, 'getFilmes'])->name('filmes')->middleware(CheckIfIsAdmin::class);
Route::get('/perfil', [MovieController::class, 'perfil'])->name('perfil');
Route::get('/', [MovieController::class, 'home'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Route::get('/dashboard', [MovieController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [MovieController::class, 'dashboard'])->name('dashboard');
});
