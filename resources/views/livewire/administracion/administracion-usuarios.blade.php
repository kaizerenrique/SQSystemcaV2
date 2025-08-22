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
    <!-- Seccion que contiene el titulo las busquedas y el boton para registro nuevo -->
    <div class="flex flex-wrap items-center px-4 py-2">
        <h5 class="font-semibold text-lg text-gray-800 ">Listado de Laboratorios</h5>
        <div class="flex flex-col items-center w-full max-w-xl">
            <input wire:model.live="buscar" type="search" placeholder="Buscar"
                class="input input-bordered w-full max-w-xs rounded-lg" />
        </div>
        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
            <button type="button" wire:click="agregarlaboratorio()"
                class="border border-blue-700 bg-blue-700 text-white rounded-lg px-4 py-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline">
                <div class="flex items-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                    </span>
                    <span class="ml-2">Usuarios</span>
                </div>
            </button>
        </div>
    </div>

    <!--Tabla Usuario-->
    <div class="overflow-x-auto">
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Usuarios</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Rol</th>
                        <th class="py-3 px-6 text-left">Perfil</th>
                        <th class="py-3 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($usuarios as $usuario)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                {{ $usuario->name ?? null}}
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                {{ $usuario->email ?? null}}
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                @foreach ($usuario->roles as $role)
                                    {{ $role->name ?? null}}
                                @endforeach
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">

                                @if (!empty($usuario->laboratorio->nombre))
                                    {{ $usuario->laboratorio->nombre ?? null}}
                                @else
                                    {{ $usuario->persona->nombres ?? null}} {{ $usuario->persona->apellidos ?? null}}
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="verlaboratorio({{ $usuario->id }})" >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="editarlaboratorio({{ $usuario->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="consultaborrarlaboratorio({{ $usuario->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $usuarios->links() }}
        </div>
    </div>

    <!-- Inicio del Modal para Agregar Laboratorio -->
    <x-dialog-modal wire:model="modalagregarlaboratorio">
        <x-slot name="title">
            {{ $titulo }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 gap-4">
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Nombre del Usuario') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="nombre" />
                    <x-input-error for="nombre" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="correo" value="{{ __('Correo del Usuario') }}" />
                    <x-input type="email" class="mt-1 input input-bordered w-full rounded-lg" wire:model="correo" />
                    <x-input-error for="correo" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Nombre del Laboratorio') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg"
                        wire:model="laboratorio" />
                    <x-input-error for="laboratorio" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Rif del Usuario') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="rif" />
                    <x-input-error for="rif" class="mt-2" />
                </div>

                <div class="col-span-2 sm:col-span-2">
                    <x-label for="codigo_internacional" value="{{ __('Código Internacional') }}" />
                    <select name="codigo_internacional" id="codigo_internacional" wire:model="codigo_internacional"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="" selected>Seleccione</option>
                        <option value="+58">+58</option>
                    </select>
                    <x-input-error for="codigo_internacional" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-2">
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
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nrotelefono" value="{{ __('Números de Teléfono') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg"
                        wire:model="nrotelefono" />
                    <x-input-error for="nrotelefono" class="mt-2" />
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

            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$toggle('modalagregarlaboratorio', false)"
                wire:loading.attr="disabled"
                class="border border-red-700 bg-red-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                {{ __('Cancelar') }}
            </button>
            <button type="button" wire:click="guardarlaboratorio()" wire:loading.attr="disabled"
                class="border border-emerald-700 bg-emerald-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline">
                {{ __('Guardar') }}
            </button>
        </x-slot>
    </x-dialog-modal>
    <!-- Fin del Modal para Agregar Laboratorio -->

    <!-- Inicio del Modal para Alerta Eliminar cuenta -->
    <x-dialog-modal wire:model="eliminarlaboratorio">
        <x-slot name="title">
            {{$titulo}}
        </x-slot>

        <x-slot name="content">
            {{$mensajemodal}}             
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$toggle('eliminarlaboratorio', false)"
                wire:loading.attr="disabled"
                class="border border-red-700 bg-red-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                {{ __('Cancelar') }}
            </button>
            <button type="button" wire:click="borrarlaboratorio({{$idusuario}})" wire:loading.attr="disabled"
                class="border border-emerald-700 bg-emerald-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline">
                {{ __('Eliminar') }}
            </button>
        </x-slot>
    </x-dialog-modal>   

    <!-- Inicio del Modal para Ver Laboratorio -->
    <x-dialog-modal wire:model="modalverlaboratorio">
        <x-slot name="title">
            {{ $titulo }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 gap-4">
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Nombre del Usuario') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="nombre" disabled />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="correo" value="{{ __('Correo del Usuario') }}" />
                    <x-input type="email" class="mt-1 input input-bordered w-full rounded-lg" wire:model="correo" disabled />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Nombre del Laboratorio') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg"
                        wire:model="laboratorio" disabled />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Rif del Usuario') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="rif" disabled/>
                    
                </div>

                <div class="col-span-2 sm:col-span-2">
                    <x-label for="codigo_internacional" value="{{ __('Código Internacional') }}" />
                    <select name="codigo_internacional" id="codigo_internacional" wire:model="codigo_internacional"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm" disabled>
                        <option value="" selected>Seleccione</option>
                        <option value="+58">+58</option>
                    </select>
                </div>
                <div class="col-span-2 sm:col-span-2">
                    <x-label for="codigo_operador" value="{{ __('Código de Operador') }}" />
                    <select name="codigo_operador" id="codigo_operador" wire:model="codigo_operador"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm" disabled>
                        <option value="" selected>Seleccione</option>
                        <option value="412">412</option>
                        <option value="414">414</option>
                        <option value="424">424</option>
                        <option value="416">416</option>
                        <option value="424">426</option>
                    </select>
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nrotelefono" value="{{ __('Números de Teléfono') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg"
                        wire:model="nrotelefono" disabled />
                </div>
                <div class="col-span-2 sm:col-span-2">
                    <x-label for="whatsapp" value="{{ __('¿Tiene Whatsapp?') }}" />
                    <select name="whatsapp" id="whatsapp" wire:model="whatsapp"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm" disabled>
                        <option value="" selected>Seleccione</option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$toggle('modalverlaboratorio', false)"
                wire:loading.attr="disabled"
                class="border border-red-700 bg-red-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                {{ __('Cancelar') }}
            </button>
        </x-slot>
    </x-dialog-modal>
    <!-- Fin del Modal para Ver Laboratorio -->

    <!-- Inicio del Modal para Agregar Laboratorio -->
    <x-dialog-modal wire:model="modaleditarlaboratorio">
        <x-slot name="title">
            {{ $titulo }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 gap-4">
                
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Nombre del Usuario') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="nombre" />
                    <x-input-error for="nombre" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="correo" value="{{ __('Correo del Usuario') }}" />
                    <x-input type="email" class="mt-1 input input-bordered w-full rounded-lg" wire:model="correo" />
                    <x-input-error for="correo" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Nombre del Laboratorio') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg"
                        wire:model="laboratorio" />
                    <x-input-error for="laboratorio" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nombre" value="{{ __('Rif del Usuario') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="rif" />
                    <x-input-error for="rif" class="mt-2" />
                </div>

                <div class="col-span-2 sm:col-span-2">
                    <x-label for="codigo_internacional" value="{{ __('Código Internacional') }}" />
                    <select name="codigo_internacional" id="codigo_internacional" wire:model="codigo_internacional"
                        class="mt-1 block w-full border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="" selected>Seleccione</option>
                        <option value="+58">+58</option>
                    </select>
                    <x-input-error for="codigo_internacional" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-2">
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
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="nrotelefono" value="{{ __('Números de Teléfono') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg"
                        wire:model="nrotelefono" />
                    <x-input-error for="nrotelefono" class="mt-2" />
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

            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$toggle('modaleditarlaboratorio', false)"
                wire:loading.attr="disabled"
                class="border border-red-700 bg-red-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                {{ __('Cancelar') }}
            </button>
            <button type="button" wire:click="editarlab()" wire:loading.attr="disabled"
                class="border border-emerald-700 bg-emerald-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-emerald-800 focus:outline-none focus:shadow-outline">
                {{ __('Guardar') }}
            </button>
        </x-slot>
    </x-dialog-modal>
    <!-- Fin del Modal para Agregar Laboratorio -->

    <!-- Inicio del Modal para Alerta Eliminar cuenta -->
    <x-dialog-modal wire:model="mostrarTokenApi">
        <x-slot name="title">
            {{$titulo}}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-4 gap-4">
                <div class="col-span-2 sm:col-span-4 md:col-span-4">
                    <x-label for="token" value="{{ __('Token API') }}" />
                    <x-input type="text" class="mt-1 input input-bordered w-full rounded-lg" wire:model="token" disabled />
                </div>  
            </div>             
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$toggle('mostrarTokenApi', false)"
                wire:loading.attr="disabled"
                class="border border-red-700 bg-red-700 text-white rounded-lg px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline">
                {{ __('Aceptar') }}
            </button>
        </x-slot>
    </x-dialog-modal> 
</div>
