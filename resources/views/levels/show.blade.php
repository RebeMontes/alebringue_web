@extends('layouts.admin')

@section('title', 'Detalle de Nivel')

@section('header', 'Detalle de Nivel')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Niveles', 'url' => route('levels.index')],
            ['name' => $level->name]
        ]" />
    </nav>

    <!-- Tarjeta principal -->
    <div class="bg-ale-surface border border-ale-border rounded-xl overflow-hidden">
        
        <!-- Cabecera con icono -->
        <div class="bg-gradient-to-r from-ale-pink/15 to-transparent p-6 border-b border-ale-border">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-ale-pink to-pink-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-layer-group text-white text-2xl"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-ale-pink/20 text-ale-pink">
                            <i class="fas fa-hashtag text-xs"></i>
                            {{ $level->code }}
                        </span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $level->name }}</h1>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400">
                            <i class="fas fa-book text-xs"></i>
                            {{ $level->lessons->count() }} lecciones
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400">
                            <i class="fas fa-calendar-alt text-xs"></i>
                            Creado: {{ $level->created_at ? $level->created_at->format('d/m/Y') : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="p-6">
            
            <!-- Descripción -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                    <i class="fas fa-align-left text-ale-pink"></i>
                    Descripción
                </h3>
                <div class="bg-black/30 rounded-xl p-4 border border-ale-border">
                    <p class="text-gray-300 leading-relaxed">
                        {{ $level->description ?? 'No hay descripción disponible para este nivel.' }}
                    </p>
                </div>
            </div>

            <!-- Lecciones del nivel -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-book-open text-ale-pink"></i>
                        Lecciones de este nivel
                    </h3>
                    <a href="{{ route('lessons.create') }}?level_id={{ $level->id }}" class="text-ale-pink text-sm hover:underline flex items-center gap-1">
                        <i class="fas fa-plus-circle"></i>
                        Agregar lección
                    </a>
                </div>
                
                @if($level->lessons && $level->lessons->count() > 0)
                    <div class="space-y-2">
                        @foreach($level->lessons as $lesson)
                            <div class="bg-ale-surface-light border border-ale-border rounded-lg p-3 hover:border-ale-pink transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-ale-pink/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-book text-ale-pink text-sm"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('lessons.show', $lesson->id) }}" class="text-white font-medium hover:text-ale-pink transition">
                                                {{ $lesson->title }}
                                            </a>
                                            @if($lesson->description)
                                                <p class="text-ale-text-dim text-xs">{{ Str::limit($lesson->description, 60) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if(($lesson->status ?? 'published') == 'published')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs bg-green-500/20 text-green-400">
                                                <i class="fas fa-check-circle text-xs"></i>
                                                Publicada
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs bg-yellow-500/20 text-yellow-400">
                                                <i class="fas fa-pen text-xs"></i>
                                                Borrador
                                            </span>
                                        @endif
                                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-ale-surface-light rounded-xl border border-ale-border">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 bg-ale-pink/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-book-open text-ale-pink text-xl"></i>
                            </div>
                            <p class="text-ale-text-dim">Este nivel no tiene lecciones asignadas</p>
                            <a href="{{ route('lessons.create') }}?level_id={{ $level->id }}" class="btn-outline text-sm mt-2">
                                <i class="fas fa-plus"></i>
                                Crear primera lección
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Información adicional -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6 pt-4 border-t border-ale-border">
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-hashtag text-ale-pink w-5"></i>
                    <span class="text-gray-400">Código:</span>
                    <span class="text-white font-mono">{{ $level->code }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-id-card text-ale-pink w-5"></i>
                    <span class="text-gray-400">ID del nivel:</span>
                    <span class="text-white">{{ $level->id }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-edit text-ale-pink w-5"></i>
                    <span class="text-gray-400">Última actualización:</span>
                    <span class="text-white">{{ $level->updated_at ? $level->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>
            </div>

        </div>

        <!-- Botones de acción -->
        <div class="bg-ale-surface/50 p-6 border-t border-ale-border flex flex-wrap gap-3">
            <a href="{{ route('levels.index') }}" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver al listado
            </a>
            
            <a href="{{ route('levels.edit', $level->id) }}" class="bg-[#06b6d4] hover:bg-[#0891b2] text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-edit"></i>
                Editar Nivel
            </a>
            
            <button type="button" onclick="confirmDelete({{ $level->id }}, '{{ addslashes($level->name) }}')" class="ml-auto bg-red-600/20 border border-red-600/50 hover:bg-red-600 text-red-400 hover:text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-trash-alt"></i>
                Eliminar Nivel
            </button>
        </div>
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
            Esta acción no se puede deshacer y afectará a las <strong id="lessons-count" class="text-ale-pink"></strong> lecciones asociadas.
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
    let lessonsCount = {{ $level->lessons->count() }};
    
    function confirmDelete(levelId, levelName) {
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        const levelNameSpan = document.getElementById('delete-level-name');
        const lessonsCountSpan = document.getElementById('lessons-count');
        const deleteForm = document.getElementById('delete-form');
        
        currentLevelId = levelId;
        currentLevelName = levelName;
        levelNameSpan.textContent = levelName;
        lessonsCountSpan.textContent = lessonsCount;
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