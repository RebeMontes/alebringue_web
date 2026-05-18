@extends('layouts.admin')

@section('title', 'Detalle Usuario')

@section('header', 'Detalle del Usuario')

@section('content')
<div class="max-w-2xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-ale-pink transition">
            <i class="fas fa-home text-ale-pink"></i> Inicio
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="#" class="hover:text-ale-pink transition">Usuarios</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-ale-pink">Detalle: {{ $user->name }}</span>
    </nav>

    <!-- Tarjeta principal -->
    <div class="bg-ale-surface border border-ale-border rounded-xl overflow-hidden">

        <!-- Cabecera con avatar -->
        <div class="bg-gradient-to-r from-ale-pink/15 to-transparent p-6 border-b border-ale-border">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 bg-gradient-to-br from-ale-pink to-pink-600 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-white text-2xl font-bold font-bungee">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                    <div class="flex items-center gap-2 mt-1">
                        @if($user->user_type == 'admin')
                            <span class="badge-ale bg-purple-500/20 text-purple-400 px-3 py-1 text-xs rounded-full">
                                <i class="fas fa-user-shield mr-1"></i> Administrador
                            </span>
                        @else
                            <span class="badge-ale bg-blue-500/20 text-blue-400 px-3 py-1 text-xs rounded-full">
                                <i class="fas fa-user-graduate mr-1"></i> Estudiante
                            </span>
                        @endif
                        @if(($user->status ?? 'active') == 'active')
                            <span class="badge-ale bg-green-500/20 text-green-400 px-3 py-1 text-xs rounded-full">
                                <i class="fas fa-check-circle mr-1"></i> Activo
                            </span>
                        @else
                            <span class="badge-ale bg-red-500/20 text-red-400 px-3 py-1 text-xs rounded-full">
                                <i class="fas fa-times-circle mr-1"></i> Inactivo
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del usuario -->
        <div class="p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <i class="fas fa-address-card text-ale-pink"></i>
                Información personal
            </h3>

            <div class="space-y-4">
                <!-- Nombre -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-ale-border">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-user w-4 text-ale-pink"></i>
                            Nombre completo
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-white font-medium">{{ $user->name }}</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-ale-border">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-envelope w-4 text-ale-pink"></i>
                            Correo electrónico
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-white font-medium">{{ $user->email }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Verificado</p>
                    </div>
                </div>

                <!-- Tipo de usuario -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-ale-border">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-user-tag w-4 text-ale-pink"></i>
                            Tipo de cuenta
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        @if($user->user_type == 'admin')
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

                <!-- Estado -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-ale-border">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-toggle-on w-4 text-ale-pink"></i>
                            Estado
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        @if(($user->status ?? 'active') == 'active')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400">
                                <i class="fas fa-check-circle"></i> Activo
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400">
                                <i class="fas fa-times-circle"></i> Inactivo
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Progreso (solo para estudiantes) -->
                @if($user->user_type != 'admin')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-ale-border">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-chart-line w-4 text-ale-pink"></i>
                            Progreso
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <div class="flex items-center gap-3">
                            <div class="flex-1">
                                <div class="progress-bar h-2">
                                    <div class="progress-fill" style="width: {{ $user->progress ?? 0 }}%"></div>
                                </div>
                            </div>
                            <span class="text-ale-pink font-medium text-sm">{{ $user->progress ?? 0 }}%</span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Fecha de registro -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-calendar-alt w-4 text-ale-pink"></i>
                            Fecha de registro
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-white font-medium">{{ $user->created_at ? $user->created_at->format('d/m/Y H:i:s') : 'N/A' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $user->created_at ? $user->created_at->diffForHumans() : '' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="bg-ale-surface/50 p-6 border-t border-ale-border flex flex-wrap gap-3">
            <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-edit"></i>
                Editar Usuario
            </a>

            <a href="{{ route('users.index') }}" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver al listado
            </a>

            @if(($user->status ?? 'active') == 'active')
            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600/20 border border-red-600/50 hover:bg-red-600 text-red-400 hover:text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                    <i class="fas fa-trash-alt"></i>
                    Eliminar Usuario
                </button>
            </form>
            @endif
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
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
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
    
    .font-bungee {
        font-family: 'Bungee', cursive;
    }
</style>
@endpush