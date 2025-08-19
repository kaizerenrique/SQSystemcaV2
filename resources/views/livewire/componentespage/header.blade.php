<!-- Header/Navigation -->
<header class="text-gray-600 body-font w-full bg-white shadow-md fixed top-0 z-50">
    <div class="container mx-auto flex flex-wrap p-3 flex-col md:flex-row items-center">
        <div class="flex items-center justify-between w-full md:w-auto">
            <a class="flex title-font font-medium items-center text-gray-900 mb-0">
                <div class="w-10 h-10 text-white p-2 bg-primary rounded-full flex items-center justify-center">
                    <i class="fas fa-flask text-lg"></i>
                </div>
                <span class="ml-3 text-xl font-bold">SQ<span class="text-primary">System C.A</span></span>
            </a>

            <!-- Mobile menu button -->
            <button id="mobile-menu-button"
                class="md:hidden rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <nav id="nav-menu"
            class="md:ml-auto md:mr-auto flex-wrap items-center text-base justify-center hidden md:flex">
            <a href="#inicio" class="mr-5 hover:text-primary font-medium">Inicio</a>
            <a href="#caracteristicas" class="mr-5 hover:text-primary font-medium">Características</a>
            <a href="#soluciones" class="mr-5 hover:text-primary font-medium">Soluciones</a>
            <a href="#contacto" class="mr-5 hover:text-primary font-medium">Contacto</a>
        </nav>

        <div class="items-center text-base justify-center mt-4 md:mt-0 hidden md:flex">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('dashboard') }}"
                        class="inline-flex items-center bg-primary text-white border-0 py-2 px-4 focus:outline-none hover:bg-secondary rounded-lg text-base">
                        Dashboard
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center bg-light border border-primary text-primary py-2 px-4 focus:outline-none hover:bg-primary hover:text-white rounded-lg text-base mr-2">
                        Inicio de sesión
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center bg-primary border-0 py-2 px-4 focus:outline-none hover:bg-secondary text-white rounded-lg text-base">
                        Registrarse
                    </a>
                @endauth
            @endif
        </div>
    </div>

    <!-- Mobile menu (hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
        <div class="container mx-auto py-4 px-4">
            <a href="#inicio" class="block py-2 px-4 hover:bg-gray-100 rounded-lg">Inicio</a>
            <a href="#caracteristicas" class="block py-2 px-4 hover:bg-gray-100 rounded-lg">Características</a>
            <a href="#soluciones" class="block py-2 px-4 hover:bg-gray-100 rounded-lg">Soluciones</a>
            <a href="#contacto" class="block py-2 px-4 hover:bg-gray-100 rounded-lg">Contacto</a>

            <div class="pt-4 mt-4 border-t border-gray-200">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('dashboard') }}"
                            class="block py-2 px-4 bg-primary text-white text-center rounded-lg">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="block py-2 px-4 bg-light border border-primary text-primary text-center rounded-lg mb-2">
                            Inicio de sesión
                        </a>
                        <a href="{{ route('register') }}"
                            class="block py-2 px-4 bg-primary text-white text-center rounded-lg">
                            Registrarse
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');

        // Change icon based on menu state
        const iconSvg = this.querySelector('svg');
        if (mobileMenu.classList.contains('hidden')) {
            iconSvg.innerHTML = '<path d="M4 6h16M4 12h16M4 18h16"></path>';
        } else {
            iconSvg.innerHTML = '<path d="M6 18L18 6M6 6l12 12"></path>';
        }
    });

    // Close mobile menu when clicking on a link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.add('hidden');
            document.getElementById('mobile-menu-button').querySelector('svg').innerHTML =
                '<path d="M4 6h16M4 12h16M4 18h16"></path>';
        });
    });
</script>
