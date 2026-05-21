@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('header', 'Editar Usuario')

@section('content')
<div class="max-w-2xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
        ['name' => 'Inicio', 'url' => route('home')],
        ['name' => 'Usuarios', 'url' => route('users.index')],
        ['name' => 'Editar']
        ]" />
    </nav>

    <!-- Tarjeta del formulario -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h2 class="text-xl font-bungee text-white mb-6 flex items-center gap-2 tracking-wide">
            <i class="fas fa-user-edit text-[#00E5FF]"></i>
            EDITAR USUARIO: {{ $user->name }}
        </h2>

        <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Campo Nombre -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-user mr-2 text-[#E0007C]"></i>
                    Nombre completo
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Ej: Juan Pérez"
                    class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition">
                @error('name')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Email -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-envelope mr-2 text-[#E0007C]"></i>
                    Correo electrónico
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="ejemplo@correo.com"
                    class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Contraseña (opcional) -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-key mr-2 text-[#E0007C]"></i>
                    Nueva contraseña (opcional)
                </label>
                <input type="password" name="password" placeholder="Dejar en blanco para mantener la actual"
                    class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition">
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Mínimo 8 caracteres. Solo completar si desea cambiar la contraseña.</p>
            </div>

            <!-- Campo Tipo de usuario -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-user-tag mr-2 text-[#E0007C]"></i>
                    Tipo de usuario
                </label>
                <select name="user_type" class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition">
                    <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>Estudiante</option>
                    <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
                @error('user_type')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> 

            <!-- Botones de acción -->
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="bg-[#00E5FF] hover:bg-[#c20068] text-black px-6 py-2.5 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide">
                    <i class="fas fa-save"></i>
                    ACTUALIZAR USUARIO
                </button>
                <a href="{{ route('users.index') }}" class="bg-transparent border border-ale-border hover:border-[#00E5FF] text-white px-6 py-2.5 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide hover:text-[#00E5FF]">
                    <i class="fas fa-times"></i>
                    CANCELAR
                </a>
            </div>
        </form>
    </div>

    <!-- Información adicional -->
    <div class="mt-4 p-4 bg-ale-surface/50 border border-ale-border rounded-lg">
        <div class="flex items-center justify-between text-sm">
            <div class="text-gray-400">
                <i class="fas fa-calendar-alt mr-2 text-[#00E5FF]"></i>
                Registrado: {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}
            </div>
            <div class="text-gray-400">
                <i class="fas fa-id-card mr-2 text-[#E0007C]"></i>
                ID: {{ $user->id }}
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