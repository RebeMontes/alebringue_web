@extends('layouts.admin')

@section('title', 'Crear Nivel')

@section('header', 'Crear Nuevo Nivel')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Niveles', 'url' => route('levels.index')],
            ['name' => 'Crear Nivel']
            ]" />
    </nav>

    <!-- Tarjeta del formulario -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-plus-circle text-ale-pink"></i>
            Crear Nuevo Nivel
        </h2>

        <form method="POST" action="{{ route('levels.store') }}" class="space-y-5">
            @csrf

            <!-- Campo Código -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-hashtag mr-2 text-ale-pink"></i>
                    Código del nivel
                </label>
                <input type="text" 
                       name="code" 
                       value="{{ old('code') }}" 
                       placeholder="Ej: A1, B2, C1, Basico, Intermedio"
                       class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                <p class="text-gray-500 text-xs mt-1">Código único para identificar el nivel (ej: A1, B2, BEG, INT, ADV)</p>
                @error('code')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Nombre -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-tag mr-2 text-ale-pink"></i>
                    Nombre del nivel
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       placeholder="Ej: Basico, Intermedio, Avanzado"
                       class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                @error('name')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Descripción -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-align-left mr-2 text-ale-pink"></i>
                    Descripción
                </label>
                <textarea name="description" 
                          rows="4" 
                          placeholder="Describe el nivel y los conocimientos que se adquieren..."
                          class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="flex items-center gap-3 pt-4 border-t border-ale-border">
                <button type="submit" class="bg-ale-pink hover:bg-pink-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Guardar Nivel
                </button>
                <a href="{{ route('levels.index') }}" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
            </div>
            
        </form>
    </div>

    <!-- Información adicional -->
    <div class="mt-4 p-4 bg-ale-surface/50 border border-ale-border rounded-lg">
        <div class="flex items-center gap-3 text-sm">
            <i class="fas fa-info-circle text-ale-pink"></i>
            <p class="text-gray-400">Los niveles ayudan a organizar las lecciones por dificultad y progresión del aprendizaje.</p>
        </div>
    </div>

</div>
@endsection