@extends('layouts.admin')

@section('title', 'Gestión de Niveles')

@section('header', 'Gestión de Niveles')

@section('content')
<div class="space-y-6">
    
    <!-- Encabezado con acciones -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-ale-text-dim mb-1">
                <x-breadcrumbs :links="[
                ['name' => 'Inicio', 'url' => route('home')],
                ['name' => 'Niveles']
                ]" />               
            </div>
            <p class="text-ale-text-dim text-sm">Administra todos los niveles del sistema educativo</p>
        </div>
        
        <div class="flex gap-3">
            <!-- Botón nuevo nivel -->
            <a href="{{ route('levels.create') }}" class="btn-primary flex items-center gap-2 text-sm">
                <i class="fas fa-plus"></i>
                Crear Nivel
            </a>
        </div>
    </div>
    
    <!-- Tarjeta de estadísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Total Niveles</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $levels->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-ale-pink/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-layer-group text-ale-pink"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Lecciones Totales</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $levels->sum(function($level) { return $level->lessons->count(); }) }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-book text-blue-400"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Estudiantes Activos</p>
                    <p class="text-2xl font-bold text-ale-text">0</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-green-400"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Tasa de Finalización</p>
                    <p class="text-2xl font-bold text-ale-text">0%</p>
                </div>
                <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-purple-400"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Lista de niveles -->
    <div class="card-admin overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <i class="fas fa-list text-ale-pink"></i>
                Todos los Niveles
            </h3>
            
            <div class="space-y-3">
                @forelse($levels as $level)
                <div class="level-item bg-ale-surface-light border border-ale-border rounded-xl p-4 hover:border-ale-pink transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-ale-pink to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-layer-group text-white text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-white">{{ $level->name }}</h2>
                                <p class="text-ale-text-dim text-sm">{{ $level->description ?? 'Sin descripción' }}</p>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-xs text-ale-text-dim">
                                        <i class="fas fa-book mr-1"></i> {{ $level->lessons->count() }} lecciones
                                    </span>
                                    <span class="text-xs text-ale-text-dim">
                                        <i class="fas fa-clock mr-1"></i> Creado: {{ $level->created_at ? $level->created_at->format('d/m/Y') : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <a href="{{ route('levels.show', $level->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-2" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('levels.edit', $level->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-2" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" onclick="confirmDelete({{ $level->id }}, '{{ addslashes($level->name) }}')" class="text-ale-text-dim hover:text-red-500 transition p-2" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="flex flex-col items-center gap-4">
                        <div class="w-16 h-16 bg-ale-surface rounded-full flex items-center justify-center">
                            <i class="fas fa-layer-group text-3xl text-ale-text-dim"></i>
                        </div>
                        <p class="text-ale-text-dim">No hay niveles registrados</p>
                        <a href="{{ route('levels.create') }}" class="btn-primary text-sm mt-2">Crear primer nivel</a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Paginación -->
        @if(method_exists($levels, 'links') && $levels->hasPages())
        <div class="border-t border-ale-border p-4 bg-ale-surface/30">
            {{ $levels->links() }}
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
            ¿Estás seguro de que deseas eliminar el nivel <strong id="delete-level-name" class="text-ale-pink"></strong>?
            Esta acción no se puede deshacer y afectará a las lecciones asociadas.
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
    
    .level-item {
        transition: all 0.2s ease;
    }
    
    .level-item:hover {
        border-color: #E4007C;
        transform: translateX(4px);
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid rgba(228, 0, 124, 0.5);
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        color: #FAF9F6;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-outline:hover {
        background: rgba(228, 0, 124, 0.15);
        border-color: #E4007C;
    }
    
    .btn-primary {
        background: #E4007C;
        border: none;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        color: #FAF9F6;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-primary:hover {
        background: #c2006b;
    }
    
    #delete-modal-content {
        transition: all 0.2s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentLevelId = null;
    let currentLevelName = null;
    
    function confirmDelete(levelId, levelName) {
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        const levelNameSpan = document.getElementById('delete-level-name');
        const deleteForm = document.getElementById('delete-form');
        
        currentLevelId = levelId;
        currentLevelName = levelName;
        levelNameSpan.textContent = levelName;
        deleteForm.action = `/levels/${levelId}`;
        
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
            currentLevelId = null;
            currentLevelName = null;
        }, 200);
    }
    
    document.getElementById('cancel-delete')?.addEventListener('click', closeModal);
    
    document.getElementById('delete-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.getElementById('confirm-delete')?.addEventListener('click', function() {
        if (currentLevelId) {
            document.getElementById('delete-form').submit();
        }
    });
</script>
@endpush