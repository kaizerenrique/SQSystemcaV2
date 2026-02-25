<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Historial;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ConsultaPublicaController extends Controller
{
    /**
     * Muestra el formulario de consulta.
     */
    public function index()
    {
        return view('consulta.index');
    }

    /**
     * Procesa la consulta por cédula y muestra los resultados.
     */
    public function show(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string|max:12',
        ]);

        $cedula = $request->cedula;

        // Buscar persona por cédula
        $persona = Persona::where('cedula', $cedula)->first();

        if (!$persona) {
            return view('consulta.resultados', [
                'error' => 'No se encontraron documentos para la cédula ingresada.',
                'cedula' => $cedula
            ]);
        }

        // Obtener historiales de la persona con paginación
        $historiales = $persona->historial()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('consulta.resultados', [
            'persona' => $persona,
            'historiales' => $historiales,
            'cedula' => $cedula
        ]);
    }

    /**
     * Muestra el documento incrustado con Google Docs Viewer.
     */
    public function ver($url_code)
    {
        $historial = Historial::where('url_code', $url_code)->firstOrFail();
        return view('consulta.ver', [
            'url' => $historial->url_documento,
            'url_code' => $historial->url_code
        ]);
    }

    public function descargar($url_code): BinaryFileResponse
    {
        $historial = Historial::where('url_code', $url_code)->firstOrFail();
        
        // Ruta completa al archivo en storage/app/public
        $path = storage_path('app/public/' . $historial->nombreArchivo);
        
        if (!file_exists($path)) {
            abort(404, 'El archivo no existe en el servidor.');
        }
        
        // Obtener extensión y datos de la persona para personalizar el nombre
        $extension = pathinfo($historial->nombreArchivo, PATHINFO_EXTENSION);
        
        // Intentar obtener la cédula de la persona asociada (si existe)
        $cedula = $historial->persona->cedula ?? 'desconocido';
        
        // Fecha de subida formateada
        $fecha = $historial->created_at->format('Y-m-d');
        
        // Nombre personalizado para la descarga
        $nombreDescarga = "documento_{$cedula}_{$fecha}.{$extension}";
        
        // Devolver la descarga forzada
        return response()->download($path, $nombreDescarga);
    }
}
