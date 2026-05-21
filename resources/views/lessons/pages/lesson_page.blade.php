@extends('layouts.user')

@section('title', 'Lecciones')

@section('content')

    <div class="flex flex-col gap-8 pt-7">

        <section class="bg-surface border border-borderdim rounded-2xl p-6">

            <div class="flex items-center gap-3">

                {{-- Ícono de libros (equivale al Container con icon menu_book_rounded) --}}
                <div class="w-11 h-11 rounded-xl bg-cyan flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-carbon" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5
                                 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0
                                 .65.73.45 1 .25 1.45-1.05 3.35-1.4 5-1.4 1.95 0
                                 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0
                                 3.35.35 4.75 1.05.42.21.75-.14.75-.65V6c-.6-.45
                                 -1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7
                                 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2
                                 0 2.4.15 3.5.5v11.5z" />
                    </svg>
                </div>

                {{-- Título + badge --}}
                <div class="flex-1 min-w-0">
                    <p class="font-bungee text-lg text-bone leading-tight truncate">
                        Tu meta
                    </p>
                </div>

                <span class="shrink-0 px-3 py-1.5 bg-magenta rounded-full
                             text-bone text-xs font-bold whitespace-nowrap">
                    2 / 3
                </span>

            </div>

            <p class="mt-3 text-textdim text-sm leading-relaxed">
                Completa una lección más para mantener tu racha activa.
            </p>

            {{-- Barra de progreso → LinearProgressIndicator de Flutter --}}
            <div class="mt-5 h-3.5 bg-surface2 rounded-full overflow-hidden">
                <div class="h-full bg-cyan rounded-full transition-all duration-500" style="width: 66%"></div>
            </div>

            <p class="mt-2 text-right text-cyan text-xs font-bold">
                66% completado
            </p>

        </section>
        <section>

            <div class="flex items-center gap-3 mb-5">
                <h1 class="font-bungee text-xl text-bone tracking-wide flex-1 truncate">
                    Lecciones
                </h1>

                <span class="shrink-0 px-3 py-1 bg-cyan rounded-full
                         text-carbon text-xs font-bold tracking-widest">
                    {{ $lessons->count() }}
                </span>
            </div>

            @if($lessons->isEmpty())

                <div class="bg-surface border border-borderdim rounded-2xl p-10 text-center">
                    <p class="text-bone font-semibold">
                        No hay lecciones disponibles
                    </p>

                    <p class="text-textdim text-sm mt-2">
                        Intenta más tarde.
                    </p>
                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach($lessons as $lesson)

                        <a href="{{ route('lessons.content', $lesson) }}" class="group bg-surface border border-borderdim rounded-2xl p-5
                                      hover:border-cyan transition-all duration-300">

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex-1 min-w-0">

                                    <p class="font-bungee text-lg text-bone truncate">
                                        {{ $lesson->title }}
                                    </p>

                                    <p class="mt-2 text-sm text-textdim line-clamp-3">
                                        {{ $lesson->description }}
                                    </p>

                                </div>

                                <div class="w-11 h-11 rounded-xl bg-cyan/20
                                                flex items-center justify-center shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-cyan" fill="currentColor"
                                        viewBox="0 0 24 24">

                                        <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zm0
                                                     13L3.74 11.5 12 7l8.26 4.5L12 16z" />
                                    </svg>

                                </div>

                            </div>

                            <div class="mt-5 flex items-center justify-between">

                                <span class="px-3 py-1 rounded-full bg-magenta
                                                 text-bone text-xs font-bold">

                                    {{ $lesson->level->name ?? 'Sin nivel' }}

                                </span>

                                <span class="text-cyan text-sm font-semibold
                                                 group-hover:translate-x-1 transition-transform">

                                    Ver →
                                </span>

                            </div>

                        </a>

                    @endforeach

                </div>

            @endif

        </section>
    </div>

@endsection

@push('head')

    <style>
        .skeleton {
            background: linear-gradient(90deg, #1C1C1C 25%, #262626 50%, #1C1C1C 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 1rem;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endpush