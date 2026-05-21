
@extends('layouts.user')

@section('title', 'Mi Aprendizaje')

@section('content')
<div class="space-y-6">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400">
        <i class="fas fa-home text-ale-pink"></i>
        <span>Inicio</span>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-ale-pink">Dashboard</span>
    </nav>

    <!-- Tarjeta de bienvenida -->
    <div class="bg-gradient-to-r from-ale-pink/10 to-transparent border border-ale-border rounded-xl p-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-gradient-to-br from-ale-pink to-pink-600 rounded-full flex items-center justify-center shadow-lg">
                <i class="fas fa-user-graduate text-white text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">
                    Hola, {{ $user->name }} 👋
                </h2>
                <p class="text-gray-400 text-sm">
                    Continúa tu aprendizaje donde lo dejaste
                </p>
            </div>
        </div>
    </div>

    <!-- Tarjeta de progreso del usuario -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                <i class="fas fa-chart-line text-ale-pink"></i>
                Tu Progreso
            </h3>
            <span class="text-ale-pink font-medium">{{ $user->progress ?? 0 }}% Completado</span>
        </div>

        <!-- Barra de progreso visual -->
        <div class="w-full bg-gray-700 rounded-full h-3 overflow-hidden">
            <div class="progress-fill h-3 rounded-full transition-all duration-500" style="width: {{ $user->progress ?? 0 }}%; background: linear-gradient(90deg, #E4007C, #ff66b5);"></div>
        </div>

        <!-- Texto motivacional -->
        <p class="text-gray-400 text-sm mt-3">
            @if(($user->progress ?? 0) < 30)
                ¡Comienza hoy! Cada paso cuenta para dominar el desarrollo web.
            @elseif(($user->progress ?? 0) < 70)
                ¡Vas muy bien! Sigue practicando, estás cerca de la meta.
            @else
                ¡Excelente trabajo! Estás a punto de completar tu formación.
            @endif
        </p>
    </div>

    <!-- Acciones rápidas -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-bolt text-ale-pink"></i>
            Acciones Rápidas
        </h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="#" class="bg-ale-pink hover:bg-pink-700 text-white px-5 py-3 rounded-lg font-medium transition flex items-center justify-center gap-2">
                <i class="fas fa-play"></i>
                Continuar Aprendizaje
            </a>
            
            <a href="#" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-5 py-3 rounded-lg font-medium transition flex items-center justify-center gap-2">
                <i class="fas fa-book"></i>
                Ver Contenidos
            </a>
            
            <a href="#" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-5 py-3 rounded-lg font-medium transition flex items-center justify-center gap-2">
                <i class="fas fa-user"></i>
                Mi Perfil
            </a>
        </div>
    </div>

    <!-- Módulos de estudio -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-layer-group text-ale-pink"></i>
            Módulos de Estudio
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Programación Web -->
            <div class="border border-ale-border rounded-lg p-4 hover:bg-ale-pink/5 transition">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-ale-pink/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-code text-ale-pink"></i>
                    </div>
                    <h4 class="font-semibold text-white">Programación Web</h4>
                </div>
                <p class="text-gray-400 text-sm">HTML, CSS, JavaScript, Laravel, Formularios, APIs</p>
            </div>
            
            <!-- Frontend -->
            <div class="border border-ale-border rounded-lg p-4 hover:bg-ale-pink/5 transition">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-ale-pink/20 rounded-lg flex items-center justify-center">
                        <i class="fab fa-html5 text-ale-pink"></i>
                    </div>
                    <h4 class="font-semibold text-white">Frontend</h4>
                </div>
                <p class="text-gray-400 text-sm">HTML5, CSS3, Tailwind, Bootstrap, Diseño Responsive</p>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    .progress-fill {
        background: linear-gradient(90deg, #E4007C, #ff66b5);
    }
</style>
@endpush