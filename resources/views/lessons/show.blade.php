@extends('layouts.admin')

@section('title', 'Detalle de Lección')

@section('header', 'Detalle de Lección')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Lecciones', 'url' => route('lessons.index')],
            ['name' => $lesson->title ?? 'Detalle de Lección']
            ]" />
    </nav>

    <!-- Tarjeta principal -->
    <div class="bg-ale-surface border border-ale-border rounded-xl overflow-hidden">
        
        <!-- Cabecera con icono -->
        <div class="bg-gradient-to-r from-ale-pink/15 to-transparent p-6 border-b border-ale-border">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-ale-pink to-pink-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-book-open text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $lesson->title }}</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400">
                            <i class="fas fa-layer-group text-xs"></i>
                            Nivel: {{ $lesson->level->name ?? 'Sin nivel' }}
                        </span>
                        <!-- @if(($lesson->status ?? 'published') == 'published')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400">
                                <i class="fas fa-check-circle text-xs"></i>
                                Publicada
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-400">
                                <i class="fas fa-pen text-xs"></i>
                                Borrador
                            </span>
                        @endif -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="p-6">
            
            <!-- Descripción -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                    <i class="fas fa-align-left text-ale-pink"></i>
                    Descripción
                </h3>
                <div class="bg-black/30 rounded-xl p-4 border border-ale-border">
                    <p class="text-gray-300 leading-relaxed">
                        {{ $lesson->description ?? 'No hay descripción disponible para esta lección.' }}
                    </p>
                </div>
            </div>

            <!-- Palabras de vocabulario -->
            @if($lesson->words && $lesson->words->count() > 0)
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                    <i class="fas fa-language text-ale-pink"></i>
                    Palabras de vocabulario
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                    @foreach($lesson->words as $word)
                        <div class="bg-ale-surface-light rounded-lg p-3 border border-ale-border hover:border-ale-pink transition">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-microphone-alt text-ale-pink text-sm"></i>
                                <span class="text-ale-text font-medium">{{ $word->word }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Información adicional -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6 pt-4 border-t border-ale-border">
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-calendar-alt text-ale-pink w-5"></i>
                    <span class="text-gray-400">Creada:</span>
                    <span class="text-white">{{ $lesson->created_at ? $lesson->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-edit text-ale-pink w-5"></i>
                    <span class="text-gray-400">Última actualización:</span>
                    <span class="text-white">{{ $lesson->updated_at ? $lesson->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-id-card text-ale-pink w-5"></i>
                    <span class="text-gray-400">ID de lección:</span>
                    <span class="text-white">{{ $lesson->id }}</span>
                </div>
                <!-- <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-chart-line text-ale-pink w-5"></i>
                    <span class="text-gray-400">Progreso promedio:</span>
                    <span class="text-white">0%</span>
                </div> -->
            </div>

        </div>

        <!-- Botones de acción -->
        <div class="bg-ale-surface/50 p-6 border-t border-ale-border flex flex-wrap gap-3">
            <a href="{{ route('lessons.index') }}" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver al listado
            </a>
            
            <a href="{{ route('lessons.edit', $lesson->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-edit"></i>
                Editar Lección
            </a>
            
            @if(($lesson->status ?? 'published') == 'published')
            <button type="button" onclick="confirmDelete({{ $lesson->id }}, '{{ addslashes($lesson->title) }}')" class="ml-auto bg-red-600/20 border border-red-600/50 hover:bg-red-600 text-red-400 hover:text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-trash-alt"></i>
                Eliminar Lección
            </button>
            @endif
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
            ¿Estás seguro de que deseas eliminar la lección <strong id="delete-lesson-title" class="text-ale-pink"></strong>?
            Esta acción no se puede deshacer y se eliminarán todos los datos asociados.
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
</script>
@endpush