
@extends('layouts.admin')

@section('title', 'Crear Usuario')

@section('header', 'Crear Nuevo Usuario')

@section('content')
<div class="max-w-2xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
        ['name' => 'Inicio', 'url' => route('home')],
        ['name' => 'Usuarios', 'url' => route('users.index')],
        ['name' => 'Crear']
         ]" />
    </nav>

    <!-- Tarjeta del formulario -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-user-plus text-ale-pink"></i>
            Crear Nuevo Usuario
        </h2>

        <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
            @csrf

            <!-- Campo Nombre -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-user mr-2 text-ale-pink"></i>
                    Nombre completo
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ej: Juan Pérez"
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
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@correo.com"
                    class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Contraseña -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-lock mr-2 text-ale-pink"></i>
                    Contraseña
                </label>
                <input type="password" id="password" name="password" placeholder="********"
                    class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Mínimo 8 caracteres</p>
            </div>

            <!-- Campo Tipo de usuario -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-user-tag mr-2 text-ale-pink"></i>
                    Tipo de usuario
                </label>
                <select id="user_type" name="user_type" class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                    <option value="user">Estudiante</option>
                    <option value="admin">Administrador</option>
                </select>
                @error('user_type')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="bg-ale-pink hover:bg-pink-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Guardar Usuario
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
        <p class="text-gray-400 text-sm flex items-center gap-2">
            <i class="fas fa-info-circle text-ale-pink"></i>
            Los usuarios administradores tienen acceso total al panel de control.
        </p>
    </div>

</div>
@endsection