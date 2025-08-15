<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Servicios\Consultabcv;
use Illuminate\Http\JsonResponse;


class ApiController extends Controller
{
    use Consultabcv;

    /**
     * Obtener el último valor del BCV
     * 
     * @return JsonResponse
     */
    public function bcv_valor(): JsonResponse
    {
        try {
            $valor = $this->valordelusd();
            
            // Si no se encuentra ningún valor
            if ($valor === null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'No se encontró ningún valor almacenado para el USD',
                    'data' => null
                ], 404);
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Valor del USD obtenido exitosamente',
                'data' => [
                    'valor' => $valor,
                    'moneda' => 'USD',
                    'fuente' => 'BCV'
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error interno al obtener el valor del USD',
                'error' => config('app.debug') ? $e->getMessage() : 'Detalles disponibles solo en entorno de desarrollo'
            ], 500);
        }
    }
}
