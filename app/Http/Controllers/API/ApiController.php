<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Servicios\Consultabcv;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Models\Historial;


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

    /**
     * Genera una URL simbólica única para el sistema QR
     * 
     * @return JsonResponse
     */
    public function generadorDeEnlaces(): JsonResponse
    {
        try {
            $urlBase = config('app.url') ?: 'http://qslabsys.com';
            $codigoUnico = '';
            $maxIntentos = 10;
            $intentos = 0;

            do {
                $codigoUnico = Str::random(21);
                $intentos++;
                
                if ($intentos >= $maxIntentos) {
                    throw new \Exception('No se pudo generar un código único después de múltiples intentos');
                }
            } while (Historial::where('url_simbol', $codigoUnico)->exists());

            $urlSimbolica = $urlBase . '/documentos/' . $codigoUnico;

            return response()->json([
                "status" => 200,
                "message" => "URL simbólico generado exitosamente",
                "url" => $urlSimbolica,
                "codeUrl" => $codigoUnico
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al generar URL simbólico',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
