<div class="p-6">
    <section class="text-gray-600 body-font">

    <!-- Seccion que contiene el titulo las busquedas y el boton para registro nuevo -->
    <div class="flex flex-wrap items-center px-4 py-2 mt-4">    
        
        <div class="flex flex-col md:flex-row items-center w-full max-w-4xl gap-4 mt-4 md:mt-0">
            <!-- Búsqueda por nombre -->
            <div class="w-full md:w-auto">
                <input wire:model.live="buscar" type="search" placeholder="Buscar por nombre o cedula..." 
                    class="input input-bordered w-full md:w-64 rounded-lg" />
            </div>
            
            <!-- Filtro por fecha inicio -->
            <div class="w-full md:w-auto">
                <input wire:model.live="fecha_inicio" type="date" 
                    class="input input-bordered w-full md:w-48 rounded-lg" />
            </div>
            
            <!-- Filtro por fecha fin -->
            <div class="w-full md:w-auto">
                <input wire:model.live="fecha_fin" type="date" 
                    class="input input-bordered w-full md:w-48 rounded-lg" />
            </div>
            
            <!-- Botón limpiar filtros -->
            <div class="w-full md:w-auto">
                <button wire:click="limpiarFiltros" 
                        class="border border-gray-400 bg-gray-100 text-gray-800 rounded-lg px-4 py-2 transition duration-500 ease select-none hover:bg-gray-200 focus:outline-none focus:shadow-outline w-full md:w-auto">
                    <div class="flex items-center">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </span>
                        <span class="ml-2">Limpiar</span>
                    </div>
                </button>
            </div>
        </div>
    
    <div class="relative w-full max-w-full flex-grow flex-1 text-right mt-4 md:mt-0">
        <!-- Si necesitas un botón de acción adicional, puedes mantenerlo aquí -->
        <!-- <button type="button" wire:click="algunaAccion()"
                class="border border-blue-700 bg-blue-700 text-white rounded-lg px-4 py-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
            <div class="flex items-center">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </span>
                <span class="ml-2">Nuevo Documento</span>
            </div>
        </button> -->
    </div>
</div>
        <div class="w-full mb-10 px-4">
                    <div class="bg-white p-6 h-full">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Lista de resultados</h2>
                        
                        <!-- Tabla responsiva -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre del archivo
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre 
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Cedula o Codigo 
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $historial->nombreArchivo ?? null }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $historial->persona->nombres ?? null }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $historial->persona->cedula ?? null }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $historial->created_at ?? null }}
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
                        <div class="mt-6 w-full">
                            {{ $historiales->links() }}
                        </div>
                    </div>
                </div>

    </section>
</div>
