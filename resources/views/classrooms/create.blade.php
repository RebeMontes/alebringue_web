@extends('layouts.admin')
 
@section('title', 'Crear Salón')
@section('header', 'Nuevo Salón')
 
@push('styles')
<style>
    .input-ale {
        width: 100%;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.89);
        border-radius: 1.2rem;
        padding: 0.85rem 1.2rem;
        font-family: 'Bricolage Grotesque', monospace;
        font-size: 1rem;
        font-weight: 500;
        color: #FAF9F6;
        transition: all 0.25s ease;
        outline: none;
    }

    .input-ale:focus {
        border-color: #E4007C;
        box-shadow: 0 0 0 3px rgba(228, 0, 124, 0.25);
        background: rgba(255, 255, 255, 0.1);
    }

    .input-ale::placeholder {
        color: rgba(250, 249, 246, 0.4);
        font-weight: 400;
        font-size: 0.9rem;
    }

    select.input-ale option {
        background-color: #19191c;
        color: #FAF9F6;
    }

    .input-ale.border-red-500 {
        border-color: #ef4444 !important;
    }
</style>
@endpush
 
@section('content')
<div class="max-w-2xl space-y-6">
 
    <nav class="flex items-center gap-2 text-sm text-gray-400">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio',  'url' => route('home')],
            ['name' => 'Salones', 'url' => route('classrooms.index')],
            ['name' => 'Crear',   'url' => '#']
        ]" />
    </nav>
 
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6 space-y-5">
        <h2 class="text-xl font-bold text-white">Crear nuevo salón</h2>
 
        <form method="POST" action="{{ route('classrooms.store') }}" class="space-y-4">
            @csrf
 
            <div>
                <label class="block text-sm font-medium text-ale-pink mb-1">
                    Nombre de la clase <span class="text-ale-pink">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="input-ale @error('name') border-red-500 @enderror"
                    placeholder="Ej: Vocabulary 101">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
 
            <div>
                <label class="block text-sm font-medium text-ale-pink mb-1">
                    Profesor <span class="text-ale-pink">*</span>
                </label>
                <select name="teacher_id"
                    class="input-ale @error('teacher_id') border-red-500 @enderror">
                    <option value="">— Selecciona un profesor —</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @selected(old('teacher_id') == $teacher->id)>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
 
            <div>
                <label class="block text-sm font-medium text-ale-pink mb-1">
                    Nivel de inglés
                </label>
                <select name="level_id" class="input-ale">
                    <option value="">— Sin nivel —</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}" @selected(old('level_id') == $level->id)>
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
            </div>
 
            <div>
                <label class="block text-sm font-medium text-ale-pink mb-1">
                    Horario
                </label>
                <input type="text" name="schedule" value="{{ old('schedule') }}"
                    class="input-ale"
                    placeholder="Ej: Sábado · 8:00 AM">
                <p class="text-gray-500 text-xs mt-1">Texto libre que verá el alumno en su tarjeta.</p>
            </div>
 
            <div class="bg-ale-pink/10 border border-ale-pink/30 rounded-xl px-4 py-3 text-sm text-ale-text-dim flex items-start gap-2">
                <i class="fas fa-info-circle text-ale-pink mt-0.5"></i>
                <span>El código de acceso se genera automáticamente al crear el salón.</span>
            </div>
 
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-ale-pink hover:bg-pink-700 text-white font-semibold px-6 py-2.5 rounded-xl transition">
                    Crear Salón
                </button>
                <a href="{{ route('classrooms.index') }}"
                   class="bg-white/5 hover:bg-white/10 text-gray-300 font-semibold px-6 py-2.5 rounded-xl transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
 
</div>
@endsection