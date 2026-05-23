@extends('layouts.user')

@section('title', 'Mi Perfil')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Encabezado -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <x-breadcrumbs :links="[
                ['name' => 'Inicio']
                    ]" />
            <h1 class="text-2xl md:text-3xl font-bold text-ale-text flex items-center gap-3">
                <i class="fas fa-user-circle text-ale-pink text-3xl"></i>
                Mi Perfil
            </h1>
            <p class="text-ale-text-dim text-sm mt-1">Gestiona tu información personal y preferencias</p>
        </div>
        
        <!-- Botón editar perfil -->
        <!-- <a href="#" class="btn-primary flex items-center gap-2 text-sm">
            <i class="fas fa-pen"></i>
            Editar perfil
        </a> -->
    </div>
    
    <!-- Grid de información principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Columna izquierda - Avatar e información básica -->
        <div class="lg:col-span-1">
            <div class="card-ale p-6 text-center">
                <!-- Avatar grande -->
                <div class="relative inline-block">
                    <div class="w-32 h-32 mx-auto bg-gradient-to-br from-ale-pink to-pink-600 rounded-full flex items-center justify-center shadow-xl">
                        <span class="text-white text-4xl font-bold font-bungee">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="absolute bottom-2 right-0 left-0 mx-auto w-8 h-8 bg-green-500 rounded-full border-4 border-ale-surface flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>
                
                <!-- Nombre y rol -->
                <h2 class="text-xl font-bold text-ale-text mt-4">{{ auth()->user()->name }}</h2>
                <div class="flex items-center justify-center gap-2 mt-2">
                    @if(auth()->user()->user_type == 'admin')
                        <span class="badge-ale bg-purple-500/20 text-purple-400 px-3 py-1">
                            <i class="fas fa-user-shield mr-1"></i> Administrador
                        </span>
                    @else
                        <span class="badge-ale bg-blue-500/20 text-blue-400 px-3 py-1">
                            <i class="fas fa-user-graduate mr-1"></i> Estudiante
                        </span>
                    @endif
                </div>
                
                <!-- Miembro desde -->
                <div class="mt-4 pt-4 border-t border-ale-border">
                    <p class="text-ale-text-dim text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-calendar-alt"></i>
                        Miembro desde {{ auth()->user()->created_at ? auth()->user()->created_at->format('F Y') : 'N/A' }}
                    </p>
                </div>
            </div>
            
            <!-- Tarjeta de estadísticas rápidas -->
            <!-- <div class="card-ale p-5 mt-4">
                <h3 class="text-sm font-semibold text-ale-pink uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-simple"></i>
                    Estadísticas rápidas
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-ale-text-dim text-sm">Nivel actual</span>
                        <span class="text-ale-text font-semibold">Intermedio</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-ale-text-dim text-sm">Lecciones completadas</span>
                        <span class="text-ale-text font-semibold">12/20</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-ale-text-dim text-sm">Racha de práctica</span>
                        <span class="text-ale-text font-semibold flex items-center gap-1">
                            <i class="fas fa-fire text-orange-500"></i> 7 días
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-ale-text-dim text-sm">Puntos totales</span>
                        <span class="text-ale-pink font-bold">1,250 pts</span>
                    </div>
                </div>
            </div> -->
        </div>
        
        <!-- Columna derecha - Información detallada -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Información personal -->
            <div class="card-ale p-6">
                <h3 class="text-lg font-semibold text-ale-text mb-4 flex items-center gap-2 border-b border-ale-border pb-3">
                    <i class="fas fa-address-card text-ale-pink"></i>
                    Información personal
                </h3>
                
                <div class="space-y-4">
                    <!-- Nombre completo -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="text-sm text-ale-text-dim flex items-center gap-2">
                                <i class="fas fa-user w-4"></i>
                                Nombre completo
                            </label>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-ale-text font-medium">{{ auth()->user()->name }}</p>
                        </div>
                    </div>
                    
                    <!-- Correo electrónico -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="text-sm text-ale-text-dim flex items-center gap-2">
                                <i class="fas fa-envelope w-4"></i>
                                Correo electrónico
                            </label>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-ale-text font-medium">{{ auth()->user()->email }}</p>
                            <p class="text-xs text-ale-text-dim mt-1">Verificado</p>
                        </div>
                    </div>
                    
                    <!-- Tipo de cuenta -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="text-sm text-ale-text-dim flex items-center gap-2">
                                <i class="fas fa-user-tag w-4"></i>
                                Tipo de cuenta
                            </label>
                        </div>
                        <div class="md:col-span-2">
                            @if(auth()->user()->user_type == 'admin')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-400">
                                    <i class="fas fa-user-shield"></i> Administrador
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400">
                                    <i class="fas fa-user-graduate"></i> Estudiante
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Fecha de registro -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="text-sm text-ale-text-dim flex items-center gap-2">
                                <i class="fas fa-calendar-plus w-4"></i>
                                Fecha de registro
                            </label>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-ale-text font-medium">
                                {{ auth()->user()->created_at ? auth()->user()->created_at->format('l, d \\d\\e F \\d\\e Y') : 'N/A' }}
                            </p>
                            <p class="text-xs text-ale-text-dim mt-1">
                                {{ auth()->user()->created_at ? auth()->user()->created_at->diffForHumans() : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actividad reciente
            <div class="card-ale p-6">
                <h3 class="text-lg font-semibold text-ale-text mb-4 flex items-center gap-2 border-b border-ale-border pb-3">
                    <i class="fas fa-clock text-ale-pink"></i>
                    Actividad reciente
                </h3>
                
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-ale-surface transition">
                        <div class="w-10 h-10 bg-ale-pink/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-microphone-alt text-ale-pink"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-ale-text font-medium">Práctica de pronunciación</p>
                            <p class="text-ale-text-dim text-sm">Completaste la lección "The quick brown fox"</p>
                        </div>
                        <div class="text-right">
                            <p class="text-ale-text-dim text-xs">Hace 2 horas</p>
                            <span class="badge-ale text-xs">+50 pts</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-ale-surface transition">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-blue-400"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-ale-text font-medium">Nivel alcanzado</p>
                            <p class="text-ale-text-dim text-sm">Subiste al nivel Intermedio</p>
                        </div>
                        <div class="text-right">
                            <p class="text-ale-text-dim text-xs">Hace 3 días</p>
                            <span class="badge-ale text-xs">Logro</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-ale-surface transition">
                        <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-trophy text-green-400"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-ale-text font-medium">Racha de práctica</p>
                            <p class="text-ale-text-dim text-sm">Alcanzaste 7 días consecutivos</p>
                        </div>
                        <div class="text-right">
                            <p class="text-ale-text-dim text-xs">Hace 5 días</p>
                            <span class="badge-ale text-xs">🔥 Racha</span>
                        </div>
                    </div>
                </div>
                
                <a href="#" class="inline-flex items-center gap-1 mt-4 text-ale-pink text-sm hover:gap-2 transition">
                    Ver todo mi progreso <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
             -->
            <!-- Acciones de cuenta -->
            <!-- <div class="card-ale p-6">
                <h3 class="text-lg font-semibold text-ale-text mb-4 flex items-center gap-2 border-b border-ale-border pb-3">
                    <i class="fas fa-shield-alt text-ale-pink"></i>
                    Seguridad
                </h3>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" class="btn-outline flex items-center justify-center gap-2">
                        <i class="fas fa-key"></i>
                        Cambiar contraseña
                    </a>
                    <a href="#" class="btn-outline flex items-center justify-center gap-2">
                        <i class="fas fa-bell"></i>
                        Preferencias de notificación
                    </a>
                </div>
                
                <div class="mt-4 pt-4 border-t border-ale-border">
                    <form method="POST" action="#" class="inline">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm flex items-center gap-2 transition">
                            <i class="fas fa-sign-out-alt"></i>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
             -->
        </div>
        
    </div>
    
</div>
@endsection

@push('styles')
<style>
    .badge-ale {
        background: rgba(228, 0, 124, 0.2);
        color: #E4007C;
        border-radius: 2rem;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .font-bungee {
        font-family: 'Bungee', cursive;
    }
    
    /* Animación para el avatar */
    .card-ale .rounded-full {
        transition: transform 0.3s ease;
    }
    
    .card-ale:hover .rounded-full {
        transform: scale(1.02);
    }
</style>
@endpush
