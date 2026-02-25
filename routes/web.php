<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteAuthController;
use App\Http\Controllers\ControladorDocumento;
use App\Http\Controllers\ConsultaPublicaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/redirect', [SocialiteAuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [SocialiteAuthController::class, 'callback'])->name('auth.callback');

Route::get('/consulta', [ConsultaPublicaController::class, 'index'])->name('consulta.index');
Route::post('/consulta', [ConsultaPublicaController::class, 'show'])->name('consulta.show');
Route::get('/documentos/ver/{url_code}', [ConsultaPublicaController::class, 'ver'])->name('consulta.ver');
Route::get('/descargar/{url_code}', [ConsultaPublicaController::class, 'descargar'])->name('consulta.descargar');

Route::get('/documentos/{codigo}', [ControladorDocumento::class, 'mostrar']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/usuarios', function () {
        return view('paginas/administracion/usuarios');
    })->name('usuarios');

    Route::get('/registro_documentos', function () {
        return view('paginas/laboratorio/registrodedocumentos');
    })->name('registro-de-documentos');
});
