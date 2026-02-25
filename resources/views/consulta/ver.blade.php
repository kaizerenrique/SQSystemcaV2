@livewire('componentespage.header')

<x-guest-layout>
    <div class="py-12 mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4 flex justify-between items-center">
                    <a href="{{ url()->previous() }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </a>
                    <a href="{{ route('consulta.descargar', $url_code) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0 0l-4-4m4 4l4-4"></path>
                        </svg>
                        Descargar documento
                    </a>
                </div>
                <iframe src="https://docs.google.com/viewer?url={{ urlencode($url) }}&embedded=true" 
                        style="width:100%; height:80vh;" 
                        frameborder="0">
                </iframe>
            </div>
        </div>
    </div>
</x-guest-layout>