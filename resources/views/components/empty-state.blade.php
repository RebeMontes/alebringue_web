{{--
    Componente: empty-state
    Equivale a los estados vacíos/error de lesson_page.dart

    Props:
      $icon     →  SVG path (d=) o emoji string
      $title    →  Mensaje principal
      $subtitle →  (opcional) Texto de ayuda
      $useEmoji →  (bool, default false) Si true, $icon se renderiza como emoji
--}}
@props([
    'icon'     => '',
    'title'    => '',
    'subtitle' => null,
    'useEmoji' => false,
])

<div class="w-full bg-surface border border-borderdim rounded-2xl
            flex flex-col items-center justify-center gap-3 py-12 px-6 text-center">

    @if ($useEmoji)
        <span class="text-5xl" role="img">{{ $icon }}</span>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" class="w-11 h-11 text-cyan" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
        </svg>
    @endif

    <p class="font-bold text-bone text-base">{{ $title }}</p>

    @if ($subtitle)
        <p class="text-textdim text-sm">{{ $subtitle }}</p>
    @endif

</div>