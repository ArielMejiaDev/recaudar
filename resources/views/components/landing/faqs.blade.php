<div id="faqs" class="h-auto lg:h-screen bg-mint flex items-center justify-center relative overflow-hidden pt-4 font-body">

    <svg class="absolute fill-current text-deepmint z-0" style="top: -125px; left: -25px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M112.7,-140.9C144.9,-107.4,169,-70.7,184.5,-26.1C200,18.5,206.9,71,185.7,106.6C164.4,142.2,114.9,160.8,65.9,176.7C17,192.6,-31.4,205.8,-75.7,195.2C-120.1,184.6,-160.5,150.3,-194,105.6C-227.5,60.8,-254.1,5.7,-248.8,-47.2C-243.5,-100.1,-206.3,-150.8,-159.5,-181.7C-112.7,-212.6,-56.4,-223.8,-8,-214.2C40.3,-204.7,80.6,-174.3,112.7,-140.9Z" />
        </g>
    </svg>

    <svg class="absolute fill-current text-deepmint z-0" style="bottom: -200px; right: -140px" width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(300,300)">
            <path d="M127,-142.3C156.7,-126.4,167.5,-78.9,180.8,-28.2C194.2,22.5,210.1,76.5,195.3,122.6C180.4,168.8,134.9,207,88.7,208.4C42.6,209.9,-4,174.5,-55,154.4C-105.9,134.4,-161.2,129.7,-194.1,99.2C-227.1,68.7,-237.6,12.5,-231.3,-43.8C-225,-100.2,-201.9,-156.6,-160.5,-170.4C-119.1,-184.3,-59.6,-155.7,-5.5,-149.1C48.6,-142.6,97.3,-158.3,127,-142.3Z" />
        </g>
    </svg>

    <div x-data="{showMore: false}" class="container mx-auto px-4 md:px-32 z-10 h-full">

        <h2 class="text-white text-center text-4xl lg:text-5xl mt-8 mb-16">Preguntas frecuentes</h2>

        <div x-show.transition.duration.200ms="!showMore" class="text-blue-900">

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">¿Qué es Recaudar.com?</h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">Somos el corazón de la caridad, porque conectamos organizaciones y donadores de una manera fácil y segura para cambiar el mundo.</p>
            </div>

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">¿Cómo puedo donar?</h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">Selecciona la organización que más te apasione para contribuir con su causa, escoge el monto y realiza tu donación. ¡Todo en menos de cinco minutos!</p>
            </div>

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">¿Qué es Recaudar.com?</h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">
                    Si eres una organización sin fines de lucro y deseas
                    recibir donaciones a través de Recaudar, debes llenar nuestro formulario de registro.
                    Revisaremos la validez de tu información y te notificaremos por correo electrónico
                    cuando estés listo para recibir donaciones. Si quieres ser parte de Recaudar,
                    <a href="{{ route('register') }}" class="underline">inscríbete aquí</a>.
                </p>
            </div>

            <span @click="showMore = !showMore;" class="text-blue-900 text-2xl font-bold hover:underline cursor-pointer block mb-6">Ver mas...</span>

        </div>

        <div x-show.transition.duration.200ms="showMore" class="text-blue-900">

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">¿Tiene algún costo crear mi perfil?</h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">
                    Si eres una organización sin fines de lucro,
                    crear tu perfil y empezar a recibir donaciones es totalmente gratis.
                    Si deseas tener acceso a los módulos de automatización de procesos
                    (Recursos humanos, finanzas, voluntariado, gestión de donantes y beneficiarios),
                    podrás optar por una suscripción mensual de $15.
                </p>
            </div>

            <div class="my-4">
                <h3 class="text-2xl lg:text-4xl">¿Por qué donar en Recaudar?</h3>
                <p class="mt-4 font-light text-lg lg:text-2xl font-display">
                    No somos un simple intermediario entre donantes y organizaciones.
                    Brindamos a los donantes una experiencia completa y un servicio
                    detallado donde puedes vivir y comprobar de primera mano el impacto
                    que está teniendo tu donativo. Proporcionamos una garantía de seguridad
                    de toda tu información, mientras ayudas a crear un mundo mejor.
                </p>
            </div>

            <span @click="showMore = !showMore;" class="text-blue-900 text-2xl font-bold hover:underline cursor-pointer">Regresar...</span>

        </div>

    </div>
</div>
