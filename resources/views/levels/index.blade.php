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
            <a href="{{ route('levels.create') }}" class="btn-primary flex items-center gap-2 text-sm font-bungee tracking-wide">
                <i class="fas fa-plus"></i>
                CREAR NIVEL
            </a>
        </div>
    </div>
    
    <!-- Tarjeta de estadísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Total Niveles</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $levels->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-[#E0007C]/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-layer-group text-[#E0007C] text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Lecciones Totales</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $levels->sum(function($level) { return $level->lessons->count(); }) }}</p>
                </div>
                <div class="w-10 h-10 bg-[#00E5FF]/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-book text-[#00E5FF] text-xl"></i>
                </div>
            </div>
        </div> 
    </div>
    
    <!-- Tabla de niveles -->
    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-ale-border">
                <thead>
                    <tr class="bg-ale-surface-light">
                        <th class="px-4 py-4 text-left text-xs font-bungee text-[#E0007C] uppercase tracking-wider">CÓDIGO</th>
                        <th class="px-4 py-4 text-left text-xs font-bungee text-[#E0007C] uppercase tracking-wider">NOMBRE</th>
                        <th class="px-4 py-4 text-left text-xs font-bungee text-[#E0007C] uppercase tracking-wider">DESCRIPCIÓN</th>
                        <th class="px-4 py-4 text-center text-xs font-bungee text-[#E0007C] uppercase tracking-wider">LECCIONES</th>
                        <th class="px-4 py-4 text-center text-xs font-bungee text-[#E0007C] uppercase tracking-wider">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ale-border">
                    @forelse($levels as $level)
                    <tr class="hover:bg-ale-surface/50 transition-colors">
                        <td class="px-4 py-4 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-[#E0007C]/20 text-[#E0007C]">
                                <i class="fas fa-hashtag text-xs"></i>
                                {{ $level->code }}
                            </span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#E0007C] to-[#c20068] rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-layer-group text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-ale-text">{{ $level->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <p class="text-ale-text-dim text-sm">{{ Str::limit($level->description ?? 'Sin descripción', 60) }}</p>
                        </td>
                        <td class="px-4 py-4 align-middle text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-[#00E5FF]/20 text-[#00E5FF]">
                                <i class="fas fa-book text-xs"></i>
                                {{ $level->lessons->count() }} lecciones
                            </span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('levels.show', $level->id) }}" class="text-ale-text-dim hover:text-[#00E5FF] transition p-1" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('levels.edit', $level->id) }}" class="text-ale-text-dim hover:text-[#00E5FF] transition p-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $level->id }}, '{{ addslashes($level->name) }}')" class="text-ale-text-dim hover:text-red-500 transition p-1" title="Eliminar">
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
                                    <i class="fas fa-layer-group text-3xl text-ale-text-dim"></i>
                                </div>
                                <p class="text-ale-text-dim">No hay niveles registrados</p>
                                <a href="{{ route('levels.create') }}" class="btn-primary text-sm mt-2 font-bungee">CREAR PRIMER NIVEL</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
            <h3 class="text-xl font-bungee text-ale-text">CONFIRMAR ELIMINACIÓN</h3>
        </div>
        <p class="text-ale-text-dim mb-6">
            ¿Estás seguro de que deseas eliminar el nivel <strong id="delete-level-name" class="text-[#E0007C]"></strong>?
            Esta acción no se puede deshacer y afectará a las lecciones asociadas.
        </p>
        <div class="flex gap-3 justify-end">
            <button id="cancel-delete" class="btn-outline font-bungee">CANCELAR</button>
            <button id="confirm-delete" class="btn-primary bg-red-600 hover:bg-red-700 font-bungee">ELIMINAR</button>
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
    @import url('https://fonts.googleapis.com/css2?family=Bungee&display=swap');
    
    .font-bungee {
        font-family: 'Bungee', cursive;
        letter-spacing: 0.02em;
    }
    
    .stat-card {
        background: #19191c;
        border: 1px solid rgba(224, 0, 124, 0.2);
        border-radius: 1rem;
        transition: all 0.2s ease;
    }
    
    .stat-card:hover {
        border-color: #E0007C;
        transform: translateY(-2px);
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid rgba(224, 0, 124, 0.5);
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        color: #FAF9F6;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-outline:hover {
        background: rgba(224, 0, 124, 0.15);
        border-color: #E0007C;
    }
    
    .btn-primary {
        background: #E0007C;
        border: none;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        color: #FAF9F6;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-primary:hover {
        background: #c20068;
    }
    
    #delete-modal-content {
        transition: all 0.2s ease-out;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .pagination .page-item .page-link {
        background: #1a1a1a;
        border: 1px solid rgba(224, 0, 124, 0.25);
        color: #FAF9F6;
        padding: 0.5rem 0.85rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }
    
    .pagination .page-item.active .page-link {
        background: #E0007C;
        border-color: #E0007C;
    }
    
    .pagination .page-item:not(.disabled):not(.active) .page-link:hover {
        border-color: #00E5FF;
        background: rgba(0, 229, 255, 0.1);
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