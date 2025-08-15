<div class="p-6">
    <section class="text-gray-600 body-font">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4 -mb-10">
                <!-- Sección Perfil (30%) -->
                <div class="w-full sm:w-1/3 mb-10 px-4">
                    <div class="bg-white p-6 h-full flex flex-col items-center">
                        <!-- Icono de usuario circular -->
                        <div class="bg-gray-200 border-2 border-dashed rounded-full w-24 h-24 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        
                        <!-- Datos del usuario -->
                        <div class="w-full space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Nombre</label>
                                <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                                    {{ $persona->nombres ?? 'Nombre de usuario' }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Apellido</label>
                                <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                                    {{ $persona->apellidos ?? 'Apellido del usuario' }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Edad</label>
                                <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                                    {{ $persona->fnacimiento ?? 'Edad' }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botón opcional 
                        <button class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition duration-200">
                            Actualizar perfil
                        </button>
                        -->
                    </div>
                </div>

                <!-- Sección Tabla (70%) -->
                <div class="w-full sm:w-2/3 mb-10 px-4">
                    <div class="bg-white p-6 h-full">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Lista de resultados</h2>
                        
                        <!-- Tabla responsiva -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre del archivo
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre del Laboratorio 
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Ejemplo de fila -->
                                    @foreach ( $historiales as $historial )
                                        <tr>                                            
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $historial->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $historial->nombreArchivo  }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $historial->laboratorio->nombre  }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="{{ $historial->url_documento }}" download="{{ $historial->nombreArchivo }}.pdf" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    Descargar
                                                </a>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                    
                                    <!-- Más filas aquí -->
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Paginación (opcional) -->
                        <div class="mt-6 flex items-center justify-between">
                            {{ $historiales->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
