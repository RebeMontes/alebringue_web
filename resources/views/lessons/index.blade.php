@extends('layouts.admin')

@section('title', 'Gestión de Lecciones')

@section('header', 'Gestión de Lecciones')

@section('content')
<div class="space-y-6">
    
    <!-- Encabezado con acciones -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-ale-text-dim mb-1">
                <x-breadcrumbs :links="[
                ['name' => 'Inicio', 'url' => route('home')],
                ['name' => 'Lecciones']
                ]" />
            </div>
            <p class="text-ale-text-dim text-sm">Administra todas las lecciones del sistema educativo</p>
        </div>
        
        <div class="flex gap-3">
            <!-- Botón exportar -->
            <button id="btn-exportar" class="btn-outline flex items-center gap-2 text-sm">
                <i class="fas fa-download"></i>
                Exportar
            </button>
            
            <!-- Botón nueva lección -->
            <a href="{{ route('lessons.create') }}" class="btn-primary flex items-center gap-2 text-sm">
                <i class="fas fa-plus"></i>
                Nueva Lección
            </a>
        </div>
    </div>
    
    <!-- Tarjeta de estadísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Total Lecciones</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $lessons->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-ale-pink/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-book text-ale-pink"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Niveles</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $lessons->groupBy('level_id')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-layer-group text-blue-400"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Nuevas (este mes)</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $lessons->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-plus text-purple-400"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Barra de búsqueda y filtros -->
    <div class="card-admin p-4">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Búsqueda -->
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-ale-text-dim text-sm"></i>
                    <input type="text" id="search-input" placeholder="Buscar lección por título..." class="input-admin pl-10">
                </div>
            </div>
            
            <!-- Filtro por nivel -->
            <div>
                <select id="filter-level" class="input-admin w-full md:w-48">
                    <option value="all">Todos los niveles</option>
                    @foreach($levels ?? [] as $level)
                        <option value="{{ $level->name }}">{{ $level->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Botón limpiar filtros -->
            <button id="clear-filters" class="btn-outline text-sm px-4">
                <i class="fas fa-eraser"></i>
                Limpiar
            </button>
        </div>
    </div>
    
    <!-- Tabla de lecciones -->
    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-ale-border">
                <thead>
                    <tr class="bg-ale-surface-light">
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">ID</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Título</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Nivel</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Fecha de creación</th>
                        <th class="px-4 py-4 text-center text-xs font-semibold text-ale-pink uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ale-border">
                    @forelse($lessons as $lesson)
                    <tr class="lesson-row hover:bg-ale-surface/50 transition-colors" data-title="{{ strtolower($lesson->title) }}" data-level="{{ $lesson->level->name ?? '' }}" data-status="{{ $lesson->status ?? 'published' }}">
                        <td class="px-4 py-4 align-middle">
                            <span class="text-ale-text-dim text-sm">{{ $lesson->id }}</span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-ale-pink/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-book-open text-ale-pink"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-ale-text truncate">{{ $lesson->title }}</p>
                                    @if($lesson->description)
                                        <p class="text-xs text-ale-text-dim truncate">{{ Str::limit($lesson->description, 50) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400">
                                <i class="fas fa-layer-group text-xs"></i>
                                {{ $lesson->level->name ?? 'Sin nivel' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex flex-col">
                                <span class="text-ale-text text-sm">{{ $lesson->created_at ? $lesson->created_at->format('d/m/Y') : 'N/A' }}</span>
                                <span class="text-xs text-ale-text-dim">{{ $lesson->created_at ? $lesson->created_at->format('H:i') : '' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('lessons.show', $lesson->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('lessons.edit', $lesson->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $lesson->id }}, '{{ addslashes($lesson->title) }}')" class="text-ale-text-dim hover:text-red-500 transition p-1" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-16 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-16 h-16 bg-ale-surface rounded-full flex items-center justify-center">
                                    <i class="fas fa-book-open text-3xl text-ale-text-dim"></i>
                                </div>
                                <p class="text-ale-text-dim">No hay lecciones registradas</p>
                                <a href="{{ route('lessons.create') }}" class="btn-primary text-sm mt-2">Crear primera lección</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        @if(method_exists($lessons, 'links') && $lessons->hasPages())
        <div class="border-t border-ale-border p-4 bg-ale-surface/30">
            {{ $lessons->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal de confirmación de eliminación -->
<div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm hidden">
    <div class="bg-ale-surface border border-ale-border rounded-2xl p-6 max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="delete-modal-content">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-ale-text">Confirmar eliminación</h3>
        </div>
        <p class="text-ale-text-dim mb-6">
            ¿Estás seguro de que deseas eliminar la lección <strong id="delete-lesson-title" class="text-ale-pink"></strong>?
            Esta acción no se puede deshacer.
        </p>
        <div class="flex gap-3 justify-end">
            <button id="cancel-delete" class="btn-outline">Cancelar</button>
            <button id="confirm-delete" class="btn-primary bg-red-600 hover:bg-red-700">Eliminar</button>
        </div>
    </div>
</div>

<!-- Formulario oculto para eliminación -->
<form id="delete-form" method="POST" action="" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('styles')
<style>
    .stat-card {
        background: #19191c;
        border: 1px solid rgba(228, 0, 124, 0.2);
        border-radius: 1rem;
        transition: all 0.2s ease;
    }
    
    .stat-card:hover {
        border-color: #E4007C;
        transform: translateY(-2px);
    }
    
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
    
    .lesson-row {
        transition: background-color 0.2s ease;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .pagination .page-item .page-link {
        background: #1a1a1a;
        border: 1px solid rgba(228, 0, 124, 0.25);
        color: #FAF9F6;
        padding: 0.5rem 0.85rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }
    
    .pagination .page-item.active .page-link {
        background: #E4007C;
        border-color: #E4007C;
    }
    
    #delete-modal-content {
        transition: all 0.2s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentLessonId = null;
    let currentLessonTitle = null;
    
    function confirmDelete(lessonId, lessonTitle) {
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        const lessonTitleSpan = document.getElementById('delete-lesson-title');
        const deleteForm = document.getElementById('delete-form');
        
        currentLessonId = lessonId;
        currentLessonTitle = lessonTitle;
        lessonTitleSpan.textContent = lessonTitle;
        deleteForm.action = `/lessons/${lessonId}`;
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            if (modalContent) {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }
        }, 10);
    }
    
    function closeModal() {
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        
        if (modalContent) {
            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
        }
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            currentLessonId = null;
            currentLessonTitle = null;
        }, 200);
    }
    
    document.getElementById('cancel-delete')?.addEventListener('click', closeModal);
    
    document.getElementById('delete-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.getElementById('confirm-delete')?.addEventListener('click', function() {
        if (currentLessonId) {
            document.getElementById('delete-form').submit();
        }
    });
    
    // Búsqueda y filtros
    const searchInput = document.getElementById('search-input');
    const filterLevel = document.getElementById('filter-level');
    const clearFilters = document.getElementById('clear-filters');
    const rows = document.querySelectorAll('.lesson-row');
    
    function filterTable() {
        const searchTerm = searchInput?.value.toLowerCase() || '';
        const levelValue = filterLevel?.value.toLowerCase() || 'all';
        
        rows.forEach(row => {
            const title = row.dataset.title || '';
            const level = row.dataset.level || '';
            
            const matchesSearch = title.includes(searchTerm);
            const matchesLevel = levelValue === 'all' || level.toLowerCase().includes(levelValue);
            
            row.style.display = (matchesSearch && matchesLevel) ? '' : 'none';
        });
    }
    
    searchInput?.addEventListener('keyup', filterTable);
    filterLevel?.addEventListener('change', filterTable);
    clearFilters?.addEventListener('click', function() {
        if (searchInput) searchInput.value = '';
        if (filterLevel) filterLevel.value = 'all';
        filterTable();
    });
    
    // Exportar lecciones
    document.getElementById('btn-exportar')?.addEventListener('click', function() {
        const visibleRows = document.querySelectorAll('.lesson-row:not([style*="display: none"])');
        const data = [];
        
        visibleRows.forEach(row => {
            const title = row.querySelector('td:nth-child(2) .font-semibold')?.textContent || '';
            const level = row.querySelector('td:nth-child(3) span')?.textContent.trim() || '';
            
            data.push({ title, level });
        });
        
        const csv = data.map(row => `"${row.title}","${row.level}"`).join('\n');
        const blob = new Blob([`Título,Nivel\n${csv}`], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.download = 'lecciones_exportadas.csv';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    });
</script>
@endpush