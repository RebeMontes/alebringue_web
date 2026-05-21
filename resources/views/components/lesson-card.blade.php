{{--
    Componente: lesson-card
    Equivale a: lesson_card.dart (LessonCard widget)

    Props:
      $lesson  →  instancia de App\Models\Lesson (con relación 'level' cargada)
--}}
@props(['lesson'])

<article class="bg-surface border border-borderdim rounded-2xl p-6 flex flex-col gap-4
                hover:border-cyan/40 transition-colors duration-200">

    {{-- ── Cabecera: título + badge de nivel ─────────────────────────────────── --}}
    <div class="flex items-start justify-between gap-3">

        <h2 class="font-bungee text-xl text-bone leading-tight">
            {{ $lesson->title }}
        </h2>

        @if ($lesson->level)
            <span class="shrink-0 px-3 py-1 rounded-full bg-magenta
                         text-bone text-xs font-bold tracking-wide whitespace-nowrap">
                {{ $lesson->level->name }}
            </span>
        @endif

    </div>

    {{-- ── Descripción ────────────────────────────────────────────────────────── --}}
    <p class="text-textdim text-sm leading-relaxed">
        {{ $lesson->description }}
    </p>

    {{-- ── Separador ──────────────────────────────────────────────────────────── --}}
    <hr class="border-borderdim" />

    {{-- ── CTA ────────────────────────────────────────────────────────────────── --}}
    {{-- Equivale al ElevatedButton "Comenzar lección" de lesson_card.dart --}}
    <a href="{{ route('lessons.show', $lesson) }}"
       class="w-full inline-flex items-center justify-center gap-2
              bg-cyan text-carbon font-bold text-sm rounded-xl py-3.5 px-6
              hover:bg-cyan/90 active:scale-[.98] transition-all duration-150">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
             fill="currentColor">
            <path d="M8 5v14l11-7z"/>
        </svg>
        Comenzar lección
    </a>

</article>