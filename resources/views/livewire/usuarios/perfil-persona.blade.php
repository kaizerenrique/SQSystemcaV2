<div class="p-6">
    <!-- mensaje de notificacion -->
    <div>
        @if (session()->has('message'))
        <div class="max-w-lg mx-auto">
            <div class="flex bg-emerald-100 rounded-lg p-4 mb-4 text-sm text-emerald-700" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-5 w-5 mr-3" fill="none"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                        clip-rule="evenodd" />
                </svg>
                <div>
                    <span class="font-medium">{{ session('message') }}</span>.
                </div>
            </div>
        </div>
        @endif
    </div>
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
                                    @isset($persona->fnacimiento)
                                        {{ \Carbon\Carbon::parse($persona->fnacimiento)->age }} años
                                    @else
                                        Edad
                                    @endisset
                                </div>
                            </div>
                        </div>

                        <!-- Botón condicional -->
                        @if(empty($persona->nombres) || empty($persona->apellidos) || empty($persona->fnacimiento))
                            <button class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition duration-200" 
                                    wire:click="buscarperfil()">
                                Crear perfil
                            </button>
                        @else
                            <button class="mt-6 bg-gray-400 text-white py-2 px-4 rounded-lg cursor-not-allowed" 
                                    disabled>
                                Perfil completado
                            </button>
                        @endif
                        
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
                                                {{ $historial->id ?? null }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $historial->nombreArchivo ?? null }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $historial->laboratorio->nombre ?? null }}
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
            </div>
        </div>
    </section>

    <!-- Inicio del Modal para Agregar Perfil -->
    <x-dialog-modal wire:model="modalagregarperfil">
        <x-slot name="title">
            {{ $titulo }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 gap-4">

                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombres" value="{{ __('Nombre') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="nombres" />
                    <x-input-error for="nombres" class="mt-2" />
                </div>

                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="apellidos" value="{{ __('Apellido') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="apellidos" />
                    <x-input-error for="apellidos" class="mt-2" />
                </div>

                <div class="col-span-2 sm:col-span-2 md:col-span-2">
                    <x-label for="fnacimiento" value="{{ __('Fecha de nacimiento') }}" />
                    <x-input type="date" class="mt-1 input input-bordered w-full rounded-lg" wire:model="fnacimiento" max="{{ now()->format('Y-m-d') }}" />
                    <x-input-error for="fnacimiento" class="mt-2" />                    
                </div>
                
                <div class="col-span-1 sm:col-span-2">
                    <x-label for="sexo" value="{{ __('Sexo') }}" />
                    <select name="sexo" id="sexo" wire:model="sexo"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="" selected>Seleccione</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                    <x-input-error for="sexo" class="mt-2" />
                </div>

                <div class="col-span-1 sm:col-span-1">
                    <x-label for="nacionalidad" value="{{ __('Nacionalidad') }}" />
                    <select name="nacionalidad" id="nacionalidad" wire:model="nacionalidad"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="" selected>Seleccione</option>
                        <option value="V">V</option>
                        <option value="E">E</option>
                    </select>
                    <x-input-error for="nacionalidad" class="mt-2" />
                </div>

                <div class="col-span-1 sm:col-span-3 md:col-span-3">
                    <x-label for="cedula" value="{{ __('cedula') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="cedula" />
                    <x-input-error for="cedula" class="mt-2" />
                </div>

                <div class="col-span-1 sm:col-span-1">
                    <x-label for="codigo_internacional" value="{{ __('Código Internacional') }}" />
                    <select name="codigo_internacional" id="codigo_internacional" wire:model="codigo_internacional"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="" selected>Seleccione</option>
                        <option value="+58">+58</option>
                    </select>
                    <x-input-error for="codigo_internacional" class="mt-2" />
                </div>
                <div class="col-span-1 sm:col-span-1">
                    <x-label for="codigo_operador" value="{{ __('Código de Operador') }}" />
                    <select name="codigo_operador" id="codigo_operador" wire:model="codigo_operador"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="" selected>Seleccione</option>
                        <option value="412">412</option>
                        <option value="414">414</option>
                        <option value="424">424</option>
                        <option value="416">416</option>
                        <option value="424">426</option>
                    </select>
                    <x-input-error for="codigo_operador" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-2">
                    <x-label for="whatsapp" value="{{ __('¿Tiene Whatsapp?') }}" />
                    <select name="whatsapp" id="whatsapp" wire:model="whatsapp"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="" selected>Seleccione</option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                    <x-input-error for="whatsapp" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nrotelefono" value="{{ __('Números de Teléfono') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg"
                        wire:model="nrotelefono" />
                    <x-input-error for="nrotelefono" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$toggle('modalagregarperfil', false)"
                wire:loading.attr="disabled"
                class="border border-red-700 bg-red-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                {{ __('Cancelar') }}
            </button>
            <button type="button" wire:click="guardarperfil()" wire:loading.attr="disabled"
                class="border border-emerald-700 bg-emerald-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline">
                {{ __('Guardar') }}
            </button>
        </x-slot>
    </x-dialog-modal>
    <!-- Fin del Modal para Agregar perfil -->

    <!-- Inicio del Modal para Buscar Perfil -->
    <x-dialog-modal wire:model="modalbuscarperfil">
        <x-slot name="title">
            {{ $titulo }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 gap-4">
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="cedula" value="{{ __('Número de Cédula o Código para menores sin cédula ') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="cedula" />
                    <x-input-error for="cedula" class="mt-2" />
                </div>           
            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$toggle('modalbuscarperfil', false)"
                wire:loading.attr="disabled"
                class="border border-red-700 bg-red-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                {{ __('Cancelar') }}
            </button>
            <button type="button" wire:click="identificarperfil()" wire:loading.attr="disabled"
                class="border border-emerald-700 bg-emerald-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline">
                {{ __('Buscar') }}
            </button>
        </x-slot>
    </x-dialog-modal>
    <!-- Fin del Modal para Buscar perfil -->

    <!-- Inicio del Modal para Confirmar Perfil -->
    <x-dialog-modal wire:model="modalconfirmarperfil">
        <x-slot name="title">
            {{ $titulo }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 gap-4">
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="cedula" value="{{ __('Número de Cédula o Código para menores sin cédula ') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="cedula" disabled/>
                    
                </div>  
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombres" value="{{ __('Nombre') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="nombres" disabled/>
                    
                </div>

                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="apellidos" value="{{ __('Apellido') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="apellidos" disabled/>
                    
                </div>         
            </div>
            
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$toggle('modalconfirmarperfil', false)"
                wire:loading.attr="disabled"
                class="border border-red-700 bg-red-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                {{ __('Cancelar') }}
            </button>
            <button type="button" wire:click="guardaperfil()" wire:loading.attr="disabled"
                class="border border-emerald-700 bg-emerald-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline">
                {{ __('Confirmar') }}
            </button>
        </x-slot>
    </x-dialog-modal>
    <!-- Fin del Modal para Confirmar perfil -->
</div>
