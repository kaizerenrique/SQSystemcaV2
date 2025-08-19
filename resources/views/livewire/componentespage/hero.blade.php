<!-- Hero Section with HTML Background -->
<section id="inicio" class="pt-24 min-h-screen flex items-center overflow-hidden relative">
    <!-- Fondo con overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('plantilla/hero.jpeg') }}" alt="Fondo Hero" class="w-full h-full object-cover animate-fade-in">
        <div class="absolute inset-0 bg-primary/70 backdrop-blur-sm"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Software Especializado para <span class="text-accent">Laboratorios Clínicos</span>
                </h1>
                <p class="text-xl text-gray-100 mb-10 max-w-2xl">
                    Optimiza tus procesos, gestiona muestras y mejora la eficiencia de tu laboratorio con nuestra
                    solución integral.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#demo"
                        class="bg-accent hover:bg-green-500 text-white font-medium py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                        <i class="fas fa-calendar-check mr-2"></i>Solicitar Demo
                    </a>
                    <a href="#caracteristicas"
                        class="bg-transparent hover:bg-white/20 text-white border border-white font-medium py-3 px-6 rounded-lg transition duration-300">
                        <i class="fas fa-search mr-2"></i>Conocer Más
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="relative w-80 h-80 floating">
                    <div class="absolute inset-0 bg-primary/20 rounded-full animate-pulse"></div>
                    <div class="absolute inset-4 bg-primary/30 rounded-full animate-pulse"></div>
                    <div class="absolute inset-8 bg-white rounded-full flex items-center justify-center shadow-xl">
                        <img class="w-48 h-48"
                            src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect x='20' y='30' width='60' height='40' rx='5' fill='%231E40AF' opacity='0.7'/><circle cx='35' cy='50' r='5' fill='white'/><circle cx='50' cy='50' r='5' fill='white'/><circle cx='65' cy='50' r='5' fill='white'/><path d='M30 20 L70 20 L65 30 L35 30 Z' fill='%231E40AF' opacity='0.9'/></svg>"
                            alt="Software para Laboratorios">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
