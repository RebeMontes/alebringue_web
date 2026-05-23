
@extends('layouts.admin')

@section('title', 'Salón: ' . $classroom->name)
@section('header', 'Detalle del Salón')

@section('content')
<div class="max-w-3xl space-y-6">

    <nav class="flex items-center gap-2 text-sm text-gray-400">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio',  'url' => route('home')],
            ['name' => 'Salones', 'url' => route('classrooms.index')],
            ['name' => $classroom->name, 'url' => '#']
        ]" />
    </nav>

    <div class="bg-ale-surface border border-ale-border rounded-xl p-6">
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-5">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2">{{ $classroom->name }}</h2>
                <div class="flex items-center gap-2 flex-wrap">
                    <code class="bg-black/40 text-ale-pink px-3 py-1 rounded-lg text-sm font-mono">
                        {{ $classroom->code }}
                    </code>
                    @if ($classroom->level)
                        <span class="bg-ale-pink/20 text-ale-pink px-3 py-0.5 rounded-full text-xs font-bold uppercase">
                            {{ $classroom->level->name }}
                        </span>
                    @endif
                    @if ($classroom->is_active)
                        <span class="bg-green-500/15 text-green-400 px-3 py-0.5 rounded-full text-xs font-semibold">Activo</span>
                    @else
                        <span class="bg-gray-500/15 text-gray-400 px-3 py-0.5 rounded-full text-xs font-semibold">Inactivo</span>
                    @endif
                </div>
            </div>
            <a href="{{ route('classrooms.edit', $classroom) }}"
               class="flex-shrink-0 inline-flex items-center gap-2 bg-white/5 hover:bg-white/10 text-gray-300 font-semibold px-4 py-2 rounded-xl transition text-sm">
                <i class="fas fa-pencil"></i> Editar
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div class="bg-black/20 rounded-xl p-4">
                <p class="text-gray-500 mb-1">Profesor</p>
                <p class="text-white font-medium">{{ $classroom->teacher->name ?? '—' }}</p>
            </div>
            <div class="bg-black/20 rounded-xl p-4">
                <p class="text-gray-500 mb-1">Horario</p>
                <p class="text-white font-medium">{{ $classroom->schedule ?? '—' }}</p>
            </div>
            <div class="bg-black/20 rounded-xl p-4">
                <p class="text-gray-500 mb-1">Total alumnos</p>
                <p class="text-white font-bold text-xl">{{ $classroom->students->count() }}</p>
            </div>
            <div class="bg-black/20 rounded-xl p-4">
                <p class="text-gray-500 mb-1">Creado</p>
                <p class="text-white font-medium">{{ $classroom->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Lista alumnos --}}
    <div class="bg-ale-surface border border-ale-border rounded-xl overflow-hidden">
        <div class="px-5 py-4 border-b border-ale-border">
            <h3 class="font-bold text-white">Alumnos inscritos</h3>
        </div>
        @if ($classroom->students->isEmpty())
            <p class="text-center text-gray-500 py-10">No hay alumnos inscritos aún.</p>
        @else
            <ul class="divide-y divide-ale-border/50">
                @foreach ($classroom->students as $student)
                    <li class="px-5 py-3 flex items-center gap-3 hover:bg-white/5 transition">
                        <div class="w-8 h-8 bg-ale-pink/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-ale-pink text-xs"></i>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">{{ $student->name }}</p>
                            <p class="text-gray-500 text-xs">{{ $student->email }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection