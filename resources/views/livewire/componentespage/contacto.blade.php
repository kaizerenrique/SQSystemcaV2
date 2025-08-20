<!-- Contact Section -->
<section id="contacto" class="text-gray-600 body-font relative py-16 md:py-24">
    <div class="container px-5 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
            <h2 class="sm:text-4xl text-3xl font-bold title-font mb-4 text-dark">Contáctenos</h2>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-xl">
                Estamos aquí para responder todas sus preguntas sobre nuestro software para laboratorios clínicos
            </p>
            <div class="flex mt-6 justify-center">
                <div class="w-16 h-1 rounded-full bg-accent inline-flex"></div>
            </div>
        </div>

        <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2">
                <div class="p-2 w-full md:w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600 font-medium">Nombre
                            completo</label>
                        <input type="text" id="name" name="name"
                            class="contact-input w-full bg-gray-100 bg-opacity-50 rounded-lg border border-gray-300 focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary text-base outline-none text-gray-700 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>
                <div class="p-2 w-full md:w-1/2">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600 font-medium">Correo
                            electrónico</label>
                        <input type="email" id="email" name="email"
                            class="contact-input w-full bg-gray-100 bg-opacity-50 rounded-lg border border-gray-300 focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary text-base outline-none text-gray-700 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="laboratorio" class="leading-7 text-sm text-gray-600 font-medium">Nombre del
                            laboratorio</label>
                        <input type="text" id="laboratorio" name="laboratorio"
                            class="contact-input w-full bg-gray-100 bg-opacity-50 rounded-lg border border-gray-300 focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary text-base outline-none text-gray-700 py-2 px-4 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="message" class="leading-7 text-sm text-gray-600 font-medium">Mensaje</label>
                        <textarea id="message" name="message"
                            class="contact-input w-full bg-gray-100 bg-opacity-50 rounded-lg border border-gray-300 focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary h-32 text-base outline-none text-gray-700 py-2 px-4 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                    </div>
                </div>
                <div class="p-2 w-full">
                    <button
                        class="flex mx-auto text-white bg-primary border-0 py-3 px-8 focus:outline-none hover:bg-secondary rounded-lg text-lg font-medium shadow-md transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i>Enviar mensaje
                    </button>
                </div>

                <div class="p-2 w-full pt-12 mt-12 border-t border-gray-200 text-center">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Email -->
                        <div class="contact-card p-6 bg-white rounded-lg shadow-md">
                            <div
                                class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-primary/10 text-primary mb-4 mx-auto">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <h3 class="text-dark text-lg font-medium title-font mb-2">Correo electrónico</h3>
                            <a href="mailto:info@labsoft.com"
                                class="text-primary leading-relaxed block">info@labsoft.com</a>
                            <a href="mailto:soporte@labsoft.com"
                                class="text-primary leading-relaxed block">soporte@labsoft.com</a>
                        </div>

                        <!-- Teléfono -->
                        <div class="contact-card p-6 bg-white rounded-lg shadow-md">
                            <div
                                class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-primary/10 text-primary mb-4 mx-auto">
                                <i class="fas fa-phone-alt text-xl"></i>
                            </div>
                            <h3 class="text-dark text-lg font-medium title-font mb-2">Teléfono</h3>
                            <p class="leading-relaxed">+1 (234) 567-8900</p>
                            <p class="leading-relaxed">+1 (234) 567-8901</p>
                        </div>

                        <!-- Dirección -->
                        <div class="contact-card p-6 bg-white rounded-lg shadow-md">
                            <div
                                class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-primary/10 text-primary mb-4 mx-auto">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <h3 class="text-dark text-lg font-medium title-font mb-2">Dirección</h3>
                            <p class="leading-relaxed">Av. Principal #123</p>
                            <p class="leading-relaxed">Ciudad, Estado 12345</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
