{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('header', 'Panel de Administración')

@section('content')
    <div class="p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Bienvenido al Panel de Administración</h2>
        <p class="text-gray-600">Aquí puedes gestionar usuarios, productos, pedidos y más.</p>
    </div>
@endsection