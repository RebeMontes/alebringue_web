@extends('layouts.admin')

@section('title', 'Administrar Usuarios')

@section('header', 'Gestión de Usuarios')

@section('content')
<div class="space-y-6">
    
    <!-- Encabezado con acciones -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <x-breadcrumbs :links="[
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Usuarios'],
            ['name' => 'Crear']
            ]" />
            <p class="text-ale-text-dim text-sm">Administra todos los usuarios de la plataforma</p>
        </div>
        
        <div class="flex gap-3">
            <!-- Botón exportar -->
            <button id="btn-exportar" class="btn-outline flex items-center gap-2 text-sm">
                <i class="fas fa-download"></i>
                Exportar
            </button>
            
            <!-- Botón nuevo usuario -->
            <a href="#" class="btn-primary flex items-center gap-2 text-sm">
                <i class="fas fa-plus"></i>
                Nuevo Usuario
            </a>
        </div>
    </div>
    
    <!-- Tarjeta de estadísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Total Usuarios</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $users->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-ale-pink/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-ale-pink"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Estudiantes</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $users->where('user_type', 'user')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-graduate text-blue-400"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Administradores</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $users->where('user_type', 'admin')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-shield text-purple-400"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-ale-text-dim text-sm">Nuevos (este mes)</p>
                    <p class="text-2xl font-bold text-ale-text">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-plus text-green-400"></i>
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
                    <input type="text" id="search-input" placeholder="Buscar por nombre, email o tipo..." class="input-admin pl-10">
                </div>
            </div>
            
            <!-- Filtro por tipo -->
            <div>
                <select id="filter-type" class="input-admin w-full md:w-40">
                    <option value="all">Todos los tipos</option>
                    <option value="user">Estudiantes</option>
                    <option value="admin">Administradores</option>
                </select>
            </div>
            
            <!-- Filtro por estado -->
            <div>
                <select id="filter-status" class="input-admin w-full md:w-40">
                    <option value="all">Todos los estados</option>
                    <option value="active">Activos</option>
                    <option value="inactive">Inactivos</option>
                </select>
            </div>
            
            <!-- Botón limpiar filtros -->
            <button id="clear-filters" class="btn-outline text-sm px-4">
                <i class="fas fa-eraser"></i>
                Limpiar
            </button>
        </div>
    </div>
    
    <!-- Tabla de usuarios - Con mejor espaciado y alineación -->
    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-ale-border">
                <thead>
                    <tr class="bg-ale-surface-light">
                        <th class="w-12 px-4 py-4 text-left">
                            <input type="checkbox" id="select-all" class="rounded border-ale-border bg-transparent">
                        </th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Usuario</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Correo electrónico</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Tipo</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Estado</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Fecha de registro</th>
                        <th class="px-4 py-4 text-left text-xs font-semibold text-ale-pink uppercase tracking-wider">Progreso</th>
                        <th class="px-4 py-4 text-center text-xs font-semibold text-ale-pink uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ale-border">
                    @forelse($users as $user)
                    <tr class="user-row hover:bg-ale-surface/50 transition-colors" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}" data-type="{{ $user->user_type }}" data-status="{{ $user->status ?? 'active' }}">
                        <td class="px-4 py-4 align-middle">
                            <input type="checkbox" class="user-checkbox rounded border-ale-border bg-transparent" value="{{ $user->id }}">
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-ale-pink to-pink-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-sm font-semibold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-ale-text truncate">{{ $user->name }}</p>
                                    <p class="text-xs text-ale-text-dim">ID: {{ $user->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-ale-text-dim text-xs flex-shrink-0"></i>
                                <span class="text-ale-text text-sm truncate">{{ $user->email }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            @if($user->user_type == 'admin')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-400">
                                    <i class="fas fa-user-shield text-xs"></i>
                                    Administrador
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400">
                                    <i class="fas fa-user-graduate text-xs"></i>
                                    Estudiante
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ ($user->status ?? 'active') == 'active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                <i class="fas {{ ($user->status ?? 'active') == 'active' ? 'fa-check-circle' : 'fa-times-circle' }} text-xs"></i>
                                {{ ($user->status ?? 'active') == 'active' ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex flex-col">
                                <span class="text-ale-text text-sm">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</span>
                                <span class="text-xs text-ale-text-dim">{{ $user->created_at ? $user->created_at->format('H:i') : '' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="min-w-[120px]">
                                <div class="flex justify-between text-xs text-ale-text-dim mb-1.5">
                                    <span>Progreso</span>
                                    <span class="font-medium text-ale-pink">{{ $user->progress ?? 0 }}%</span>
                                </div>
                                <div class="progress-bar h-2">
                                    <div class="progress-fill" style="width: {{ $user->progress ?? 0 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 align-middle">
                            <div class="flex items-center justify-center gap-3">
                                <a href="#" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $user->id }}, '{{ addslashes($user->name) }}')" class="text-ale-text-dim hover:text-red-500 transition p-1" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <a href="#" class="text-ale-text-dim hover:text-ale-pink transition p-1" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-16 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-16 h-16 bg-ale-surface rounded-full flex items-center justify-center">
                                    <i class="fas fa-users-slash text-3xl text-ale-text-dim"></i>
                                </div>
                                <p class="text-ale-text-dim">No hay usuarios registrados</p>
                                <a href="#" class="btn-primary text-sm mt-2">Crear primer usuario</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        @if(method_exists($users, 'links') && $users->hasPages())
        <div class="border-t border-ale-border p-4 bg-ale-surface/30">
            {{ $users->links() }}
        </div>
        @endif
    </div>
    
    <!-- Acciones masivas -->
    <div id="bulk-actions" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-ale-surface border border-ale-border rounded-xl shadow-xl p-3 flex items-center gap-4 z-50 hidden">
        <span id="selected-count" class="text-ale-text text-sm">0 seleccionados</span>
        <div class="h-6 w-px bg-ale-border"></div>
        <button id="bulk-activate" class="text-green-400 hover:text-green-300 transition text-sm flex items-center gap-2">
            <i class="fas fa-check-circle"></i> Activar
        </button>
        <button id="bulk-deactivate" class="text-yellow-400 hover:text-yellow-300 transition text-sm flex items-center gap-2">
            <i class="fas fa-ban"></i> Desactivar
        </button>
        <button id="bulk-delete" class="text-red-400 hover:text-red-300 transition text-sm flex items-center gap-2">
            <i class="fas fa-trash"></i> Eliminar
        </button>
        <button id="bulk-cancel" class="text-ale-text-dim hover:text-ale-text transition text-sm">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
</div>

<!-- Modal de confirmación de eliminación -->
<div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm hidden">
    <div class="bg-ale-surface border border-ale-border rounded-2xl p-6 max-w-md w-full mx-4">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-ale-text">Confirmar eliminación</h3>
        </div>
        <p class="text-ale-text-dim mb-6">
            ¿Estás seguro de que deseas eliminar al usuario <strong id="delete-user-name" class="text-ale-pink"></strong>?
            Esta acción no se puede deshacer.
        </p>
        <div class="flex gap-3 justify-end">
            <button id="cancel-delete" class="btn-outline">Cancelar</button>
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-primary bg-red-600 hover:bg-red-700">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .stat-card {
        background: #1a1a1a;
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
    
    input[type="checkbox"] {
        accent-color: #E4007C;
        width: 1rem;
        height: 1rem;
        cursor: pointer;
    }
    
    /* Mejoras de tabla */
    .table-ale th,
    .table-ale td {
        vertical-align: middle;
    }
    
    /* Animación de hover para filas */
    .user-row {
        transition: background-color 0.2s ease;
    }
    
    /* Paginación personalizada */
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
    
    .pagination .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .pagination .page-item:not(.disabled):not(.active) .page-link:hover {
        border-color: #E4007C;
        background: rgba(228, 0, 124, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    // Función para confirmar eliminación
    function confirmDelete(userId, userName) {
        const modal = document.getElementById('delete-modal');
        const deleteForm = document.getElementById('delete-form');
        const userNameSpan = document.getElementById('delete-user-name');
        
        userNameSpan.textContent = userName;
        deleteForm.action = `/admin/users/${userId}`;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    // Cerrar modal
    document.getElementById('cancel-delete')?.addEventListener('click', function() {
        document.getElementById('delete-modal').classList.add('hidden');
        document.body.style.overflow = '';
    });
    
    // Cerrar modal al hacer click fuera
    document.getElementById('delete-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });
    
    // Búsqueda y filtros
    const searchInput = document.getElementById('search-input');
    const filterType = document.getElementById('filter-type');
    const filterStatus = document.getElementById('filter-status');
    const clearFilters = document.getElementById('clear-filters');
    const rows = document.querySelectorAll('.user-row');
    
    function filterTable() {
        const searchTerm = searchInput?.value.toLowerCase() || '';
        const typeValue = filterType?.value || 'all';
        const statusValue = filterStatus?.value || 'all';
        
        let visibleCount = 0;
        
        rows.forEach(row => {
            const name = row.dataset.name || '';
            const email = row.dataset.email || '';
            const type = row.dataset.type || '';
            const status = row.dataset.status || 'active';
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
            const matchesType = typeValue === 'all' || type === typeValue;
            const matchesStatus = statusValue === 'all' || status === statusValue;
            
            if (matchesSearch && matchesType && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Mostrar mensaje si no hay resultados
        const tbody = document.querySelector('#users-table-body');
        const noResultsRow = document.getElementById('no-results-row');
        
        if (visibleCount === 0 && rows.length > 0) {
            if (!noResultsRow) {
                const tr = document.createElement('tr');
                tr.id = 'no-results-row';
                tr.innerHTML = `<td colspan="8" class="px-4 py-12 text-center">
                    <div class="flex flex-col items-center gap-2">
                        <i class="fas fa-search text-3xl text-ale-text-dim"></i>
                        <p class="text-ale-text-dim">No se encontraron usuarios con esos criterios</p>
                        <button id="clear-filters-empty" class="btn-outline text-sm mt-2">Limpiar filtros</button>
                    </div>
                </td>`;
                tbody?.appendChild(tr);
                
                document.getElementById('clear-filters-empty')?.addEventListener('click', () => {
                    if (searchInput) searchInput.value = '';
                    if (filterType) filterType.value = 'all';
                    if (filterStatus) filterStatus.value = 'all';
                    filterTable();
                });
            }
        } else if (noResultsRow) {
            noResultsRow.remove();
        }
    }
    
    searchInput?.addEventListener('keyup', filterTable);
    filterType?.addEventListener('change', filterTable);
    filterStatus?.addEventListener('change', filterTable);
    
    clearFilters?.addEventListener('click', function() {
        if (searchInput) searchInput.value = '';
        if (filterType) filterType.value = 'all';
        if (filterStatus) filterStatus.value = 'all';
        filterTable();
    });
    
    // Selección múltiple
    const selectAll = document.getElementById('select-all');
    const userCheckboxes = document.querySelectorAll('.user-checkbox');
    const bulkActions = document.getElementById('bulk-actions');
    const selectedCountSpan = document.getElementById('selected-count');
    
    function updateBulkActions() {
        const checked = document.querySelectorAll('.user-checkbox:checked');
        const count = checked.length;
        
        if (selectedCountSpan) {
            selectedCountSpan.textContent = `${count} seleccionado${count !== 1 ? 's' : ''}`;
        }
        
        if (bulkActions) {
            if (count > 0) {
                bulkActions.classList.remove('hidden');
            } else {
                bulkActions.classList.add('hidden');
            }
        }
    }
    
    selectAll?.addEventListener('change', function() {
        const visibleRows = document.querySelectorAll('.user-row:not([style*="display: none"])');
        visibleRows.forEach(row => {
            const cb = row.querySelector('.user-checkbox');
            if (cb) cb.checked = selectAll.checked;
        });
        updateBulkActions();
    });
    
    userCheckboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            updateBulkActions();
            if (selectAll) {
                const visibleCheckboxes = document.querySelectorAll('.user-row:not([style*="display: none"]) .user-checkbox');
                const allChecked = Array.from(visibleCheckboxes).every(c => c.checked);
                selectAll.checked = allChecked && visibleCheckboxes.length > 0;
            }
        });
    });
    
    // Acciones masivas
    document.getElementById('bulk-cancel')?.addEventListener('click', function() {
        userCheckboxes.forEach(cb => cb.checked = false);
        if (selectAll) selectAll.checked = false;
        updateBulkActions();
    });
    
    document.getElementById('bulk-delete')?.addEventListener('click', function() {
        const selected = document.querySelectorAll('.user-checkbox:checked');
        const ids = Array.from(selected).map(cb => cb.value);
        
        if (ids.length === 0) return;
        
        if (confirm(`¿Eliminar ${ids.length} usuario${ids.length !== 1 ? 's' : ''}?`)) {
            // Aquí iría la llamada AJAX para eliminar múltiples usuarios
            console.log('Eliminar usuarios:', ids);
            alert('Función implementar con AJAX - Eliminar usuarios: ' + ids.join(', '));
        }
    });
    
    document.getElementById('bulk-activate')?.addEventListener('click', function() {
        const selected = document.querySelectorAll('.user-checkbox:checked');
        const ids = Array.from(selected).map(cb => cb.value);
        if (ids.length === 0) return;
        alert(`Activar ${ids.length} usuario${ids.length !== 1 ? 's' : ''}`);
    });
    
    document.getElementById('bulk-deactivate')?.addEventListener('click', function() {
        const selected = document.querySelectorAll('.user-checkbox:checked');
        const ids = Array.from(selected).map(cb => cb.value);
        if (ids.length === 0) return;
        alert(`Desactivar ${ids.length} usuario${ids.length !== 1 ? 's' : ''}`);
    });
    
    // Exportar usuarios
    document.getElementById('btn-exportar')?.addEventListener('click', function() {
        const visibleRows = document.querySelectorAll('.user-row:not([style*="display: none"])');
        const data = [];
        
        visibleRows.forEach(row => {
            const name = row.querySelector('td:nth-child(2) .font-semibold')?.textContent || '';
            const email = row.querySelector('td:nth-child(3) span:last-child')?.textContent || '';
            const typeElem = row.querySelector('td:nth-child(4) span');
            let type = '';
            if (typeElem?.textContent.includes('Administrador')) type = 'admin';
            else if (typeElem?.textContent.includes('Estudiante')) type = 'user';
            
            data.push({ name, email, type });
        });
        
        const csv = data.map(row => `"${row.name}","${row.email}","${row.type}"`).join('\n');
        const blob = new Blob([`Nombre,Correo,Tipo\n${csv}`], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.setAttribute('download', 'usuarios_exportados.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    });
</script>
@endpush