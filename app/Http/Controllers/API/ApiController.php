<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Servicios\Consultabcv;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Models\Historial;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;



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
            $urlBase = config('app.url') ?: 'qslabsistemas.site';
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


    /**
     * Sube un documento y lo asocia a un historial
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function doc(Request $request): JsonResponse
    {
        try {
            // Validar entrada
            $validator = Validator::make($request->all(), [
                'file' => 'required|string',
                'persona_id' => 'required|integer',
                'url_simbol' => 'required|string',
                'url_code' => 'required|string',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // Verificar si la URL simbólica ya existe
            if (Historial::where('url_simbol', $request->url_simbol)->exists()) {
                return response()->json([
                    "status" => 409,
                    "message" => "El código simbólico ya está en uso",
                ], 409);
            }

            // Procesar archivo en base64
            $imageData = $request->input('file');
            $decodedImage = $this->processBase64Image($imageData);
            
            // Generar nombre único para el archivo
            $extension = $this->getImageExtension($imageData);
            $imageName = $this->generateUniqueFilename($extension);

            // Guardar archivo
            Storage::disk('public')->put($imageName, $decodedImage);
            $urlDocumento = Storage::disk('public')->url($imageName);

            // Crear registro en historial
            $historial = Historial::create([
                'persona_id' => $request->persona_id,
                'laboratorio_id' => $request->user()->laboratorio->id,
                'nombreArchivo' => $imageName,
                'url_simbol' => $request->url_simbol,
                'url_code' => $request->url_code,
                'url_documento' => $urlDocumento,
            ]);

            return response()->json([
                "status" => 201,
                "message" => "Documento subido exitosamente",
                "data" => $historial
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 422,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al subir el documento',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Procesa la imagen en base64
     */
    private function processBase64Image(string $imageData): string
    {
        if (!preg_match('/^data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+);base64,/', $imageData, $matches)) {
            throw new \InvalidArgumentException('Formato base64 inválido');
        }

        $replace = $matches[0];
        $image = str_replace($replace, '', $imageData);
        $image = str_replace(' ', '+', $image);
        
        $decodedImage = base64_decode($image);
        if ($decodedImage === false) {
            throw new \InvalidArgumentException('Error al decodificar la imagen base64');
        }

        return $decodedImage;
    }

    /**
     * Obtiene la extensión del archivo
     */
    private function getImageExtension(string $imageData): string
    {
        if (!preg_match('/^data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+);base64,/', $imageData, $matches)) {
            throw new \InvalidArgumentException('Formato base64 inválido');
        }

        $mimeType = $matches[1];
        return explode('/', $mimeType)[1];
    }

    /**
     * Genera un nombre de archivo único
     */
    private function generateUniqueFilename(string $extension): string
    {
        $maxAttempts = 10;
        $attempt = 0;

        do {
            $filename = Str::random(10).'.'.$extension;
            $attempt++;
            
            if ($attempt >= $maxAttempts) {
                throw new \RuntimeException('No se pudo generar un nombre de archivo único');
            }
        } while (Historial::where('nombreArchivo', $filename)->exists());

        return $filename;
    }

    /**
     * Obtener información de usuario por cédula
     * 
     * @param string $cedula
     * @return JsonResponse
     */
    public function cedulaInfo($cedula): JsonResponse
    {
        try {
            // Buscar persona usando una sola consulta optimizada
            $persona = Persona::where('cedula', $cedula)->first();
            
            if (!$persona) {
                return response()->json([
                    "status" => 404,
                    "message" => "Cédula no registrada en el sistema",
                    "data" => null
                ], 404);
            }

            return response()->json([
                "status" => 200,
                "message" => "Perfil de usuario obtenido exitosamente",
                "data" => $persona
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al buscar información de cédula',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Obtiene información del usuario autenticado
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function infouser(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            
            // Carga eficiente de relaciones necesarias
            $user->load([
                'roles:id,name',
                'laboratorio:id,user_id,rif,nombre' // Especifica las columnas necesarias
            ]);
            
            // Obtener solo los nombres de los roles como array
            $roleNames = $user->getRoleNames()->toArray();
            
            // Preparar respuesta personalizada
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'laboratorio' => $user->laboratorio, // Ya está cargado por el load()
                'roles' => $roleNames,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ];

            return response()->json([
                "status" => 200,
                "message" => "Información del usuario obtenida exitosamente",
                "data" => $userData
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al obtener información del usuario',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Genera un identificador único de 12 caracteres para menores sin cédula
     * 
     * @return JsonResponse
     */
    public function generarTokenMenorSinCedula(): JsonResponse
    {
        try {
            $maxAttempts = 50; // Límite de intentos
            $msc = null;
            
            // Generar identificador único
            for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
                // Generar 8 dígitos numéricos
                $digitos = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
                $msc = 'MSC-' . $digitos; // Total: 4 + 8 = 12 caracteres
                
                // Verificar unicidad
                if (!Persona::where('cedula', $msc)->exists()) {
                    break;
                }
                
                $msc = null;
            }
            
            if (!$msc) {
                throw new \RuntimeException('No se pudo generar identificador único después de ' . $maxAttempts . ' intentos');
            }
            
            return response()->json([
                "status" => 200,
                "message" => "Identificador para menor sin cédula generado exitosamente",
                "data" => $msc
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al generar identificador',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }


    public function registrarperfil(Request $request): JsonResponse
    {
        try {
            // Validación básica pero efectiva
            $request->validate([
                'nombres' => 'required|string|min:3|max:120',
                'apellidos' => 'required|string|min:4|max:120',
                'fnacimiento' => 'required|date',
                'sexo' => 'required|in:Femenino,Masculino', 
                'nacionalidad' => 'required|string|in:V,E',
                'cedula' => 'required|string|min:6|max:12|unique:personas,cedula',
                'codigo_internacional' => 'required|string|size:3',
                'codigo_operador' => 'required|string|size:3',
                'nrotelefono' => 'required|string|min:7|max:11',
                'whatsapp' => 'required|boolean'
            ]);
            
            // Usar transacción para integridad de datos
            DB::beginTransaction();
            
            // Crear perfil
            $perfil = Persona::create([
                'nacionalidad' => $request->nacionalidad,
                'cedula' => $request->cedula,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'fnacimiento' => $request->fnacimiento,
                'sexo' => $request->sexo,
            ]);
            
            // Crear teléfono asociado
            $telefono = $perfil->telefono()->create([
                'codigo_internacional' => $request->codigo_internacional,
                'codigo_operador' => $request->codigo_operador,
                'nrotelefono' => $request->nrotelefono,
                'whatsapp' => $request->whatsapp
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 201,
                'message' => 'Perfil registrado exitosamente',
                'data' => [
                    'perfil' => $perfil,
                    'telefono' => $telefono
                ]
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 422,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Error al registrar el perfil',
                'error' => $e->getMessage() // Solo para depuración
            ], 500);
        }
    }
}
