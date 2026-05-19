<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alebringue | Domina tu pronunciación de inglés</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..28,300;12..28,400;12..28,500;12..28,600;12..28,700;12..28,800&family=Bungee&display=swap" rel="stylesheet">
    <!-- TailwindCSS v3 CDN -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="welcome-page ">

    <!-- Contenedor principal -->
    <div class="min-h-screen flex flex-col">
        
        <!-- ==================== HEADER - MENÚ NEGRO ==================== -->
        <header class="header">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <!-- Logo (solo texto, sin el recuadro) -->
                <span class="name-ezq">ALEBRINGÜE</span>

                <!-- Menú navegación escritorio -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('login') }}" class="bg-white text-black px-5 py-2 rounded-full font-semibold text-sm hover:bg-gray-200 transition-all ml-2">Iniciar Sesion</a>
                    <a href="#" class="btn-descargar px-5 py-2 rounded-full font-semibold text-sm ">Descargar app</a>
                </nav>

                <!-- Botón menú móvil hamburguesa -->
                <button id="menuBtn" class="md:hidden flex flex-col gap-1.5 p-2">
                    <span class="w-6 h-0.5 bg-white rounded-full"></span>
                    <span class="w-6 h-0.5 bg-white rounded-full"></span>
                    <span class="w-6 h-0.5 bg-white rounded-full"></span>
                </button>
            </div>

            <!-- Menú móvil desplegable -->
            <div id="mobileMenu" class="hidden md:hidden bg-black border-t border-gray-800 py-4 px-6 flex flex-col gap-4">
                 <a href="{{ route('login') }}" class="bg-white text-black px-5 py-2 rounded-full font-semibold text-sm hover:bg-gray-200 transition-all ml-2">Iniciar Sesion</a>
                    <a href="#" class="btn-descargar px-5 py-2 rounded-full font-semibold text-sm ">Descargar app</a>
            </div>
        </header>

        <!-- ==================== HERO PRINCIPAL ==================== -->
        <main class="flex-grow flex items-center justify-center">
            <div class="max-w-4xl mx-auto px-6 py-16 md:py-20 text-center">
                <!-- Título ALEBRINGUE -->
                <h1 class="brand-name">
                    ALEBRINGÜE
                </h1>
                
                
                <!-- Subtítulo -->
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mt-2 mb-6">
                    Domina tu pronunciación de inglés
                </h2>
                
                <!-- Descripción -->
                <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto leading-relaxed">
                    La plataforma diseñada para estudiantes que buscan hablar con confianza
                </p>
                
                <!-- Botón Empezar - Negro con letras blancas -->
                <div class="btn-empezar">
                    <a href="#" class="inline-block bg-black text-white px-8 py-3 rounded-full font-bold text-lg shadow-lg hover:bg-gray-800 transition-all hover:shadow-xl hover:-translate-y-0.5">
                        Empezar
                    </a>
                </div>
                 <!-- ==================== CARRUSEL INFORMATIVO ==================== -->
                <div class="carousel-container my-6">
                    <div id="carouselSlide" class="carousel-slide">
                        <div id="carouselContent">
                            <!-- El contenido se actualiza dinámicamente con JavaScript -->
                        </div>
                    </div>
                    
                    <!-- Indicadores (dots) -->
                    <div class="flex justify-center gap-2 mt-4">
                        <button class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/40 transition-all" data-index="0"></button>
                        <button class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/40 transition-all" data-index="1"></button>
                        <button class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/40 transition-all" data-index="2"></button>
                    </div>
                </div>
            </div>
        </main>

        <!-- ==================== FOOTER ==================== -->
        <footer class="py-4">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                    <span class="text-gray-400 text-xs">2026 Alebringüe</span>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript para menú móvil y carrusel -->
    <script>
        // ==================== MENÚ MÓVIL ====================
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
            
            const links = mobileMenu.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        }

        // ==================== CARRUSEL INFORMATIVO ====================
        // Datos del carrusel - información clave de la página
        const carouselItems = [
            {
                title: "✨ ¿Qué es Alebringüe?",
                description: "Plataforma educativa que utiliza inteligencia artificial para ayudarte a perfeccionar tu pronunciación en inglés de manera divertida y efectiva."
            },
            {
                title: "🚀 ¿Cómo funciona?",
                description: "Graba tu voz, nuestro sistema ASR analiza tu pronunciación en tiempo real y te da retroalimentación instantánea con ejercicios personalizados."
            },
            {
                title: "🏆 Beneficios",
                description: "Mejora tu fluidez, gana confianza al hablar, recibe lecciones adaptadas a tu nivel y sigue tu progreso con estadísticas detalladas."
            }
        ];

        let currentIndex = 0;
        let autoPlayInterval;
        const carouselContent = document.getElementById('carouselContent');
        const dots = document.querySelectorAll('.carousel-dot');

        // Función para actualizar el contenido del carrusel
        function updateCarousel(index) {
            if (!carouselContent) return;
            
            const item = carouselItems[index];
            if (!item) return;
            
            // Animación de fade
            carouselContent.style.opacity = '0';
            
            setTimeout(() => {
                carouselContent.innerHTML = `
                    <h3 class="text-white font-bold text-lg md:text-xl mb-2">${item.title}</h3>
                    <p class="text-gray-200 text-sm md:text-base leading-relaxed">${item.description}</p>
                `;
                carouselContent.style.opacity = '1';
            }, 150);
            
            // Actualizar dots
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                    dot.style.backgroundColor = 'white';
                    dot.style.opacity = '1';
                } else {
                    dot.classList.remove('active');
                    dot.style.backgroundColor = 'rgba(255, 255, 255, 0.4)';
                    dot.style.opacity = '0.7';
                }
            });
        }

        // Función para avanzar al siguiente slide
        function nextSlide() {
            currentIndex = (currentIndex + 1) % carouselItems.length;
            updateCarousel(currentIndex);
        }

        // Función para ir a un slide específico
        function goToSlide(index) {
            currentIndex = index;
            updateCarousel(currentIndex);
            resetAutoPlay();
        }

        // Resetear el autoplay
        function resetAutoPlay() {
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
            }
            autoPlayInterval = setInterval(nextSlide, 4000);
        }

        // Inicializar carrusel
        if (carouselContent && dots.length > 0) {
            updateCarousel(0);
            resetAutoPlay();
            
            // Agregar eventos a los dots
            dots.forEach((dot, idx) => {
                dot.addEventListener('click', () => {
                    goToSlide(idx);
                });
            });
            
            // Pausar autoplay al hacer hover sobre el carrusel
            const carouselSlide = document.getElementById('carouselSlide');
            if (carouselSlide) {
                carouselSlide.addEventListener('mouseenter', () => {
                    if (autoPlayInterval) {
                        clearInterval(autoPlayInterval);
                    }
                });
                
                carouselSlide.addEventListener('mouseleave', () => {
                    resetAutoPlay();
                });
            }
        }

        // Limpiar intervalo cuando la página se oculta (opcional)
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                }
            } else {
                resetAutoPlay();
            }
        });
    </script>
</body>
</html>

