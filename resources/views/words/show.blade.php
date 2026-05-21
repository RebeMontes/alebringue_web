@extends('layouts.admin')

@section('title', 'Detalle de Palabra')

@section('header', 'Detalle de Palabra')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Palabras', 'url' => route('words.index')],
            ['name' => 'Detalle: ' . $word->word]
        ]" />
    </nav>

    <!-- Tarjeta principal -->
    <div class="bg-ale-surface border border-ale-border rounded-xl overflow-hidden">
        
        <!-- Cabecera con icono -->
        <div class="bg-gradient-to-r from-[#E0007C]/15 to-transparent p-6 border-b border-ale-border">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-[#E0007C] to-[#c20068] rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-language text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bungee text-white tracking-wide">{{ $word->word }}</h1>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bungee bg-[#00E5FF]/20 text-[#00E5FF]">
                            <i class="fas fa-tag text-xs"></i>
                            {{ $word->category->name ?? 'Sin categoría' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="p-6">
            
            <!-- Grid de información -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Columna izquierda -->
                <div class="space-y-5">
                    <!-- Palabra -->
                    <div class="bg-black/30 rounded-xl p-4 border border-ale-border">
                        <label class="block text-[#00E5FF] text-xs font-bungee uppercase tracking-wider mb-2 flex items-center gap-2">
                            <i class="fas fa-language"></i>
                            PALABRA EN INGLÉS
                        </label>
                        <p class="text-ale-text text-lg font-semibold">{{ $word->word }}</p>
                    </div>

                    <!-- Traducción -->
                    <div class="bg-black/30 rounded-xl p-4 border border-ale-border">
                        <label class="block text-[#00E5FF] text-xs font-bungee uppercase tracking-wider mb-2 flex items-center gap-2">
                            <i class="fas fa-language"></i>
                            TRADUCCIÓN AL ESPAÑOL
                        </label>
                        <p class="text-ale-text text-lg">{{ $word->translation }}</p>
                    </div>

                    <!-- Pronunciación -->
                    <div class="bg-black/30 rounded-xl p-4 border border-ale-border">
                        <label class="block text-[#00E5FF] text-xs font-bungee uppercase tracking-wider mb-2 flex items-center gap-2">
                            <i class="fas fa-volume-up"></i>
                            PRONUNCIACIÓN (FONÉTICA)
                        </label>
                        <p class="text-ale-text font-mono text-lg">{{ $word->pronunciation ?? 'No disponible' }}</p>
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="space-y-5">
                    <!-- Categoría -->
                    <div class="bg-black/30 rounded-xl p-4 border border-ale-border">
                        <label class="block text-[#00E5FF] text-xs font-bungee uppercase tracking-wider mb-2 flex items-center gap-2">
                            <i class="fas fa-tag"></i>
                            CATEGORÍA
                        </label>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-bungee bg-[#00E5FF]/20 text-[#00E5FF]">
                            <i class="fas fa-folder-open text-xs"></i>
                            {{ $word->category->name ?? 'Sin categoría' }}
                        </span>
                    </div>

                    <!-- Audio -->
                    <!-- <div class="bg-black/30 rounded-xl p-4 border border-ale-border">
                        <label class="block text-[#00E5FF] text-xs font-bungee uppercase tracking-wider mb-2 flex items-center gap-2">
                            <i class="fas fa-headphones"></i>
                            AUDIO DE PRONUNCIACIÓN
                        </label>
                        @if($word->audio_path)
                            <div class="mt-2">
                                <audio controls class="w-full">
                                    <source src="{{ asset('storage/' . $word->audio_path) }}" type="audio/mpeg">
                                    Tu navegador no soporta el elemento de audio.
                                </audio>
                                <p class="text-xs text-ale-text-dim mt-2">
                                    <i class="fas fa-info-circle text-[#00E5FF]"></i> Haz clic en reproducir para escuchar la pronunciación
                                </p>
                            </div>
                        @else
                            <div class="flex items-center gap-2 text-ale-text-dim py-2">
                                <i class="fas fa-microphone-slash text-[#E0007C]"></i>
                                <span>No hay audio disponible para esta palabra</span>
                            </div>
                        @endif
                    </div> -->
                </div>
            </div>

            <!-- Fechas de creación y actualización -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6 pt-4 border-t border-ale-border">
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-calendar-alt text-[#E0007C] w-5"></i>
                    <span class="text-gray-400">Creado:</span>
                    <span class="text-white">{{ $word->created_at ? $word->created_at->format('d/m/Y H:i:s') : 'N/A' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-edit text-[#E0007C] w-5"></i>
                    <span class="text-gray-400">Última actualización:</span>
                    <span class="text-white">{{ $word->updated_at ? $word->updated_at->format('d/m/Y H:i:s') : 'N/A' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-id-card text-[#E0007C] w-5"></i>
                    <span class="text-gray-400">ID de palabra:</span>
                    <span class="text-white">{{ $word->id }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-book-open text-[#E0007C] w-5"></i>
                    <span class="text-gray-400">Lecciones asociadas:</span>
                    <span class="text-white">{{ $word->lessons ? $word->lessons->count() : 0 }}</span>
                </div>
            </div>

        </div>

        <!-- Botones de acción -->
        <div class="bg-ale-surface/50 p-6 border-t border-ale-border flex flex-wrap gap-3">
            <a href="{{ route('words.index') }}" class="bg-transparent border border-ale-border hover:border-[#00E5FF] text-white px-5 py-2 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide hover:text-[#00E5FF]">
                <i class="fas fa-arrow-left"></i>
                VOLVER AL LISTADO
            </a>
            
            <a href="{{ route('words.edit', $word->id) }}" class="bg-[#00E5FF] hover:bg-[#E0007C] text-black px-5 py-2 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide">
                <i class="fas fa-edit"></i>
                EDITAR PALABRA
            </a>
            
            <button type="button" onclick="confirmDelete({{ $word->id }}, '{{ addslashes($word->word) }}')" class="ml-auto bg-red-600/20 border border-red-600/50 hover:bg-red-600 text-red-400 hover:text-white px-5 py-2 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide">
                <i class="fas fa-trash-alt"></i>
                ELIMINAR PALABRA
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
            <h3 class="text-xl font-bungee text-ale-text">CONFIRMAR ELIMINACIÓN</h3>
        </div>
        <p class="text-ale-text-dim mb-6">
            ¿Estás seguro de que deseas eliminar la palabra <strong id="delete-word-name" class="text-[#E0007C]"></strong>?
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
    
    audio {
        border-radius: 0.5rem;
        background: #0d0d0d;
    }
    
    audio::-webkit-media-controls-panel {
        background-color: #0d0d0d;
    }
    
    audio::-webkit-media-controls-current-time-display,
    audio::-webkit-media-controls-time-remaining-display {
        color: #FAF9F6;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentWordId = null;
    let currentWordName = null;
    
    function confirmDelete(wordId, wordName) {
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        const wordNameSpan = document.getElementById('delete-word-name');
        const deleteForm = document.getElementById('delete-form');
        
        currentWordId = wordId;
        currentWordName = wordName;
        wordNameSpan.textContent = wordName;
        deleteForm.action = `/words/${wordId}`;
        
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
            currentWordId = null;
            currentWordName = null;
        }, 200);
    }
    
    document.getElementById('cancel-delete')?.addEventListener('click', closeModal);
    
    document.getElementById('delete-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.getElementById('confirm-delete')?.addEventListener('click', function() {
        if (currentWordId) {
            document.getElementById('delete-form').submit();
        }
    });
</script>
@endpush