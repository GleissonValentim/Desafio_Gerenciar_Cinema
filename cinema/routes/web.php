<?php

use App\Http\Controllers\AdmController;
use Illuminate\Support\Facades\Route;

Route::post('/adm/filmes', [AdmController::class, 'addFilme']);
Route::get('/adm/filmes', [AdmController::class, 'getFilmes'])->name('filmes')->middleware('auth');

Route::get('/', function () {
    return view('home');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
