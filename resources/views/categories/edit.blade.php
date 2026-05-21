@extends('layouts.admin')

@section('title', 'Editar Categoría')

@section('header', 'Editar Categoría')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Categorías', 'url' => route('categories.index')],
            ['name' => 'Editar Categoría']
        ]" />
    </nav>

    <!-- Tarjeta del formulario -->
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <h2 class="text-xl font-bungee text-white mb-6 flex items-center gap-2 tracking-wide">
            <i class="fas fa-edit text-[#00E5FF]"></i>
            EDITAR CATEGORÍA: {{ $category->name }}
        </h2>

        <form method="POST" action="{{ route('categories.update', $category->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Campo Nombre -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-tag mr-2 text-[#E0007C]"></i>
                    Nombre de la categoría
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $category->name) }}" 
                       placeholder="Ej: Animales, Colores, Verbos, Comida"
                       class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition">
                <p class="text-gray-500 text-xs mt-1">Nombre único para la categoría de vocabulario</p>
                @error('name')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo Descripción -->
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fas fa-align-left mr-2 text-[#E0007C]"></i>
                    Descripción (opcional)
                </label>
                <textarea name="description" 
                          rows="3" 
                          placeholder="Describe el tipo de palabras que contiene esta categoría..."
                          class="w-full p-3 rounded-lg bg-black/50 border border-ale-border text-white focus:border-[#00E5FF] focus:outline-none transition resize-none">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Información adicional -->
            <div class="bg-ale-surface/50 rounded-lg p-3 text-sm">
                <div class="flex items-center gap-2 text-gray-400">
                    <i class="fas fa-info-circle text-[#00E5FF]"></i>
                    <span>Creada: {{ $category->created_at ? $category->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                    <span class="mx-2">|</span>
                    <span>ID: {{ $category->id }}</span>
                    @if($category->words)
                        <span class="mx-2">|</span>
                        <span><i class="fas fa-language text-[#E0007C]"></i> {{ $category->words->count() }} palabras</span>
                    @endif
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex items-center gap-3 pt-4 border-t border-ale-border">
                <button type="submit" class="bg-[#00E5FF] hover:bg-[#c20068] text-black px-6 py-2.5 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide">
                    <i class="fas fa-save"></i>
                    ACTUALIZAR CATEGORÍA
                </button>
                <a href="{{ route('categories.index') }}" class="bg-transparent border border-ale-border hover:border-[#00E5FF] text-white px-6 py-2.5 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide hover:text-[#00E5FF]">
                    <i class="fas fa-times"></i>
                    CANCELAR
                </a>
            </div>
            
        </form>
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
    
    .input-admin {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(224, 0, 124, 0.35);
        border-radius: 0.5rem;
        padding: 0.6rem 0.75rem;
        color: #FAF9F6;
        width: 100%;
        outline: none;
        transition: all 0.2s ease;
    }
    
    .input-admin:focus {
        border-color: #00E5FF;
        box-shadow: 0 0 0 2px rgba(0, 229, 255, 0.25);
    }
</style>
@endpush