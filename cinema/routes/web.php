<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\IngressoController;
use App\Http\Middleware\CheckIfIsAdmin;
use Illuminate\Support\Facades\Route;

Route::post('/adm/salas', [AdmController::class, 'addSalas'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/salas', [AdmController::class, 'getSalas'])->name('salas')->middleware(CheckIfIsAdmin::class);
Route::get('/ingressos/reservar_ingresso/{movie}', [IngressoController::class, 'reservar']);
Route::delete('/adm/filmes/{user}/destroy', [AdmController::class, 'destroy'])->name('filmes.destroy')->middleware(CheckIfIsAdmin::class);
Route::post('/adm/filmes', [AdmController::class, 'addFilme'])->middleware(CheckIfIsAdmin::class);
Route::get('/adm/filmes', [AdmController::class, 'getFilmes'])->name('filmes')->middleware(CheckIfIsAdmin::class);
Route::get('/', [AdmController::class, 'home'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [AdmController::class, 'dashboard'])->name('dashboard');;
});
