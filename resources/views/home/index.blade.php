{{-- resources/views/home/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard Administrativo')

@section('header', 'Panel de Control')

@section('content')
<div class="space-y-6">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')]
            ]" />
    </nav>

    <!-- Tarjeta de bienvenida -->
    <div class="bg-gradient-to-r from-ale-pink/10 to-transparent border border-ale-border rounded-xl p-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-gradient-to-br from-ale-pink to-pink-600 rounded-full flex items-center justify-center shadow-lg">
                <i class="fas fa-user-shield text-white text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">
                    Bienvenido, {{ $user->name }}
                </h2>
                <p class="text-gray-400 text-sm">
                    Panel de administración del sistema educativo
                </p>
            </div>
        </div>
    </div>

    <!-- Tarjetas estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Total usuarios -->
        <div class="bg-ale-surface border border-ale-border rounded-xl p-5 hover:border-ale-pink transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Usuarios</p>
                    <p class="text-3xl font-bold text-white">{{ $users->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-ale-pink/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-ale-pink text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total administradores -->
        <div class="bg-ale-surface border border-ale-border rounded-xl p-5 hover:border-ale-pink transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Administradores</p>
                    <p class="text-3xl font-bold text-white">{{ $users->where('user_type', 'admin')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-shield text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Usuarios nuevos del mes -->
        <div class="bg-ale-surface border border-ale-border rounded-xl p-5 hover:border-ale-pink transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Nuevos este mes</p>
                    <p class="text-3xl font-bold text-white">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-plus text-green-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-bolt text-ale-pink"></i>
            Accesos Rápidos
        </h3>
        
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('users.index') }}" class="bg-ale-pink hover:bg-pink-700 text-white px-5 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-users"></i>
                Gestión de Usuarios
            </a>
            
            <a href="#" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-5 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-cog"></i>
                Configuración
            </a>
        </div>
    </div>

    <!-- Información del sistema educativo -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
            <i class="fas fa-graduation-cap text-ale-pink"></i>
            Módulos del Sistema
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm text-gray-300">
            <div class="flex items-center gap-2">
                <i class="fas fa-code text-ale-pink"></i>
                <span>Programación Web</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-mobile-alt text-ale-pink"></i>
                <span>Frontend</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-database text-ale-pink"></i>
                <span>Acceso a Datos</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-shield-alt text-ale-pink"></i>
                <span>Seguridad</span>
            </div>
        </div>
    </div>

</div>
@endsection