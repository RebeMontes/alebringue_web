@extends('layouts.admin')

@section('title', 'Gestión de Categorías')

@section('header', 'Gestión de Categorías')

@section('content')
<div class="space-y-6">
    
    <!-- Encabezado con acciones -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-ale-text-dim mb-1">
                <x-breadcrumbs :links="[
                    ['name' => 'Inicio', 'url' => route('home')],
                    ['name' => 'Categorías']
                ]" />
            </div>
            <p class="text-ale-text-dim text-sm">Administra las categorías de vocabulario del sistema educativo</p>
        </div>
        
        <div class="flex gap-3">
            <!-- Botón exportar -->
            <button id="btn-exportar" class="btn-outline flex items-center gap-2 text-sm">
                <i class="fas fa-download"></i>
                Exportar
            </button>
            
            <!-- Botón nueva categoría -->
            <a href="{{ route('categories.create') }}" class="btn-primary flex items-center gap-2 text-sm">
                <i class="fas fa-plus"></i>
                Nueva Categoría
            </a>
        </div>
    </div>
    
    <!-- Tarjeta de estadísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Total Categorías</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $categories->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-ale-pink/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-tags text-ale-pink"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Palabras Totales</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $categories->sum(function($cat) { return $cat->words->count(); }) }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-language text-blue-400"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Con palabras</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $categories->filter(function($cat) { return $cat->words->count() > 0; })->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabla de categorías -->
    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-ale-border">
                <thead>
                    <tr class="bg-ale-surface-light">
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">ID</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Nombre</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Descripción</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Palabras</th>
                        <th class="px-4 py-4 text-center text-xs font-semibold text-ale-pink uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ale-border">
                    @forelse($categories as $cat)
                    <tr class="category-row hover:bg-ale-surface/50 transition-colors">
                        <td class="px-4 py-4 align-middle">
                            <span class="text-ale-text-dim text-sm">{{ $cat->id }}</span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-ale-pink to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-tag text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-ale-text">{{ $cat->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <p class="text-ale-text-dim text-sm">{{ Str::limit($cat->description ?? 'Sin descripción', 50) }}</p>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400">
                                <i class="fas fa-language text-xs"></i>
                                {{ $cat->words->count() }} palabras
                            </span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('categories.show', $cat->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('categories.edit', $cat->id) }}" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $cat->id }}, '{{ addslashes($cat->name) }}', {{ $cat->words->count() }})" class="text-ale-text-dim hover:text-red-500 transition p-1" title="Eliminar">
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
                                    <i class="fas fa-tags text-3xl text-ale-text-dim"></i>
                                </div>
                                <p class="text-ale-text-dim">No hay categorías registradas</p>
                                <a href="{{ route('categories.create') }}" class="btn-primary text-sm mt-2">Crear primera categoría</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        @if(method_exists($categories, 'links') && $categories->hasPages())
        <div class="border-t border-ale-border p-4 bg-ale-surface/30">
            {{ $categories->links() }}
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
    
    // Exportar categorías
    document.getElementById('btn-exportar')?.addEventListener('click', function() {
        const visibleRows = document.querySelectorAll('.category-row');
        const data = [];
        
        visibleRows.forEach(row => {
            const id = row.querySelector('td:nth-child(1)')?.textContent || '';
            const name = row.querySelector('td:nth-child(2) .font-semibold')?.textContent || '';
            const description = row.querySelector('td:nth-child(3) p')?.textContent || '';
            const words = row.querySelector('td:nth-child(4) span')?.textContent.trim() || '';
            
            data.push({ id, name, description, words });
        });
        
        const csv = data.map(row => `"${row.id}","${row.name}","${row.description}","${row.words}"`).join('\n');
        const blob = new Blob([`ID,Nombre,Descripción,Palabras\n${csv}`], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.download = 'categorias_exportadas.csv';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
        
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-20 right-6 z-50 bg-ale-surface border border-green-500/50 rounded-xl shadow-xl p-4 min-w-[280px] flex items-center gap-3';
        toast.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center">
                <i class="fas fa-check-circle text-green-400 text-lg"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm text-ale-text">Categorías exportadas correctamente</p>
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