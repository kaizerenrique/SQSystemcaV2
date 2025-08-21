<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial;

class ControladorDocumento extends Controller
{
    public function mostrar($codigo)
    {
        // Buscar el documento por el código
        $documento = Historial::where('url_code', $codigo)->first();

        // Verificar si existe
        if (!$documento) {
            abort(404); // Documento no encontrado
        }

        // Redirigir a la URL real de descarga
        return redirect($documento->url_documento);
    }
}
