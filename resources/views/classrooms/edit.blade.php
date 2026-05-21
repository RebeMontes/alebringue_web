@extends('layouts.admin')
 
@section('title', 'Editar Salón')
@section('header', 'Editar Salón')
 
@push('styles')
<style>
    .input-ale,
    .input-ale:focus {
        color: #FAF9F6 !important;
        width: 100%;
    }
    .input-ale::placeholder {
        color: rgba(250, 249, 246, 0.35);
    }
    select.input-ale option {
        background-color: #19191c;
        color: #FAF9F6;
    }
</style>
@endpush
 
@section('content')
<div class="max-w-2xl space-y-6">
 
    <nav class="flex items-center gap-2 text-sm text-gray-400">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio',  'url' => route('home')],
            ['name' => 'Salones', 'url' => route('classrooms.index')],
            ['name' => 'Editar',  'url' => '#']
        ]" />
    </nav>
 
    <div class="bg-ale-surface border border-ale-border rounded-xl p-6 space-y-5">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-white">Editar salón</h2>
            <code class="bg-black/40 text-ale-pink px-3 py-1 rounded-lg text-sm font-mono">
                {{ $classroom->code }}
            </code>
        </div>
 
        <form method="POST" action="{{ route('classrooms.update', $classroom) }}" class="space-y-4">
            @csrf @method('PUT')
 
            <div>
                <label class="block text-sm font-medium text-ale-pink mb-1">
                    Nombre <span class="text-ale-pink">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $classroom->name) }}"
                    class="input-ale @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
 
            <div>
                <label class="block text-sm font-medium text-ale-pink mb-1">
                    Profesor <span class="text-ale-pink">*</span>
                </label>
                <select name="teacher_id" class="input-ale @error('teacher_id') border-red-500 @enderror">
                    <option value="">— Selecciona —</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}"
                            @selected(old('teacher_id', $classroom->teacher_id) == $teacher->id)>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
 
            <div>
                <label class="block text-sm font-medium text-ale-pink mb-1">Nivel de inglés</label>
                <select name="level_id" class="input-ale">
                    <option value="">— Sin nivel —</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}"
                            @selected(old('level_id', $classroom->level_id) == $level->id)>
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
            </div>
 
            <div>
                <label class="block text-sm font-medium text-ale-pink mb-1">Horario</label>
                <input type="text" name="schedule" value="{{ old('schedule', $classroom->schedule) }}"
                    class="input-ale" placeholder="Ej: Mar, Jue · 6:00 PM">
                <p class="text-gray-500 text-xs mt-1">Texto libre que verá el alumno en su tarjeta.</p>
            </div>
 
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    class="w-4 h-4 accent-pink-600"
                    @checked(old('is_active', $classroom->is_active))>
                <label for="is_active" class="text-sm text-gray-300">Salón activo</label>
            </div>
 
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-ale-pink hover:bg-pink-700 text-white font-semibold px-6 py-2.5 rounded-xl transition">
                    Guardar cambios
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