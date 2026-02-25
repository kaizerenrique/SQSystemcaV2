@livewire('componentespage.header')

<x-guest-layout>
    <div class="py-12 mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Consulta de Documentos</h2>
                <form action="{{ route('consulta.show') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="cedula" class="block text-gray-700 text-sm font-bold mb-2">Número de Cédula o Identificador (MSC-XXXXXXX)</label>
                        <input type="text" name="cedula" id="cedula" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ej. V12345678 o MSC-12345678" required>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Consultar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>