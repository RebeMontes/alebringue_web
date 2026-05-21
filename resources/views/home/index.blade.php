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
            <div class="w-14 h-14 bg-gradient-to-br from-[#E0007C] to-[#c20068] rounded-full flex items-center justify-center shadow-lg">
                <i class="fas fa-user-shield text-white text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bungee text-white tracking-wide">
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
        <div class="bg-ale-surface border border-ale-border rounded-xl p-5 hover:border-[#E0007C] transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total Usuarios</p>
                    <p class="text-3xl font-bold text-white">{{ $users->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-[#E0007C]/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-[#E0007C] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total administradores -->
        <div class="bg-ale-surface border border-ale-border rounded-xl p-5 hover:border-[#E0007C] transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Administradores</p>
                    <p class="text-3xl font-bold text-white">{{ $users->where('user_type', 'admin')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-[#00E5FF]/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-shield text-[#00E5FF] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Usuarios nuevos del mes -->
        <div class="bg-ale-surface border border-ale-border rounded-xl p-5 hover:border-[#E0007C] transition-all">
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
        <h3 class="text-lg font-bungee text-white mb-4 flex items-center gap-2 tracking-wide">
            <i class="fas fa-bolt text-[#00E5FF]"></i>
            ACCESOS RÁPIDOS
        </h3>
        
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('users.index') }}" class="bg-[#E0007C] hover:bg-[#00E5FF] text-white font-bungee text-sm px-5 py-2.5 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-users"></i>
                GESTIÓN DE USUARIOS
            </a>

            <a href="{{ route('lessons.index') }}" class="bg-[#E0007C] hover:bg-[#00E5FF] text-white font-bungee text-sm px-5 py-2.5 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-book"></i>
                LECCIONES
            </a>

            <a href="{{ route('levels.index') }}" class="bg-[#E0007C] hover:bg-[#00E5FF] text-white font-bungee text-sm px-5 py-2.5 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-level-up-alt"></i>
                NIVELES
            </a>

            <a href="{{ route('classrooms.index') }}" class="bg-[#E0007C] hover:bg-[#00E5FF] text-white font-bungee text-sm px-5 py-2.5 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-chalkboard"></i>
                CLASES 
            </a>

           <a href="{{ route('words.index') }}" class="bg-[#E0007C] hover:bg-[#00E5FF] text-white font-bungee text-sm px-5 py-2.5 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-font"></i>
                PALABRAS
            </a>

            <a href="{{ route('categories.index') }}" class="bg-[#E0007C] hover:bg-[#00E5FF] text-white font-bungee text-sm px-5 py-2.5 rounded-lg transition flex items-center gap-2">
                <i class="fas fa-tags"></i>
                CATEGORÍAS
            </a>
            
            <!-- <a href="#" class="bg-transparent border border-ale-border hover:border-[#00E5FF] text-white font-bungee text-sm px-5 py-2.5 rounded-lg transition flex items-center gap-2 hover:text-[#00E5FF]">
                <i class="fas fa-cog"></i>
                CONFIGURACIÓN
            </a> -->
        </div>
    </div>

    <!-- Información del sistema educativo -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h3 class="text-lg font-bungee text-white mb-3 flex items-center gap-2 tracking-wide">
            <i class="fas fa-graduation-cap text-[#00E5FF]"></i>
            MÓDULOS DEL SISTEMA
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm text-gray-300">
            <div class="flex items-center gap-2">
                <i class="fas fa-code text-[#E0007C]"></i>
                <span>Programación Web</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-mobile-alt text-[#E0007C]"></i>
                <span>Frontend</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-database text-[#E0007C]"></i>
                <span>Acceso a Datos</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fas fa-shield-alt text-[#E0007C]"></i>
                <span>Seguridad</span>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bungee&display=swap');
    
    .font-bungee {
        font-family: 'Bungee', cursive;
        letter-spacing: 0.02em;
    }
</style>
@endpush