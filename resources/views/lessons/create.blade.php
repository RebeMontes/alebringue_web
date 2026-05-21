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
        <h2 class="text-xl font-bungee text-white mb-6 flex items-center gap-2 tracking-wide">
            <i class="fas fa-plus-circle text-[#00E5FF]"></i>
            CREAR NUEVA LECCIÓN
        </h2>

        <form method="POST" action="{{ route('lessons.store') }}" class="space-y-6">
            @csrf

            <!-- Campo Título -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-heading mr-2 text-[#E0007C]"></i>
                    Título de la lección
                </label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}" 
                       placeholder="Ej: Introducción a la pronunciación"
                       class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition">
                @error('title')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Descripción -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-align-left mr-2 text-[#E0007C]"></i>
                    Descripción
                </label>
                <textarea name="description" 
                          rows="4" 
                          placeholder="Describe el contenido de la lección..."
                          class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Selector de Nivel -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-layer-group mr-2 text-[#E0007C]"></i>
                    Nivel
                </label>
                <select name="level_id" 
                        class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition">
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

            <!-- Separador -->
            <div class="border-t border-ale-border pt-4">
                <h3 class="text-lg font-bungee text-white mb-4 flex items-center gap-2 tracking-wide">
                    <i class="fas fa-language text-[#00E5FF]"></i>
                    PALABRAS DE VOCABULARIO
                </h3>
                <p class="text-ale-text-dim text-sm mb-4">Selecciona las palabras que se incluirán en esta lección</p>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($words as $word)
                    <label class="flex items-center gap-3 p-2 rounded-lg bg-black/30 border border-ale-border hover:border-[#00E5FF] transition cursor-pointer">
                        <input type="checkbox" 
                               name="words[]" 
                               value="{{ $word->id }}"
                               {{ in_array($word->id, old('words', [])) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-ale-border bg-transparent accent-[#E0007C]">
                        <span class="text-ale-text text-sm">{{ $word->word }}</span>
                    </label>
                    @endforeach
                </div>
                
                @if($words->isEmpty())
                    <div class="text-center py-6 text-ale-text-dim">
                        <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                        <p>No hay palabras registradas. Crea algunas palabras primero.</p>
                        <a href="{{ route('words.create') }}" class="inline-block mt-3 text-[#00E5FF] font-bungee hover:underline">+ CREAR PALABRA</a>
                    </div>
                @endif
                
                @error('words')
                    <p class="text-red-400 text-xs mt-3">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="flex items-center gap-3 pt-4 border-t border-ale-border">
                <button type="submit" class="bg-[#00E5FF] hover:bg-[#c20068] text-black px-6 py-2.5 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide">
                    <i class="fas fa-save"></i>
                    GUARDAR LECCIÓN
                </button>
                <a href="{{ route('lessons.index') }}" class="bg-transparent border border-ale-border hover:border-[#00E5FF] text-white px-6 py-2.5 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide hover:text-[#00E5FF]">
                    <i class="fas fa-times"></i>
                    CANCELAR
                </a>
            </div>
            
        </form>
    </div>

    <!-- Información adicional -->
    <div class="mt-4 p-4 bg-ale-surface/50 border border-ale-border rounded-lg">
        <div class="flex items-center gap-3 text-sm">
            <i class="fas fa-info-circle text-[#00E5FF]"></i>
            <p class="text-gray-400">Las lecciones públicas serán visibles para todos los estudiantes. Puedes guardar como borrador y publicar más tarde.</p>
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
    
    input[type="checkbox"] {
        accent-color: #E0007C;
        width: 1rem;
        height: 1rem;
        cursor: pointer;
    }
    
    label:hover {
        background-color: rgba(224, 0, 124, 0.05);
        border-color: #00E5FF;
    }
</style>
@endpush