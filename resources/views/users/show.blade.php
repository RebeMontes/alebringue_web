@extends('layouts.admin')

@section('title', 'Detalle Usuario')

@section('header', 'Detalle del Usuario')

@section('content')
<div class="max-w-2xl mx-auto">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <x-breadcrumbs :links="[
        ['name' => 'Inicio', 'url' => route('home')],
        ['name' => 'Usuarios', 'url' => route('users.index')],
        ['name' => 'Detalle']
        ]" />
    </nav>

    <!-- Tarjeta principal -->
    <div class="bg-ale-surface border border-ale-border rounded-xl overflow-hidden">

        <!-- Cabecera con avatar -->
        <div class="bg-gradient-to-r from-[#E0007C]/15 to-transparent p-6 border-b border-ale-border">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 bg-gradient-to-br from-[#E0007C] to-[#c20068] rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-white text-2xl font-bungee">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bungee text-white tracking-wide">{{ $user->name }}</h2>
                    <div class="flex items-center gap-2 mt-1">
                        @if($user->user_type == 'admin')
                            <span class="badge-ale bg-purple-500/20 text-purple-400 px-3 py-1 text-xs rounded-full font-bungee">
                                <i class="fas fa-user-shield mr-1"></i> ADMINISTRADOR
                            </span>
                        @else
                            <span class="badge-ale bg-[#00E5FF]/20 text-[#00E5FF] px-3 py-1 text-xs rounded-full font-bungee">
                                <i class="fas fa-user-graduate mr-1"></i> ESTUDIANTE
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del usuario -->
        <div class="p-6">
            <h3 class="text-lg font-bungee text-white mb-4 flex items-center gap-2 tracking-wide">
                <i class="fas fa-address-card text-[#00E5FF]"></i>
                INFORMACIÓN PERSONAL
            </h3>

            <div class="space-y-4">
                <!-- Nombre -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-ale-border">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-user w-4 text-[#E0007C]"></i>
                            Nombre completo
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-white font-medium">{{ $user->name }}</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-ale-border">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-envelope w-4 text-[#E0007C]"></i>
                            Correo electrónico
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-white font-medium">{{ $user->email }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Verificado</p>
                    </div>
                </div>

                <!-- Tipo de usuario -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2 border-b border-ale-border">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-user-tag w-4 text-[#E0007C]"></i>
                            Tipo de cuenta
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        @if($user->user_type == 'admin')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-400 font-bungee">
                                <i class="fas fa-user-shield"></i> ADMINISTRADOR
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-[#00E5FF]/20 text-[#00E5FF] font-bungee">
                                <i class="fas fa-user-graduate"></i> ESTUDIANTE
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Fecha de registro -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-2">
                    <div class="md:col-span-1">
                        <p class="text-gray-400 text-sm flex items-center gap-2">
                            <i class="fas fa-calendar-alt w-4 text-[#E0007C]"></i>
                            Fecha de registro
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-white font-medium">{{ $user->created_at ? $user->created_at->format('d/m/Y H:i:s') : 'N/A' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $user->created_at ? $user->created_at->diffForHumans() : '' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="bg-ale-surface/50 p-6 border-t border-ale-border flex flex-wrap gap-3">
            <a href="{{ route('users.edit', $user->id) }}" class="bg-[#00E5FF] hover:bg-[#00cce0] text-black px-5 py-2 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide">
                <i class="fas fa-edit"></i>
                EDITAR USUARIO
            </a>

            <a href="{{ route('users.index') }}" class="bg-transparent border border-ale-border hover:border-[#00E5FF] text-white px-5 py-2 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide hover:text-[#00E5FF]">
                <i class="fas fa-arrow-left"></i>
                VOLVER AL LISTADO
            </a>
            <!-- <button type="button" onclick="confirmDelete({{ $user->id }}, '{{ addslashes($user->name) }}')" class="ml-auto bg-red-600/20 border border-red-600/50 hover:bg-red-600 text-red-400 hover:text-white px-5 py-2 rounded-lg font-bungee transition flex items-center gap-2 tracking-wide">
                <i class="fas fa-trash-alt"></i>
                ELIMINAR USUARIO
            </button> -->
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
            ¿Estás seguro de que deseas eliminar al usuario <strong id="delete-user-name" class="text-[#E0007C]"></strong>?
            Esta acción no se puede deshacer.
        </p>
        <div class="flex gap-3 justify-end">
            <button id="cancel-delete" class="btn-outline font-bungee">CANCELAR</button>
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-primary bg-red-600 hover:bg-red-700 font-bungee">ELIMINAR</button>
            </form>
        </div>
    </div>
</div>

<!-- Formulario oculto para eliminación -->
<form id="delete-form-hidden" method="POST" style="display: none;">
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
    
    .badge-ale {
        background: rgba(224, 0, 124, 0.2);
        color: #E0007C;
        border-radius: 2rem;
        padding: 0.25rem 0.75rem;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
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
</style>
@endpush

@push('scripts')
<script>
    let currentUserId = null;
    let currentUserName = null;
    
    function confirmDelete(userId, userName) {
        const modal = document.getElementById('delete-modal');
        const modalContent = document.getElementById('delete-modal-content');
        const userNameSpan = document.getElementById('delete-user-name');
        const deleteForm = document.getElementById('delete-form');
        
        currentUserId = userId;
        currentUserName = userName;
        userNameSpan.textContent = userName;
        deleteForm.action = `/admin/users/${userId}`;
        
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
            currentUserId = null;
            currentUserName = null;
        }, 200);
    }
    
    document.getElementById('cancel-delete')?.addEventListener('click', closeModal);
    
    document.getElementById('delete-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.getElementById('confirm-delete')?.addEventListener('click', function() {
        if (currentUserId) {
            document.getElementById('delete-form').submit();
        }
    });
</script>
@endpush