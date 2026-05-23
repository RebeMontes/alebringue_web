<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Alebringue') — Alebringue</title>

    {{-- Tailwind CSS via CDN (reemplaza con Vite + npm en producción) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Configuración del tema: paleta idéntica a los tokens Flutter --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bone:       '#FAF9F6',   /* _kBone    */
                        carbon:     '#131313',   /* _kCarbon  */
                        magenta:    '#E0007C',   /* _kMagenta */
                        cyan:       '#00E5FF',   /* _kCyan    */
                        surface:    '#1C1C1C',   /* _kSurface */
                        surface2:   '#262626',   /* _kSurface2*/
                        borderdim:  '#373737',   /* _kBorderDim */
                        textdim:    '#888888',   /* _kTextDim */
                    },
                    fontFamily: {
                        bungee:    ['Bungee', 'cursive'],
                        grotesque: ['Space Grotesk', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    {{-- Google Fonts: Bungee + Space Grotesk (equivalentes a las fuentes del proyecto Flutter) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />

    {{-- Alpine.js para interactividad ligera (stepper de palabras, grabación) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('head')
</head>
<body class="min-h-full bg-carbon text-bone font-grotesque antialiased">

    {{-- ── NAV ───────────────────────────────────────────────────────────────── --}}
    <header class="sticky top-0 z-40 bg-carbon border-b border-borderdim">
        <div class="max-w-2xl mx-auto px-5 h-14 flex items-center justify-between">

            <a href="{{ route('lessons.page') }}"
               class="font-bungee text-xl text-bone tracking-wide leading-none">
                Alebringue
            </a>

            {{-- Botón de racha (equivalente al IconButton de fuego en AppBar Flutter) --}}
            <button class="flex items-center gap-1.5 text-magenta font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                     fill="currentColor">
                    <path d="M12 2C9.8 5.4 8 8.2 8 11a4 4 0 008 0c0-2.8-1.8-5.6-4-9z"/>
                </svg>
                <span>7</span>
            </button>

        </div>
    </header>

    {{-- ── CONTENIDO ─────────────────────────────────────────────────────────── --}}
    <main class="max-w-2xl mx-auto px-5 pb-10">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>