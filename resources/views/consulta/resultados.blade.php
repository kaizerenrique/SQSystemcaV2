@livewire('componentespage.header')

<x-guest-layout>
    <div class="py-12 mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (isset($error))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ $error }}
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('consulta.index') }}" class="text-blue-500 hover:underline">Volver a
                            intentar</a>
                    </div>
                @else
                    <h2 class="text-2xl font-bold mb-2">Documentos de {{ $persona->nombres }} {{ $persona->apellidos }}
                    </h2>
                    <p class="text-gray-600 mb-4">Cédula: {{ $persona->cedula }}</p>

                    @if ($historiales->count() > 0)
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">Fecha</th>
                                    <th class="py-2 px-4 border-b text-left">Laboratorio</th>
                                    <th class="py-2 px-4 border-b text-left">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historiales as $historial)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $historial->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="py-2 px-4 border-b">{{ $historial->laboratorio->nombre ?? 'N/A' }}
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <a href="{{ route('consulta.ver', $historial->url_code) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-900 mr-3">
                                                Ver
                                            </a>
                                            <a href="{{ route('consulta.descargar', $historial->url_code) }}"
                                                class="text-green-600 hover:text-green-900">
                                                Descargar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $historiales->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">No hay documentos asociados a esta cédula.</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('consulta.index') }}" class="text-blue-500 hover:underline">← Nueva
                            consulta</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
