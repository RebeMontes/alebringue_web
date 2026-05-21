@extends('layouts.admin')

@section('title', 'Gestión de Palabras')

@section('header', 'Gestión de Palabras')

@section('content')
<div class="space-y-6">
    
    <!-- Encabezado con acciones -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-ale-text-dim mb-1">
                <x-breadcrumbs :links="[
                    ['name' => 'Inicio', 'url' => route('home')],
                    ['name' => 'Palabras']
                ]" />
            </div>
            <p class="text-ale-text-dim text-sm">Administra el vocabulario del sistema educativo</p>
        </div>
        
        <div class="flex gap-3">
            <!-- Botón exportar -->
            <button id="btn-exportar" class="btn-outline flex items-center gap-2 text-sm">
                <i class="fas fa-download"></i>
                Exportar
            </button>
            
            <!-- Botón nueva palabra -->
            <a href="{{ route('words.create') }}" class="btn-primary flex items-center gap-2 text-sm">
                <i class="fas fa-plus"></i>
                Nueva Palabra
            </a>
        </div>
    </div>
    
    <!-- Tarjeta de estadísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Total Palabras</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $words->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-ale-pink/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-language text-ale-pink"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Categorías</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $words->groupBy('category_id')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-tags text-blue-400"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Con pronunciación</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $words->whereNotNull('pronunciation')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-volume-up text-green-400"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Nuevas (este mes)</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $words->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
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
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-ale-text-dim text-sm"></i>
                    <input type="text" id="search-input" placeholder="Buscar palabra o traducción..." class="input-admin pl-10">
                </div>
            </div>
            
            <div>
                <select id="filter-category" class="input-admin w-full md:w-48">
                    <option value="all">Todas las categorías</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button id="clear-filters" class="btn-outline text-sm px-4">
                <i class="fas fa-eraser"></i>
                Limpiar
            </button>
        </div>
    </div>
    
    <!-- Tabla de palabras -->
    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-ale-border">
                <thead>
                    <tr class="bg-ale-surface-light">
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Palabra</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Traducción</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Pronunciación</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Categoría</th>
                        <th class="px-4 py-4 text-center text-xs font-semibold text-ale-pink uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ale-border">
                    @forelse($words as $word)
                    <tr class="word-row hover:bg-ale-surface/50 transition-colors" data-word="{{ strtolower($word->word) }}" data-translation="{{ strtolower($word->translation) }}" data-category="{{ strtolower($word->category->name ?? '') }}">
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-ale-pink/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-language text-ale-pink text-sm"></i>
                                </div>
                                <span class="font-semibold text-ale-text">{{ $word->word }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <span class="text-ale-text">{{ $word->translation }}</span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-volume-up text-ale-text-dim text-xs"></i>
                                <span class="text-ale-text">{{ $word->pronunciation ?? 'No disponible' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-400">
                                <i class="fas fa-tag text-xs"></i>
                                {{ $word->category->name ?? 'Sin categoría' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('words.edit', $word->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('words.show', $word->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $word->id }}, '{{ addslashes($word->word) }}')" class="text-ale-text-dim hover:text-red-500 transition p-1" title="Eliminar">
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
                                    <i class="fas fa-language text-3xl text-ale-text-dim"></i>
                                </div>
                                <p class="text-ale-text-dim">No hay palabras registradas</p>
                                <a href="{{ route('words.create') }}" class="btn-primary text-sm mt-2">Crear primera palabra</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        @if(method_exists($words, 'links') && $words->hasPages())
        <div class="border-t border-ale-border p-4 bg-ale-surface/30">
            {{ $words->links() }}
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
            ¿Estás seguro de que deseas eliminar la palabra <strong id="delete-word-name" class="text-ale-pink"></strong>?
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
    
    .word-row {
        transition: background-color 0.2s ease;
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
    
    // Búsqueda y filtros
    const searchInput = document.getElementById('search-input');
    const filterCategory = document.getElementById('filter-category');
    const clearFilters = document.getElementById('clear-filters');
    const rows = document.querySelectorAll('.word-row');
    
    function filterTable() {
        const searchTerm = searchInput?.value.toLowerCase() || '';
        const categoryValue = filterCategory?.value.toLowerCase() || 'all';
        
        rows.forEach(row => {
            const word = row.dataset.word || '';
            const translation = row.dataset.translation || '';
            const category = row.dataset.category || '';
            
            const matchesSearch = word.includes(searchTerm) || translation.includes(searchTerm);
            const matchesCategory = categoryValue === 'all' || category.includes(categoryValue);
            
            row.style.display = (matchesSearch && matchesCategory) ? '' : 'none';
        });
    }
    
    searchInput?.addEventListener('keyup', filterTable);
    filterCategory?.addEventListener('change', filterTable);
    clearFilters?.addEventListener('click', function() {
        if (searchInput) searchInput.value = '';
        if (filterCategory) filterCategory.value = 'all';
        filterTable();
    });
    
    // Exportar palabras
    document.getElementById('btn-exportar')?.addEventListener('click', function() {
        const visibleRows = document.querySelectorAll('.word-row:not([style*="display: none"])');
        const data = [];
        
        visibleRows.forEach(row => {
            const word = row.querySelector('td:nth-child(1) .font-semibold')?.textContent || '';
            const translation = row.querySelector('td:nth-child(2) span')?.textContent || '';
            const pronunciation = row.querySelector('td:nth-child(3) span')?.textContent || '';
            const category = row.querySelector('td:nth-child(4) span')?.textContent.trim() || '';
            
            data.push({ word, translation, pronunciation, category });
        });
        
        const csv = data.map(row => `"${row.word}","${row.translation}","${row.pronunciation}","${row.category}"`).join('\n');
        const blob = new Blob([`Palabra,Traducción,Pronunciación,Categoría\n${csv}`], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.download = 'palabras_exportadas.csv';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
        
        // Toast de éxito
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-20 right-6 z-50 bg-ale-surface border border-green-500/50 rounded-xl shadow-xl p-4 min-w-[280px] flex items-center gap-3';
        toast.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center">
                <i class="fas fa-check-circle text-green-400 text-lg"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm text-ale-text">Palabras exportadas correctamente</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-ale-text-dim hover:text-ale-text">
                <i class="fas fa-times"></i>
            </button>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    });
</script>
@endpush