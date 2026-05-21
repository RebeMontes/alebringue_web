
@extends('layouts.user')

@section('title', $classroom->name . ' - Aula')

@section('content')
<div class="max-w-2xl mx-auto py-8 space-y-6">

    {{-- Header aula --}}
    <div class="bg-gradient-to-r from-ale-pink/15 to-transparent border border-ale-border rounded-2xl p-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-ale-text-dim text-sm mb-1">Estás en el aula de</p>
                <h1 class="text-2xl font-black text-ale-text">{{ $classroom->name }}</h1>
                <div class="flex items-center gap-3 mt-2 text-sm text-ale-text-dim">
                    <span>
                        <i class="fas fa-user-circle mr-1"></i>
                        {{ $classroom->teacher->name ?? 'Profesor' }}
                    </span>
                    @if ($classroom->schedule)
                        <span>
                            <i class="fas fa-clock mr-1"></i>
                            {{ $classroom->schedule }}
                        </span>
                    @endif
                </div>
            </div>
            @if ($classroom->level)
                <span class="bg-ale-pink/20 text-ale-pink px-3 py-1 rounded-full text-xs font-bold uppercase flex-shrink-0">
                    {{ $classroom->level->name }}
                </span>
            @endif
        </div>
    </div>

    {{-- Contenido del aula --}}
    <div class="bg-[#1c1c20] border border-white/5 rounded-2xl p-10 text-center">
        <div class="w-16 h-16 bg-ale-pink/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-chalkboard-teacher text-ale-pink text-2xl"></i>
        </div>
        <h2 class="text-ale-text font-bold mb-2">Aula en construcción</h2>
        <p class="text-ale-text-dim text-sm max-w-xs mx-auto">
            Aquí irá el contenido de la clase: videollamada, actividades, chat, etc.
        </p>
    </div>

    <div class="text-center">
        <a href="{{ route('classrooms.user') }}"
           class="inline-flex items-center gap-2 text-ale-text-dim hover:text-ale-pink transition text-sm">
            <i class="fas fa-arrow-left"></i> Volver a mis clases
        </a>
    </div>

</div>
@endsection