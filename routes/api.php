<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');



Route::get('/bcv',[ApiController::class,'bcv_valor'])->middleware('auth:sanctum');
Route::get('/generadorDeEnlaces',[ApiController::class,'generadorDeEnlaces'])->middleware('auth:sanctum');
Route::post('/subir-documento',[ApiController::class,'doc'])->middleware('auth:sanctum');
Route::get('/usuario/{cedula}', [ApiController::class, 'cedulaInfo']);
Route::post('/infouser', [ApiController::class, 'infouser'])->middleware('auth:sanctum');
Route::get('/generar-identificador-menor', [ApiController::class, 'generarTokenMenorSinCedula'])->middleware('auth:sanctum');
