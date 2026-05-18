@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('header', 'Editar Usuario')

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
        <span class="text-ale-pink">Editar Usuario</span>
    </nav>

    <!-- Tarjeta del formulario -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-user-edit text-ale-pink"></i>
            Editar Usuario: {{ $users->name }}
        </h2>

        <form method="POST" action="{{ route('users.update', $users->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Campo Nombre -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-user mr-2 text-ale-pink"></i>
                    Nombre completo
                </label>
                <input type="text" name="name" value="{{ old('name', $users->name) }}" placeholder="Ej: Juan Pérez"
                    class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                @error('name')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Email -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-envelope mr-2 text-ale-pink"></i>
                    Correo electrónico
                </label>
                <input type="email" name="email" value="{{ old('email', $users->email) }}" placeholder="ejemplo@correo.com"
                    class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Contraseña (opcional) -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-key mr-2 text-ale-pink"></i>
                    Nueva contraseña (opcional)
                </label>
                <input type="password" name="password" placeholder="Dejar en blanco para mantener la actual"
                    class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Mínimo 8 caracteres. Solo completar si desea cambiar la contraseña.</p>
            </div>

            <!-- Campo Tipo de usuario -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-user-tag mr-2 text-ale-pink"></i>
                    Tipo de usuario
                </label>
                <select name="user_type" class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                    <option value="user" {{ $users->user_type == 'user' ? 'selected' : '' }}>Estudiante</option>
                    <option value="admin" {{ $users->user_type == 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
                @error('user_type')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Estado -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-toggle-on mr-2 text-ale-pink"></i>
                    Estado
                </label>
                <select name="status" class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                    <option value="active" {{ ($users->status ?? 'active') == 'active' ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ ($users->status ?? 'active') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('status')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="bg-ale-pink hover:bg-pink-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Actualizar Usuario
                </button>
                <a href="{{ route('users.index') }}" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <!-- Información adicional -->
    <div class="mt-4 p-4 bg-ale-surface/50 border border-ale-border rounded-lg">
        <div class="flex items-center justify-between text-sm">
            <div class="text-gray-400">
                <i class="fas fa-calendar-alt mr-2 text-ale-pink"></i>
                Registrado: {{ $users->created_at ? $users->created_at->format('d/m/Y H:i') : 'N/A' }}
            </div>
            <div class="text-gray-400">
                <i class="fas fa-id-card mr-2 text-ale-pink"></i>
                ID: {{ $users->id }}
            </div>
        </div>
    </div>

</div>
@endsection