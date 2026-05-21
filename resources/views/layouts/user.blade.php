
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Alebringüe - Domina tu pronunciación')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..28,300;12..28,400;12..28,500;12..28,600;12..28,700;12..28,800&family=Bungee&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'ale-pink': '#E4007C',
                        'ale-bg': '#131313',
                        'ale-surface': '#19191c',
                        'ale-surface-light': '#222222',
                        'ale-text': '#FAF9F6',
                        'ale-text-dim': 'rgba(250, 249, 246, 0.7)',
                        'ale-border': 'rgba(228, 0, 124, 0.25)',
                    }
                }
            }
        }
    </script> -->

        {{-- Configuración del tema: paleta idéntica a los tokens Flutter --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bone:       '#FAF9F6',   /* _kBone    */
                        carbon:     '#131313',   /* _kCarbon  */
                        magenta:    '#E0007C',   /* _kMagenta */
                        cyan:       '#00E5FF',   /* _kCyan    */
                        surface:    '#1C1C1C',   /* _kSurface */
                        surface2:   '#262626',   /* _kSurface2*/
                        borderdim:  '#373737',   /* _kBorderDim */
                        textdim:    '#888888',   /* _kTextDim */
                    },
                    fontFamily: {
                        bungee:    ['Bungee', 'cursive'],
                        grotesque: ['Space Grotesk', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #131313;
            font-family: 'Bricolage Grotesque', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, sans-serif;
            color: #FAF9F6;
        }
        
        /* Sidebar transitions */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        
        .sidebar-overlay {
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
        }
        
        .mobile-menu-hidden {
            transform: translateX(-100%);
        }
        
        @media (min-width: 768px) {
            .mobile-menu-hidden {
                transform: translateX(0);
            }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #19191c;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #E4007C;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #ff3399;
        }
        
        /* Nav links */
        .nav-link {
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(228, 0, 124, 0.15);
            color: #E4007C;
        }
        
        .sidebar-link {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar-link:hover {
            background-color: rgba(228, 0, 124, 0.12);
            color: #E4007C;
            border-left-color: #E4007C;
        }
        
        .sidebar-link.active {
            background-color: rgba(228, 0, 124, 0.2);
            color: #E4007C;
            border-left-color: #E4007C;
        }
        
        /* Cards */
        .card-ale {
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.1) 0%, rgba(228, 0, 124, 0.03) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(228, 0, 124, 0.25);
            border-radius: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .card-ale:hover {
            border-color: rgba(228, 0, 124, 0.5);
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -12px rgba(228, 0, 124, 0.2);
        }
        
        /* Buttons */
        .btn-primary {
            background: #E4007C;
            border: none;
            border-radius: 2.5rem;
            padding: 0.7rem 1.5rem;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 600;
            color: #FAF9F6;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: #c2006b;
            transform: scale(0.98);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid rgba(228, 0, 124, 0.5);
            border-radius: 2.5rem;
            padding: 0.7rem 1.5rem;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 600;
            color: #FAF9F6;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-outline:hover {
            background: rgba(228, 0, 124, 0.15);
            border-color: #E4007C;
        }
        
        /* Badges */
        .badge-ale {
            background: rgba(228, 0, 124, 0.2);
            color: #E4007C;
            border-radius: 2rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Avatar */
        .avatar-ale {
            border: 2px solid #E4007C;
            border-radius: 50%;
        }
        
        /* Inputs */
        .input-ale {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(228, 0, 124, 0.35);
            border-radius: 1rem;
            padding: 0.7rem 1rem;
            font-family: 'Bricolage Grotesque', sans-serif;
            color: #FAF9F6;
            transition: all 0.2s ease;
            outline: none;
            width: 100%;
        }
        
        .input-ale:focus {
            border-color: #E4007C;
            box-shadow: 0 0 0 3px rgba(228, 0, 124, 0.25);
            background: rgba(255, 255, 255, 0.1);
        }
        
        .input-ale::placeholder {
            color: rgba(250, 249, 246, 0.4);
        }
        
        /* Brand logo */
        .brand-logo {
            font-family: 'Bungee', cursive;
            background: #E4007C ;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
        
        /* Progress bar */
        .progress-bar {
            background: rgba(228, 0, 124, 0.2);
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .progress-fill {
            background: linear-gradient(90deg, #E4007C, #ff66b5);
            height: 100%;
            border-radius: 1rem;
            transition: width 0.3s ease;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen bg-ale-bg">
    
    <div class="flex flex-col min-h-screen">
        
        <!-- Header User -->
        <header class="bg-black/90 border-b border-ale-border backdrop-blur-sm sticky top-0 z-30">
            <div class="flex items-center justify-between px-4 py-3 md:px-6">
                
                <!-- Logo y botón mobile -->
                <div class="flex items-center space-x-3">
                    <div class="flex items-center">
                        <a href="/" class="inline-block focus:outline-none" aria-label="Ir al inicio de Alebringüe">
                            <img 
                                src="{{ asset('images/Logo.png') }}" 
                                alt="Logo Alebringüe" 
                                class="w-auto h-12 md:h-16 object-contain"
                                loading="eager"
                                decoding="async"
                            >
                        </a>
                    </div>
                </div>
                
                <!-- Navegación desktop -->
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-ale-text-dim hover:text-ale-pink transition">Inicio</a>
                    <a href="{{ route('lessons.page') }}" class="text-ale-text-dim hover:text-ale-pink transition">Lecciones</a>
                    <a href="#" class="text-ale-text-dim hover:text-ale-pink transition">Practicar</a>
                    <a href="#" class="text-ale-text-dim hover:text-ale-pink transition">Mi Progreso</a>
                </nav>
                
                <!-- Perfil y notificaciones -->
                <div class="flex items-center space-x-4">
                    <!-- Notificaciones -->
                    <button class="relative text-ale-text-dim hover:text-ale-pink transition">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute -top-1 -right-2 w-4 h-4 bg-ale-pink rounded-full text-[10px] flex items-center justify-center text-white"></span>
                    </button>
                    
                    <!-- Dropdown usuario -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-9 h-9 bg-gradient-to-r from-ale-pink to-pink-600 rounded-full flex items-center justify-center avatar-ale">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="hidden md:block text-ale-text text-sm font-medium">{{ Auth::user()->name ?? 'Usuario' }}</span>
                            <i class="fas fa-chevron-down text-ale-text-dim text-xs hidden md:block"></i>
                        </button>
                        
                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-56 bg-ale-surface border border-ale-border rounded-xl shadow-xl z-50" style="display: none;">
                            <div class="p-3 border-b border-ale-border">
                                <p class="text-ale-text font-medium text-sm">{{ Auth::user()->name ?? 'Invitado' }}</p>
                                <p class="text-ale-text-dim text-xs">{{ Auth::user()->email ?? 'usuario@ejemplo.com' }}</p>
                                <span class="badge-ale text-xs mt-1 inline-block">Estudiante</span>
                            </div>
                            <div class="py-2">
                                <a href="#" class="sidebar-link block px-4 py-2 text-sm text-ale-text-dim hover:text-ale-pink">
                                    <i class="fas fa-user-circle mr-3 w-4"></i> Mi Perfil
                                </a>
                                <a href="#" class="sidebar-link block px-4 py-2 text-sm text-ale-text-dim hover:text-ale-pink">
                                    <i class="fas fa-chart-line mr-3 w-4"></i> Mi Progreso
                                </a>
                                <a href="#" class="sidebar-link block px-4 py-2 text-sm text-ale-text-dim hover:text-ale-pink">
                                    <i class="fas fa-cog mr-3 w-4"></i> Configuración
                                </a>
                            </div>
                            <div class="border-t border-ale-border py-2">
                               <a href="{{ route('logout') }}" class="sidebar-link block px-4 py-2 text-sm text-red-400 hover:text-red-300">
                                    <i class="fas fa-sign-out-alt mr-3 w-4"></i> Cerrar Sesión
                                </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido principal con sidebar -->
        <div class="flex flex-1">
            
            <!-- Overlay móvil -->
            <div id="sidebar-overlay" class="fixed inset-0 z-10 sidebar-overlay md:hidden" style="display: none;"></div>
            
            <!-- Sidebar User -->
            <aside id="sidebar" class="mobile-menu-hidden sidebar-transition fixed md:relative z-20 w-64 bg-ale-surface border-r border-ale-border flex-shrink-0 h-full md:h-auto overflow-y-auto">
                <div class="p-4">
                    <!-- Perfil resumen -->
                    <div class="mb-6 p-3 bg-ale-surface-light rounded-xl border border-ale-border">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-ale-pink to-pink-600 rounded-full flex items-center justify-center avatar-ale">
                                <i class="fas fa-user text-white text-lg"></i>
                            </div>
                            <div>
                                <p class="text-ale-text font-semibold">{{ Auth::user()->name ?? 'Usuario' }}</p>
                                <!-- <p class="text-ale-text-dim text-xs">Nivel: Intermedio</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <i class="fas fa-star text-yellow-500 text-xs"></i>
                                    <span class="text-ale-text-dim text-xs">1,250 pts</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Menú navegación -->
                    <nav>
                        <h2 class="text-ale-pink font-semibold text-xs uppercase tracking-wider mb-3 flex items-center">
                            <i class="fas fa-compass mr-2"></i> Menú Principal
                        </h2>
                        <ul class="space-y-1 mb-6">
                            <li>
                                <a href="{{ route('home') }}" class="sidebar-link block px-3 py-2.5 rounded-lg transition">
                                    <i class="fas fa-home mr-3 w-5"></i> Inicio
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lessons.page') }}" class="sidebar-link block px-3 py-2.5 rounded-lg transition">
                                    <i class="fas fa-chalkboard-user mr-3 w-5"></i> Lecciones
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('classrooms.user') }}" class="sidebar-link block px-3 py-2.5 rounded-lg transition">
                                    <i class="fas fa-chalkboard mr-3 w-5"></i> Clases
                                </a>
                            </li>
                            <li>
                                <a href="#" class="sidebar-link block px-3 py-2.5 rounded-lg transition">
                                    <i class="fas fa-microphone-alt mr-3 w-5"></i> Practicar
                                </a>
                            </li>
                            <li>
                                <a href="#" class="sidebar-link block px-3 py-2.5 rounded-lg transition">
                                    <i class="fas fa-chart-line mr-3 w-5"></i> Progreso
                                </a>
                            </li>
                        </ul>
                        
                        <!-- Racha y actividad
                        <div class="mt-4 p-3 bg-black/30 rounded-xl border border-ale-border/50">
                            <h3 class="font-medium text-xs text-ale-text-dim uppercase tracking-wider mb-3 flex items-center">
                                <i class="fas fa-fire mr-2 text-orange-500"></i> Tu actividad
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between items-center">
                                    <span class="text-ale-text-dim">Racha actual:</span>
                                    <span class="font-bold text-ale-text"><i class="fas fa-fire text-orange-500 mr-1"></i> 7 días</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-ale-text-dim">Lecciones completadas:</span>
                                    <span class="font-bold text-ale-text">12/20</span>
                                </div>
                                <div class="progress-bar h-2 mt-1">
                                    <div class="progress-fill" style="width: 60%"></div>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-ale-text-dim">Puntos totales:</span>
                                    <span class="font-bold text-ale-pink">1,250</span>
                                </div>
                            </div>
                        </div> -->
                        
                        <!-- Descarga app -->
                        <div class="mt-4 p-3 bg-gradient-to-r from-ale-pink/20 to-transparent rounded-xl border border-ale-pink/30">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-mobile-alt text-ale-pink text-lg"></i>
                                <span class="text-xs font-semibold text-ale-pink">Descarga la app</span>
                            </div>
                            <p class="text-ale-text-dim text-xs mb-2">Practica desde cualquier lugar</p>
                            <div class="flex gap-2">
                                <a href="#" class="text-ale-text-dim hover:text-ale-pink text-xs"><i class="fab fa-apple"></i> App Store</a>
                                <a href="#" class="text-ale-text-dim hover:text-ale-pink text-xs"><i class="fab fa-google-play"></i> Google Play</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </aside>
            
            <!-- Contenido principal -->
            <main class="flex-1 overflow-auto min-h-screen">
                <div class="p-4 md:p-6">
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Footer User -->
        <footer class="bg-black/50 border-t border-ale-border py-4 mt-auto">
            <div class="px-4 md:px-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-ale-text-dim">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-microphone-alt text-ale-pink"></i>
                        <span>© 2026 Alebringüe - Aprende inglés con IA</span>
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="hover:text-ale-pink transition">Términos</a>
                        <a href="#" class="hover:text-ale-pink transition">Privacidad</a>
                        <a href="#" class="hover:text-ale-pink transition">Ayuda</a>
                        <a href="#" class="hover:text-ale-pink transition">Contacto</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Menú móvil
        const menuBtn = document.getElementById('mobile-menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (menuBtn && sidebar && overlay) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('mobile-menu-hidden');
                overlay.style.display = sidebar.classList.contains('mobile-menu-hidden') ? 'none' : 'block';
                document.body.style.overflow = sidebar.classList.contains('mobile-menu-hidden') ? '' : 'hidden';
            });
            
            overlay.addEventListener('click', () => {
                sidebar.classList.add('mobile-menu-hidden');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            });
        }
        
        // Marcar link activo
        document.querySelectorAll('.sidebar-link').forEach(link => {
            if (link.getAttribute('href') === window.location.pathname) {
                link.classList.add('active');
            }
        });
    </script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('scripts')
</body>
</html>