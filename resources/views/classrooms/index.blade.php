
@extends('layouts.admin')

@section('title', 'Salones - Admin')
@section('header', 'Gestión de Salones')

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-400">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Salones', 'url' => route('classrooms.index')]
        ]" />
    </nav>

    {{-- Encabezado --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h2 class="text-2xl font-bold text-white">Salones</h2>
            <p class="text-gray-400 text-sm">Administra los salones de clase</p>
        </div>
        <a href="{{ route('classrooms.create') }}"
           class="inline-flex items-center gap-2 bg-ale-pink hover:bg-pink-700 text-white font-semibold px-4 py-2.5 rounded-xl transition">
            <i class="fas fa-plus"></i> Nuevo Salón
        </a>
    </div>

    {{-- Flash --}}
    @if (session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="bg-ale-surface border border-ale-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-ale-border bg-black/20">
                    <tr>
                        <th class="text-left px-5 py-3 text-gray-400 font-semibold">Nombre</th>
                        <th class="text-left px-5 py-3 text-gray-400 font-semibold">Código</th>
                        <th class="text-left px-5 py-3 text-gray-400 font-semibold">Profesor</th>
                        <th class="text-left px-5 py-3 text-gray-400 font-semibold">Nivel</th>
                        <th class="text-left px-5 py-3 text-gray-400 font-semibold">Alumnos</th>
                        <th class="text-left px-5 py-3 text-gray-400 font-semibold">Estado</th>
                        <th class="text-right px-5 py-3 text-gray-400 font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ale-border/50">
                    @forelse ($classrooms as $classroom)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-5 py-4 font-medium text-white">{{ $classroom->name }}</td>
                            <td class="px-5 py-4">
                                <code class="bg-black/40 text-ale-pink px-2 py-0.5 rounded text-xs font-mono">
                                    {{ $classroom->code }}
                                </code>
                            </td>
                            <td class="px-5 py-4 text-gray-300">{{ $classroom->teacher->name ?? '—' }}</td>
                            <td class="px-5 py-4 text-gray-300">{{ $classroom->level->name ?? '—' }}</td>
                            <td class="px-5 py-4 text-gray-300">{{ $classroom->students->count() }}</td>
                            <td class="px-5 py-4">
                                @if ($classroom->is_active)
                                    <span class="bg-green-500/15 text-green-400 text-xs px-2 py-0.5 rounded-full font-semibold">Activo</span>
                                @else
                                    <span class="bg-gray-500/15 text-gray-400 text-xs px-2 py-0.5 rounded-full font-semibold">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('classrooms.show', $classroom) }}"
                                       class="text-gray-400 hover:text-ale-pink transition" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('classrooms.edit', $classroom) }}"
                                       class="text-gray-400 hover:text-blue-400 transition" title="Editar">
                                        <i class="fas fa-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('classrooms.destroy', $classroom) }}"
                                          onsubmit="return confirm('¿Eliminar este salón?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-400 transition" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-gray-500">
                                <i class="fas fa-chalkboard text-3xl mb-2 block"></i>
                                No hay salones registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection