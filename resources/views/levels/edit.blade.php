@extends('layouts.admin')

@section('title', 'Editar Nivel')

@section('header', 'Editar Nivel')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Niveles', 'url' => route('levels.index')],
            ['name' => 'Editar Nivel']
            ]" />
    </nav>

    <!-- Tarjeta del formulario -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-edit text-ale-pink"></i>
            Editar Nivel: {{ $level->name }}
        </h2>

        <form method="POST" action="{{ route('levels.update', $level->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Campo Código -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-hashtag mr-2 text-ale-pink"></i>
                    Código del nivel
                </label>
                <input type="text" 
                       name="code" 
                       value="{{ old('code', $level->code) }}" 
                       placeholder="Ej: LVL-001, BEG, INT, ADV"
                       class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                <p class="text-gray-500 text-xs mt-1">Código único para identificar el nivel</p>
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
                       value="{{ old('name', $level->name) }}" 
                       placeholder="Ej: Principiante, Intermedio, Avanzado"
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
                          class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition resize-none">{{ old('description', $level->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Información adicional -->
            <div class="bg-ale-surface/50 rounded-lg p-3 text-sm">
                <div class="flex items-center gap-2 text-gray-400">
                    <i class="fas fa-info-circle text-ale-pink"></i>
                    <span>Creado: {{ $level->created_at ? $level->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                    <span class="mx-2">|</span>
                    <span>ID: {{ $level->id }}</span>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex items-center gap-3 pt-4 border-t border-ale-border">
                <button type="submit" class="bg-ale-pink hover:bg-pink-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Actualizar Nivel
                </button>
                <a href="{{ route('levels.index') }}" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
            </div>
            
        </form>
    </div>

</div>
@endsection

@push('styles')
<style>
    .input-admin {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(228, 0, 124, 0.35);
        border-radius: 0.5rem;
        padding: 0.6rem 0.75rem;
        color: #FAF9F6;
        width: 100%;
        outline: none;
        transition: all 0.2s ease;
    }
    
    .input-admin:focus {
        border-color: #E4007C;
        box-shadow: 0 0 0 2px rgba(228, 0, 124, 0.25);
    }
</style>
@endpush