@extends('layouts.admin')

@section('title', 'Detalle de Categoría')

@section('header', 'Detalle de Categoría')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-ale-pink transition">
            <i class="fas fa-home text-ale-pink"></i> Inicio
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('categories.index') }}" class="hover:text-ale-pink transition">Categorías</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-ale-pink">{{ $category->name }}</span>
    </nav>

    <!-- Tarjeta principal -->
    <div class="bg-ale-surface border border-ale-border rounded-xl overflow-hidden">
        
        <!-- Cabecera con icono -->
        <div class="bg-gradient-to-r from-ale-pink/15 to-transparent p-6 border-b border-ale-border">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-ale-pink to-pink-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-tags text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $category->name }}</h1>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400">
                            <i class="fas fa-language text-xs"></i>
                            {{ $category->words->count() }} palabras
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400">
                            <i class="fas fa-calendar-alt text-xs"></i>
                            Creado: {{ $category->created_at ? $category->created_at->format('d/m/Y') : 'N/A' }}
                        </span>
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
                        {{ $category->description ?? 'No hay descripción disponible para esta categoría.' }}
                    </p>
                </div>
            </div>

            <!-- Palabras de la categoría -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-language text-ale-pink"></i>
                        Palabras en esta categoría
                    </h3>
                    <a href="{{ route('words.create') }}?category_id={{ $category->id }}" class="text-ale-pink text-sm hover:underline flex items-center gap-1">
                        <i class="fas fa-plus-circle"></i>
                        Agregar palabra
                    </a>
                </div>
                
                @if($category->words && $category->words->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach($category->words as $word)
                            <div class="bg-ale-surface-light border border-ale-border rounded-lg p-3 hover:border-ale-pink transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-ale-pink/20 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-language text-ale-pink text-sm"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('words.show', $word->id) }}" class="text-white font-medium hover:text-ale-pink transition">
                                                {{ $word->word }}
                                            </a>
                                            <p class="text-ale-text-dim text-xs">{{ $word->translation }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('words.edit', $word->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Editar">
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
                                <i class="fas fa-language text-ale-pink text-xl"></i>
                            </div>
                            <p class="text-ale-text-dim">Esta categoría no tiene palabras asignadas</p>
                            <a href="{{ route('words.create') }}?category_id={{ $category->id }}" class="btn-outline text-sm mt-2">
                                <i class="fas fa-plus"></i>
                                Agregar primera palabra
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Información adicional -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6 pt-4 border-t border-ale-border">
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-id-card text-ale-pink w-5"></i>
                    <span class="text-gray-400">ID de categoría:</span>
                    <span class="text-white">{{ $category->id }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-edit text-ale-pink w-5"></i>
                    <span class="text-gray-400">Última actualización:</span>
                    <span class="text-white">{{ $category->updated_at ? $category->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>
            </div>

        </div>

        <!-- Botones de acción -->
        <div class="bg-ale-surface/50 p-6 border-t border-ale-border flex flex-wrap gap-3">
            <a href="{{ route('categories.index') }}" class="bg-transparent border border-ale-border hover:border-ale-pink text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver al listado
            </a>
            
            <a href="{{ route('categories.edit', $category->id) }}" class="bg-[#06b6d4] hover:bg-[#0891b2] text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-edit"></i>
                Editar Categoría
            </a>
            
            <button type="button" onclick="confirmDelete({{ $category->id }}, '{{ addslashes($category->name) }}', {{ $category->words->count() }})" class="ml-auto bg-red-600/20 border border-red-600/50 hover:bg-red-600 text-red-400 hover:text-white px-5 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-trash-alt"></i>
                Eliminar Categoría
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
            ¿Estás seguro de que deseas eliminar la categoría <strong id="delete-category-name" class="text-ale-pink"></strong>?
            Esta acción no se puede deshacer y afectará a las <strong id="words-count" class="text-ale-pink"></strong> palabras asociadas.
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

@push('scripts')
<script>
    let currentCategoryId = null;
    let currentCategoryName = null;
    let wordsCount = 0;
    
    function confirmDelete(categoryId, categoryName, wordsCountValue = 0) {
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        const categoryNameSpan = document.getElementById('delete-category-name');
        const wordsCountSpan = document.getElementById('words-count');
        const deleteForm = document.getElementById('delete-form');
        
        currentCategoryId = categoryId;
        currentCategoryName = categoryName;
        categoryNameSpan.textContent = categoryName;
        wordsCountSpan.textContent = wordsCountValue;
        deleteForm.action = `/categories/${categoryId}`;
        
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
            currentCategoryId = null;
            currentCategoryName = null;
        }, 200);
    }
    
    document.getElementById('cancel-delete')?.addEventListener('click', closeModal);
    
    document.getElementById('delete-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.getElementById('confirm-delete')?.addEventListener('click', function() {
        if (currentCategoryId) {
            document.getElementById('delete-form').submit();
        }
    });
</script>
@endpush