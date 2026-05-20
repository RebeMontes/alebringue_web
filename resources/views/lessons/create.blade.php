@extends('layouts.admin')

@section('title', 'Crear Lección')

@section('header', 'Crear Nueva Lección')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Lecciones', 'url' => route('lessons.index')],
            ['name' => 'Crear Lección']
            ]" />
    </nav>

    <!-- Tarjeta del formulario -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-plus-circle text-ale-pink"></i>
            Crear Nueva Lección
        </h2>

        <form method="POST" action="{{ route('lessons.store') }}" class="space-y-6">
            @csrf

            <!-- Campo Título -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-heading mr-2 text-ale-pink"></i>
                    Título de la lección
                </label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}" 
                       placeholder="Ej: Introducción a la pronunciación"
                       class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                @error('title')
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
                          placeholder="Describe el contenido de la lección..."
                          class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Selector de Nivel -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-layer-group mr-2 text-ale-pink"></i>
                    Nivel
                </label>
                <select name="level_id" 
                        class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                    <option value="">Seleccione un nivel</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
                @error('level_id')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Estado de la lección -->
            <!-- <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-toggle-on mr-2 text-ale-pink"></i>
                    Estado
                </label>
                <select name="status" 
                        class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-ale-pink focus:outline-none transition">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Borrador</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publicada</option>
                </select>
                @error('status')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> -->

            <!-- Separador -->
            <div class="border-t border-ale-border pt-4">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-language text-ale-pink"></i>
                    Palabras de vocabulario
                </h3>
                <p class="text-ale-text-dim text-sm mb-4">Selecciona las palabras que se incluirán en esta lección</p>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($words as $word)
                    <label class="flex items-center gap-3 p-2 rounded-lg bg-black/30 border border-ale-border hover:border-ale-pink transition cursor-pointer">
                        <input type="checkbox" 
                               name="words[]" 
                               value="{{ $word->id }}"
                               {{ in_array($word->id, old('words', [])) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-ale-border bg-transparent accent-ale-pink">
                        <span class="text-ale-text text-sm">{{ $word->word }}</span>
                    </label>
                    @endforeach
                </div>
                
                @if($words->isEmpty())
                    <div class="text-center py-6 text-ale-text-dim">
                        <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                        <p>No hay palabras registradas. Crea algunas palabras primero.</p>
                        <a href="{{ route('words.create') }}" class="inline-block mt-3 text-ale-pink hover:underline">+ Crear palabra</a>
                    </div>
                @endif
                
                @error('words')
                    <p class="text-red-400 text-xs mt-3">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="flex items-center gap-3 pt-4 border-t border-ale-border">
                <button type="submit" class="bg-ale-pink hover:bg-pink-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Guardar Lección
                </button>
                <a href="{{ route('lessons.index') }}" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
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
            <p class="text-gray-400">Las lecciones públicas serán visibles para todos los estudiantes. Puedes guardar como borrador y publicar más tarde.</p>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    input[type="checkbox"] {
        accent-color: #E4007C;
        width: 1rem;
        height: 1rem;
        cursor: pointer;
    }
    
    label:hover {
        background-color: rgba(228, 0, 124, 0.05);
        border-color: #E4007C;
    }
</style>
@endpush