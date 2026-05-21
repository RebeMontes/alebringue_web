@extends('layouts.user')

@section('title', 'Clases - Alebringüe')

@push('styles')
<style>
    .badge-level {
        border-radius: 9999px;
        padding: 0.2rem 0.7rem;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
    }
    .badge-a1  { background: rgba(20,184,166,0.2);   color: #14b8a6; }
    .badge-a2  { background: rgba(0,229,255,0.2);    color: #00E5FF; }
    .badge-b1  { background: rgba(255,171,64,0.2);   color: #FFAB40; }
    .badge-b2  { background: rgba(224,0,124,0.2);    color: #E0007C; }
    .badge-c1  { background: rgba(168,85,247,0.2);   color: #a855f7; }
    .badge-c2  { background: rgba(239,68,68,0.2);    color: #ef4444; }
    .badge-default { background: rgba(107,114,128,0.2); color: #9ca3af; }

    .classroom-card { position: relative; overflow: hidden; }
    .classroom-card::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 4px;
        border-radius: 4px 0 0 4px;
    }
    .accent-pink::before   { background: #E0007C; }
    .accent-cyan::before   { background: #00E5FF; }
    .accent-yellow::before { background: #FFAB40; }
    .accent-purple::before { background: #a855f7; }
    .accent-teal::before   { background: #14b8a6; }

    .join-card {
        background: #1c1c20;
        border: 1px solid rgba(224,0,124,0.2);
        border-radius: 1.25rem;
    }

    .code-input {
        background: #131317;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 0.75rem;
        color: #FAF9F6;
        padding: 0.85rem 1rem 0.85rem 3rem;
        width: 100%;
        font-family: 'Bricolage Grotesque', sans-serif;
        font-size: 1rem;
        letter-spacing: 0.08em;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .code-input:focus {
        border-color: #E0007C;
        box-shadow: 0 0 0 3px rgba(224,0,124,0.18);
    }
    .code-input::placeholder { color: rgba(250,249,246,0.3); letter-spacing: 0.12em; }

    .btn-join {
        background: #00E5FF;
        color: #002025;
        font-family: 'Bungee', cursive;
        font-size: 1rem;
        letter-spacing: 0.08em;
        border: none;
        border-radius: 0.75rem;
        padding: 0.9rem;
        width: 100%;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.15s;
    }
    .btn-join:hover { opacity: 0.9; transform: scale(0.99); }

    .btn-enter {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        border: 1.5px solid currentColor;
        border-radius: 0.65rem;
        padding: 0.5rem 1.1rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        background: transparent;
        transition: background 0.2s;
        text-decoration: none;
    }
    .btn-enter:hover { background: rgba(255,255,255,0.07); }

    .alert-success {
        background: rgba(34,197,94,0.12);
        border: 1px solid rgba(34,197,94,0.3);
        color: #86efac;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
    }
    .alert-error {
        background: rgba(239,68,68,0.12);
        border: 1px solid rgba(239,68,68,0.3);
        color: #fca5a5;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
    }
</style>
@endpush

@section('content')
<div class="max-w-2xl mx-auto space-y-7 pb-8">

    @if (session('success'))
        <div class="alert-success flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Unirse a una clase --}}
    <div class="join-card p-5">
        <div class="flex items-center gap-3 mb-1">
            <div class="w-10 h-10 rounded-xl bg-[#00E5FF] flex items-center justify-center flex-shrink-0">
                <i class="fas fa-plus text-black text-lg"></i>
            </div>
            <h2 class="font-black uppercase text-xl tracking-wide text-ale-text">
                Unirme a una clase
            </h2>
        </div>
        <p class="text-ale-text-dim text-sm mb-4 ml-[52px]">
            Ingresa el código que te compartió tu profesor
        </p>

        <form action="{{ route('classrooms.join') }}" method="POST" class="space-y-3">
            @csrf
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-ale-text-dim">
                    <i class="fas fa-qrcode text-lg"></i>
                </span>
                <input
                    type="text"
                    name="code"
                    class="code-input"
                    placeholder="CÓDIGO-XYZ"
                    value="{{ old('code') }}"
                    autocomplete="off"
                    autocapitalize="characters"
                    spellcheck="false"
                >
            </div>

            @error('code')
                <div class="alert-error flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror

            <button type="submit" class="btn-join">
                UNIRME
            </button>
        </form>
    </div>

    {{-- Salones activos --}}
    <div>
        <div class="flex items-center gap-3 mb-4">
            <h2 class="font-black uppercase text-xl tracking-wide text-ale-text">
                Salones Activos
            </h2>
            <span class="w-8 h-8 rounded-full bg-ale-pink flex items-center justify-center text-white text-sm font-bold">
                {{ $myClassrooms->count() }}
            </span>
        </div>

        @if ($myClassrooms->isEmpty())
            <div class="text-center py-12 px-4 bg-[#1c1c20] rounded-2xl border border-white/5">
                <div class="w-16 h-16 bg-ale-pink/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chalkboard text-ale-pink text-2xl"></i>
                </div>
                <p class="text-ale-text font-semibold mb-1">Aún no tienes clases</p>
                <p class="text-ale-text-dim text-sm">Ingresa el código de tu profesor para unirte a un salón.</p>
            </div>
        @else
            <div class="space-y-4">
                @php
                    $accents   = ['accent-pink','accent-cyan','accent-yellow','accent-purple','accent-teal'];
                    $btnColors = ['#E0007C','#00E5FF','#FFAB40','#a855f7','#14b8a6'];
                @endphp

                @foreach ($myClassrooms as $i => $classroom)
                    @php
                        $accent     = $accents[$i % count($accents)];
                        $btnColor   = $btnColors[$i % count($btnColors)];
                        $levelName = $classroom->level ? strtolower($classroom->level->name) : 'default';

    $levelMap = [
        'a1' => 'a1', 'principiante' => 'a1', 'básico' => 'a1', 'basico' => 'a1',
        'a2' => 'a2', 'elemental' => 'a2',
        'b1' => 'b1', 'pre-intermedio' => 'b1', 'preintermedio' => 'b1',
        'b2' => 'b2', 'intermedio' => 'b2',
        'c1' => 'c1', 'avanzado' => 'c1',
        'c2' => 'c2', 'maestría' => 'c2', 'maestria' => 'c2',
    ];

    $levelBadge = 'badge-' . ($levelMap[$levelName] ?? 'default');
                    @endphp

                    <div class="classroom-card {{ $accent }} bg-[#1c1c20] border border-white/5 rounded-2xl p-5 pl-6">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <h3 class="font-bold text-ale-text leading-snug">{{ $classroom->name }}</h3>
                            @if ($classroom->level)
                                <span class="badge-level {{ $levelBadge }} flex-shrink-0">
                                    {{ strtoupper($classroom->level->name) }}
                                </span>
                            @endif
                        </div>

                        <div class="space-y-1.5 mb-4 text-sm text-ale-text-dim">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-circle w-4 text-center"></i>
                                <span>{{ $classroom->teacher->name ?? 'Profesor' }}</span>
                            </div>
                            @if ($classroom->schedule)
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock w-4 text-center"></i>
                                <span>{{ $classroom->schedule }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('classrooms.enter', $classroom) }}"
                               class="btn-enter"
                               style="color: {{ $btnColor }}; border-color: {{ $btnColor }};">
                                <i class="fas fa-arrow-right-to-bracket"></i>
                                Entrar al aula
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection