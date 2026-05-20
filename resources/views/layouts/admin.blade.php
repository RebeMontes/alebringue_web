<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Alebringüe')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..28,300;12..28,400;12..28,500;12..28,600;12..28,700;12..28,800&family=Bungee&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
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
                        'ale-success': '#10b981',
                        'ale-warning': '#f59e0b',
                        'ale-danger': '#ef4444',
                    }
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
        
        html, body {
            height: 100%;
            width: 100%;
        }
        
        body {
            background-color: #131313;
            font-family: 'Bricolage Grotesque', system-ui, sans-serif;
            color: #FAF9F6;
            overflow-x: hidden;
        }
        
        /* Sidebar - altura completa */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            background: #19191c;
        }
        
        /* Contenido principal - ocupa todo el espacio restante */
        .main-content {
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        
        /* Sidebar links */
        .sidebar-link {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar-link:hover, .sidebar-link.active {
            background-color: rgba(228, 0, 124, 0.12);
            color: #E4007C;
            border-left-color: #E4007C;
        }
        
        /* Cards Admin */
        .card-admin {
            background: linear-gradient(135deg, rgba(228, 0, 124, 0.1) 0%, rgba(228, 0, 124, 0.03) 100%);
            border: 1px solid rgba(228, 0, 124, 0.25);
            border-radius: 1rem;
            transition: all 0.3s ease;
        }
        
        /* Buttons */
        .btn-primary {
            background: #E4007C;
            border: none;
            border-radius: 2rem;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            color: #FAF9F6;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary:hover {
            background: #c2006b;
            transform: scale(0.98);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid rgba(228, 0, 124, 0.5);
            border-radius: 2rem;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            color: #FAF9F6;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-outline:hover {
            background: rgba(228, 0, 124, 0.15);
            border-color: #E4007C;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track { background: #19191c; }
        ::-webkit-scrollbar-thumb { background: #E4007C; border-radius: 10px; }
        
        /* Brand */
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
        
        /* Paginación */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .pagination .page-item .page-link {
            background: #19191c;
            border: 1px solid rgba(228, 0, 124, 0.25);
            color: #FAF9F6;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .pagination .page-item.active .page-link {
            background: #E4007C;
            border-color: #E4007C;
        }
        
        .pagination .page-item:hover .page-link {
            border-color: #E4007C;
        }
        
        /* Main content inner */
        .main-content-inner {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        main {
            flex: 1;
        }
        
        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 50;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-ale-bg">
    
    <div class="relative min-h-screen w-full">
        
        <!-- Sidebar Admin - altura completa -->
        <aside class="sidebar w-64 border-r border-ale-border z-30 flex-shrink-0">
            <div class="p-5">
                <!-- Logo -->
                <div class="mb-8 flex items-center justify-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <i class="fas  text-ale-pink text-2xl"></i>
                        <span class="brand-logo text-xl font-bold">ALEBRINGÜE</span>
                    </a>
                </div>
                
                <!-- Admin Info -->
                <div class="mb-6 p-3 bg-ale-surface-light rounded-xl border border-ale-border">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-ale-pink to-pink-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-shield text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-ale-text font-semibold text-sm">{{ Auth::user()->name ?? 'Administrador' }}</p>
                            <p class="text-ale-text-dim text-xs">Administrador</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navegación Admin -->
                <nav>
                    <h2 class="text-ale-pink font-semibold text-xs uppercase tracking-wider mb-3">Principal</h2>
                    <ul class="space-y-1 mb-6">
                        <li>
                            <a href="{{ route('home') }}" class="sidebar-link block px-3 py-2 rounded-lg transition text-sm">
                                <i class="fas fa-tachometer-alt mr-3 w-4"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}" class="sidebar-link block px-3 py-2 rounded-lg transition text-sm">
                                <i class="fas fa-users mr-3 w-4"></i> Gestión de Usuarios
                            </a>
                        </li>
                    </ul>
                    
                    <h2 class="text-ale-pink font-semibold text-xs uppercase tracking-wider mb-3">Labores</h2>
                    <ul class="space-y-1 mb-6">
                        <li>
                            <a href="{{ route('lessons.index') }}" class="sidebar-link block px-3 py-2 rounded-lg transition text-sm">
                                <i class="fas fa-book mr-3 w-4"></i> Lecciones
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('levels.index') }}" class="sidebar-link block px-3 py-2 rounded-lg transition text-sm">
                                <i class="fas fa-level-up-alt mr-3 w-4"></i> Niveles
                            </a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-link block px-3 py-2 rounded-lg transition text-sm">
                                <i class="fas fa-font mr-3 w-4"></i> Palabras
                            </a>
                        </li>
                         <li>
                            <a href="#" class="sidebar-link block px-3 py-2 rounded-lg transition text-sm">
                                <i class="fas fa-tags mr-3 w-4"></i> Categorías
                            </a>
                        </li>
                    </ul>

                    <h2 class="text-ale-pink font-semibold text-xs uppercase tracking-wider mb-3 mt-6">Sistema</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="#" class="sidebar-link block px-3 py-2 rounded-lg transition text-sm">
                                <i class="fas fa-cog mr-3 w-4"></i> Configuración
                            </a>
                        </li>
                        <li class="border-t border-ale-border pt-2 mt-2">
                            <a href="{{ route('logout') }}" class="sidebar-link block px-3 py-2 rounded-lg transition text-sm text-red-400 hover:text-red-300" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-3 w-4"></i> Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        
        <!-- Contenido principal Admin - con margin-left para compensar sidebar -->
        <div class="main-content" style="margin-left: 256px; width: calc(100% - 256px);">
            
            <!-- Header Admin - full width -->
            <header class="bg-black/90 border-b border-ale-border backdrop-blur-sm sticky top-0 z-20 w-full">
                <div class="px-6 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <!-- Botón para mobile sidebar -->
                        <button id="mobile-sidebar-toggle" class="md:hidden text-ale-text hover:text-ale-pink transition">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-ale-text">@yield('header', 'Panel de Administración')</h1>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <button class="text-ale-text-dim hover:text-ale-pink transition">
                            <i class="fas fa-bell"></i>
                        </button>
                        <div class="text-right">
                            <p class="text-ale-text text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-ale-text-dim text-xs">{{ Auth::user()->email ?? 'admin@alebringue.com' }}</p>
                        </div>
                        <div class="w-9 h-9 bg-gradient-to-r from-ale-pink to-pink-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-shield text-white text-sm"></i>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main content - ocupa todo el ancho restante y altura completa -->
            <main class="p-6 w-full flex-1">
                <div class="h-full">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Script para mobile sidebar -->
    <script>
        const mobileToggle = document.getElementById('mobile-sidebar-toggle');
        const sidebar = document.querySelector('.sidebar');
        
        if (mobileToggle && sidebar) {
            mobileToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
            
            // Cerrar sidebar al hacer click fuera en mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = mobileToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('open') && window.innerWidth < 768) {
                    sidebar.classList.remove('open');
                }
            });
        }
        
        // Marcar link activo en sidebar
        document.querySelectorAll('.sidebar-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href && href !== '#' && window.location.pathname === href) {
                link.classList.add('active');
            }
        });
        
        // Asegurar que el contenido tenga altura completa
        document.addEventListener('DOMContentLoaded', function() {
            const mainContent = document.querySelector('.main-content');
            const main = document.querySelector('main');
            
            if (mainContent && main) {
                const updateHeight = () => {
                    const windowHeight = window.innerHeight;
                    const headerHeight = document.querySelector('header')?.offsetHeight || 0;
                    main.style.minHeight = (windowHeight - headerHeight - 48) + 'px';
                };
                
                updateHeight();
                window.addEventListener('resize', updateHeight);
            }
        });
    </script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('scripts')
</body>
</html>