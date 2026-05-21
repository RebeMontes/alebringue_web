@extends('layouts.user')

@section('title', $lesson->title)

@section('content')

    {{--
    ── CONTEXTO PARA ALPINE ─────────────────────────────────────────────────────
    Inyectamos las palabras de la lección en un objeto JS para que Alpine.js
    pueda manejar el stepper sin necesidad de peticiones AJAX adicionales.
    Equivale al FutureBuilder que resuelve _wordsFuture en el ContentPage.
    ──────────────────────────────────────────────────────────────────────────────── --}}
    <div x-data="lessonPlayer({{ Js::from($lesson->words->map(fn($w) => [
        'id' => $w->id,
        'word' => $w->word,
        'translation' => $w->translation,
        'pronunciation' => $w->pronunciation,
        'audioPath' => $w->audio_path,
    ])) }})" class="flex flex-col gap-6 pt-6">

        {{-- ── CABECERA DE LA LECCIÓN ──────────────────────────────────────────────
        Equivale al LessonAppbar (lesson_appbar.dart)
        ──────────────────────────────────────────────────────────────────────────── --}}
        <header class="flex items-center gap-3">

            <a href="{{ route('lessons.page') }}" class="shrink-0 w-9 h-9 flex items-center justify-center
                                  rounded-xl border border-borderdim text-textdim
                                  hover:border-cyan/50 hover:text-cyan transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <div class="flex-1 min-w-0">
                <h1 class="font-bungee text-lg text-bone leading-tight truncate">
                    {{ $lesson->title }}
                </h1>
                @if ($lesson->level)
                    <p class="text-textdim text-xs mt-0.5">{{ $lesson->level->name }}</p>
                @endif
            </div>

            {{-- Contador de progreso del stepper --}}
            <span class="shrink-0 px-3 py-1.5 bg-surface border border-borderdim
                                     rounded-full text-xs font-bold text-bone whitespace-nowrap"
                x-text="`${currentIndex + 1} / ${words.length}`">
            </span>

        </header>

        {{-- ── ESTADO VACÍO (sin palabras) ─────────────────────────────────────────
        Equivale al estado de lista vacía en LessonContentPage
        ──────────────────────────────────────────────────────────────────────────── --}}
        @if ($lesson->words->isEmpty())
            <x-empty-state icon="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                title="Esta lección no tiene palabras aún" subtitle="El contenido se publicará próximamente." />

        @else

            {{-- ── BARRA DE PROGRESO DEL STEPPER ──────────────────────────────────
            Indica qué tan avanzado está el alumno dentro de la lección.
            ──────────────────────────────────────────────────────────────────────── --}}
            <div class="h-1.5 bg-surface2 rounded-full overflow-hidden">
                <div class="h-full bg-cyan rounded-full transition-all duration-500"
                    :style="`width: ${((currentIndex + 1) / words.length) * 100}%`">
                </div>
            </div>

            {{-- ── TARJETA DE PALABRA ───────────────────────────────────────────────
            Equivale a _buildWordCard() en lesson_content_page.dart.
            El atributo x-show replica el comportamiento de PageView.builder:
            sólo la "página" activa es visible.
            ──────────────────────────────────────────────────────────────────────── --}}
            <template x-for="(word, index) in words" :key="word.id">

                <div x-show="currentIndex === index" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0"
                    class="flex flex-col gap-5">

                    {{-- Indicador textual → "Palabra X de Y" --}}
                    <p class="text-center text-sm font-bold text-bone" x-text="`Palabra ${index + 1} de ${words.length}`">
                    </p>

                    {{-- ── CARD PRINCIPAL ─────────────────────────────────────────
                    Equivale al Card con elevación en _buildWordCard()
                    ──────────────────────────────────────────────────────────────── --}}
                    <div class="bg-surface border border-borderdim rounded-2xl
                                                            px-6 py-8 flex flex-col items-center gap-4 text-center">

                        {{-- Palabra en inglés → Text(word.word, fontSize: 36) --}}
                        <p class="font-bungee text-4xl text-bone leading-tight break-all" x-text="word.word">
                        </p>

                        {{-- Pronunciación → Text(word.pronunciation, italic) --}}
                        <p class="text-lg text-bone/80 italic font-medium" x-text="word.pronunciation">
                        </p>

                        {{-- Traducción (extra que el web añade para contexto inmediato) --}}
                        <p class="text-textdim text-sm" x-text="word.translation"></p>

                        {{-- Botón de audio referencia → IconButton(Icons.volume_up) --}}
                        <button @click="playAudio(word.audioPath)" class="w-14 h-14 rounded-full bg-surface2 border border-borderdim
                                                               flex items-center justify-center text-cyan
                                                               hover:border-cyan/50 hover:bg-cyan/10 active:scale-95
                                                               transition-all duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z" />
                            </svg>
                        </button>

                    </div>

                    {{-- ── MASCOTA DINÁMICA ──────────────────────────────────────────
                    Equivale a _buildMascotDisplay() con los estados:
                    alegre | sorprendido | pensativo | enojado | triste
                    Como no tenemos los SVG assets, usamos emojis con las mismas
                    lógicas de cambio de estado. Reemplaza el texto con <img>
                    cuando agregues tus SVGs a public/images/mascot/.
                    ──────────────────────────────────────────────────────────────── --}}
                    <div class="flex justify-center text-6xl h-20 items-center select-none" x-text="getMascotEmoji(index)"
                        aria-hidden="true">
                    </div>

                    {{-- ── FEEDBACK DE PRONUNCIACIÓN ─────────────────────────────────
                    Equivale a _buildTranscriptionFeedback()
                    ──────────────────────────────────────────────────────────────── --}}

                    {{-- Estado: procesando audio --}}
                    <div x-show="processingIndex === index" class="flex flex-col items-center gap-3 py-4">
                        <div class="w-8 h-8 rounded-full border-2 border-cyan border-t-transparent
                                                                animate-spin"></div>
                        <p class="text-sm font-medium text-textdim">
                            Analizando pronunciación…
                        </p>
                    </div>

                    {{-- Estado: resultado de evaluación --}}
                    <div x-show="evaluations[index] !== undefined && processingIndex !== index" x-transition
                        class="rounded-2xl border p-5 flex flex-col gap-3" :class="getEvaluationClasses(index)">

                        <div class="flex items-center justify-between gap-3">

                            {{-- Texto reconocido --}}
                            <p class="flex-1 text-sm">
                                <span class="font-bold text-bone">Escuché: </span>
                                <span class="font-bold italic" :class="getScoreTextColor(index)" x-text="evaluations[index]?.recognizedText
                                                                              ? `&quot;${evaluations[index].recognizedText}&quot;`
                                                                              : '[Silencio]'">
                                </span>
                            </p>

                            {{-- Badge de porcentaje --}}
                            <span class="shrink-0 px-3.5 py-1 rounded-full text-xs font-bold text-bone"
                                :class="getScoreBadgeColor(index)"
                                x-text="`${Math.round(evaluations[index]?.accuracyScore ?? 0)}%`">
                            </span>

                        </div>

                        <hr class="border-borderdim" />

                        {{-- Diagnóstico fonético --}}
                        <p class="text-sm text-bone leading-relaxed" x-text="evaluations[index]?.diagnosticFeedback">
                        </p>

                        {{-- Badge de fuente (servidor / local) --}}
                        <p class="text-center text-xs text-textdim" x-text="evaluations[index]?.source === 'remote'
                                                                    ? '☁️ Procesado en servidor'
                                                                    : '⚡ Motor local (Web Speech API)'">
                        </p>

                    </div>

                    {{-- ── BOTÓN DE GRABACIÓN ────────────────────────────────────────
                    Equivale a _buildRecordButton()
                    Alterna entre "Grabar" y "Detener" igual que en Flutter.
                    Usa la Web Speech API (SpeechRecognition) disponible en
                    Chrome / Edge. Firefox no la soporta nativamente.
                    ──────────────────────────────────────────────────────────────── --}}
                    <div class="flex justify-center">
                        <button @click="toggleRecording(index, word)"
                            :disabled="processingIndex !== null && processingIndex !== index" class="inline-flex items-center gap-2.5 font-bold text-sm rounded-full
                                                               py-3.5 px-8 transition-all duration-150 active:scale-[.97]
                                                               disabled:opacity-40 disabled:cursor-not-allowed" :class="recordingIndex === index
                                                                    ? 'bg-magenta text-bone shadow-lg shadow-magenta/30'
                                                                    : 'bg-cyan text-carbon hover:bg-cyan/90'">

                            {{-- Ícono dinámico: mic / stop --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path x-show="recordingIndex !== index"
                                    d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm-1-9c0-.55.45-1 1-1s1 .45 1 1v6c0 .55-.45 1-1 1s-1-.45-1-1V5zm6 6c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z" />
                                <path x-show="recordingIndex === index" d="M6 6h12v12H6z" />
                            </svg>

                            <span x-text="recordingIndex === index
                                                                        ? 'Detener grabación'
                                                                        : 'Grabar respuesta'">
                            </span>

                        </button>
                    </div>

                    {{-- ── NAVEGACIÓN ENTRE PALABRAS ─────────────────────────────────
                    Equivale al PageView swipe en Flutter.
                    Botones anterior / siguiente visibles en web para mayor claridad.
                    ──────────────────────────────────────────────────────────────── --}}
                    <div class="flex items-center justify-between gap-4 pt-2">

                        <button @click="prev()" :disabled="currentIndex === 0" class="flex items-center gap-1.5 text-textdim text-sm font-medium
                                                                   disabled:opacity-30 disabled:cursor-not-allowed
                                                                   hover:text-bone transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            Anterior
                        </button>

                        {{-- Puntos indicadores de posición --}}
                        <div class="flex gap-1.5">
                            <template x-for="(w, i) in words" :key="i">
                                <div class="rounded-full transition-all duration-300" :class="i === currentIndex
                                                                             ? 'w-4 h-2 bg-cyan'
                                                                             : 'w-2 h-2 bg-borderdim'">
                                </div>
                            </template>
                        </div>

                        <button @click="next()" :disabled="currentIndex === words.length - 1" class="flex items-center gap-1.5 text-textdim text-sm font-medium
                                                                   disabled:opacity-30 disabled:cursor-not-allowed
                                                                   hover:text-bone transition-colors">
                            Siguiente
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                    </div>

                </div>
            </template>

        @endif

    </div>

@endsection

{{-- ── ALPINE.JS COMPONENT ──────────────────────────────────────────────────────
Contiene toda la lógica de interactividad que en Flutter estaba distribuida
en los métodos del State (_startRecording, _stopAndSendRecording,
_playReferenceAudio, _buildMascotDisplay, _evaluatePronunciation, etc.)
──────────────────────────────────────────────────────────────────────────────── --}}
@push('scripts')
    <script>
        /**
         * lessonPlayer(words)
         *
         * Componente Alpine.js que replica la lógica de _LessonContentPageState.
         *
         * @param {Array} words  Lista de palabras inyectada desde Blade via Js::from()
         */
        function lessonPlayer(words) {
            return {

                // ── Estado ───────────────────────────────────────────────────────────
                words,
                currentIndex: 0,
                recordingIndex: null,   // equivale a _recordingWordIndex
                processingIndex: null,  // equivale a _processingWordIndex
                evaluations: {},     // equivale a Map<int, PronunciationEvaluation>

                // Web Speech API
                recognition: null,

                // AudioContext para reproducir el audio de referencia
                audioContext: null,

                // ── Lifecycle ────────────────────────────────────────────────────────
                init() {
                    // Precalentar el reconocedor si el navegador lo soporta
                    // Equivale a _transcriptionService.preWarmLocalModel()
                    if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
                        const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
                        this.recognition = new SR();
                        this.recognition.lang = 'en-US';
                        this.recognition.continuous = false;
                        this.recognition.interimResults = false;
                        this.recognition.maxAlternatives = 1;
                    }
                },

                // ── Navegación ───────────────────────────────────────────────────────
                // Equivalen al PageController.nextPage() / previousPage() de Flutter

                next() {
                    if (this.currentIndex < this.words.length - 1) {
                        this.currentIndex++;
                    }
                },

                prev() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                    }
                },

                // ── Reproducción de audio referencia ─────────────────────────────────
                // Equivale a _playReferenceAudio(audioPath) de Flutter

                playAudio(audioPath) {
                    if (!audioPath) return;

                    const supabaseUrl = '{{ config("services.supabase.url") }}';
                    const bucket = '{{ config("services.supabase.bucket") }}';

                    const audioUrl =
                        `${supabaseUrl}/storage/v1/object/public/${bucket}/${audioPath}`;

                    const audio = new Audio(audioUrl);

                    audio.play().catch(err => {
                        console.warn('[lessonPlayer] Audio error:', err);
                    });
                },
                // ── Grabación / Reconocimiento de voz ─────────────────────────────────
                // Equivale a _startRecording() + _stopAndSendRecording()
                // Usa la Web Speech API en lugar de el plugin `record` de Flutter.

                toggleRecording(wordIndex, word) {
                    if (this.recordingIndex === wordIndex) {
                        this.stopRecording(wordIndex, word);
                    } else {
                        this.startRecording(wordIndex, word);
                    }
                },

                startRecording(wordIndex, word) {
                    if (!this.recognition) {
                        alert('Tu navegador no soporta reconocimiento de voz. Prueba en Chrome o Edge.');
                        return;
                    }

                    // Limpiar evaluación previa para este índice
                    delete this.evaluations[wordIndex];
                    this.recordingIndex = wordIndex;
                    this.recognition.onresult = (event) => {

                        const transcript = event.results[0][0].transcript;

                        const confidence = event.results[0][0].confidence;

                        console.log('[TRANSCRIPCIÓN]');
                        console.log('Texto:', transcript);
                        console.log('Confianza:', confidence);

                        this.processingIndex = wordIndex;

                        this.recordingIndex = null;

                        this.$nextTick(() => {
                            this.evaluatePronunciation(
                                wordIndex,
                                word,
                                transcript,
                                confidence
                            );
                        });
                    };

                    this.recognition.onerror = (event) => {
                        this.recordingIndex = null;
                        this.processingIndex = null;
                        console.error('SpeechRecognition ERROR');
                        console.log(event);
                        console.log('error:', event.error);
                        console.log('message:', event.message);
                    };

                    this.recognition.onend = () => {
                        if (this.recordingIndex === wordIndex) {
                            this.recordingIndex = null;
                        }
                    };

                    this.recognition.start();
                },

                stopRecording(wordIndex, word) {
                    if (this.recognition) {
                        this.recognition.stop();
                    }
                    this.recordingIndex = null;
                },

                // ── Evaluación de pronunciación ───────────────────────────────────────
                // Equivale a la lógica de _stopAndSendRecording() después de llamar a
                // _transcriptionService.transcribe(): compara recognizedLower vs targetLower
                // y genera el PronunciationEvaluation con feedback fonético.

                evaluatePronunciation(wordIndex, word, transcript, confidence) {
                    const targetLower = word.word.toLowerCase().replace(/[^\w\s]/g, '').trim();
                    const recognizedLower = transcript.toLowerCase().replace(/[^\w\s]/g, '').trim();

                    let accuracyScore = 0;
                    let diagnosticFeedback = '';
                    let isPerfect = false;

                    if (recognizedLower === targetLower) {
                        isPerfect = true;
                        accuracyScore = (confidence ?? 1.0) * 100;

                        diagnosticFeedback = accuracyScore >= 85
                            ? '¡Excelente pronunciación! Fluidez y acento nativos impecables.'
                            : '¡Se entendió bien! Sin embargo, intenta vocalizar con mayor potencia de aire.';

                    } else if (!recognizedLower) {
                        accuracyScore = 0;
                        diagnosticFeedback = 'No detectamos tu voz. Acércate un poco más al micrófono e inténtalo de nuevo.';

                    } else {
                        accuracyScore = 35;

                        if (targetLower.startsWith('s') && recognizedLower.startsWith('es')) {
                            diagnosticFeedback = `Evita agregar el sonido "E" fantasma al inicio. En inglés, palabras como "${word.word}" empiezan con silbido de "S" directo, no es "es…".`;
                        } else if (targetLower.includes('v') && recognizedLower.includes('b')) {
                            diagnosticFeedback = 'Cuidado con el sonido "V". Es labiodental: muerde suavemente tu labio inferior con los dientes superiores.';
                        } else if (targetLower.includes('sh') && recognizedLower.includes('ch')) {
                            diagnosticFeedback = 'El sonido "SH" debe ser liso y suave como pidiendo silencio ("shhh"), no la "CH" seca del español.';
                        } else if (targetLower.startsWith('h') && recognizedLower.startsWith('j')) {
                            diagnosticFeedback = 'La "H" en inglés suena como un suspiro suave exhalando aire desde la garganta, no nuestra "J" fuerte.';
                        } else {
                            diagnosticFeedback = `Pronunciaste algo similar a "${transcript}". Escucha la referencia de arriba y fíjate en el movimiento de la boca.`;
                        }
                    }

                    // Guardar evaluación de forma reactiva para Alpine
                    this.evaluations = {
                        ...this.evaluations,
                        [wordIndex]: {
                            recognizedText: transcript,
                            accuracyScore,
                            diagnosticFeedback,
                            isPerfect,
                            source: 'local',   // Web Speech API es procesamiento local/cloud del navegador
                        }
                    };

                    this.processingIndex = null;
                },

                // ── Mascota dinámica ───────────────────────────────────────────────────
                // Equivale a _buildMascotDisplay(). Devuelve el emoji según el estado,
                // replicando exactamente la lógica de selección de mascotAsset de Flutter.
                // Cuando tengas los SVGs, sustituye los emojis por rutas:
                //   alegre.svg | sorprendido.svg | pensativo.svg | enojado.svg | triste.svg

                getMascotEmoji(index) {
                    const isRecording = this.recordingIndex === index;
                    const isProcessing = this.processingIndex === index;
                    const evaluation = this.evaluations[index];

                    if (isRecording) return '😮';  // sorprendido.svg — Escuchando atentamente
                    if (isProcessing) return '🤔';  // pensativo.svg   — Analizando fonemas

                    if (evaluation) {
                        if (evaluation.isPerfect && evaluation.accuracyScore >= 85) return '😄'; // alegre.svg   — ¡Perfecto!
                        if (evaluation.accuracyScore >= 60) return '🤔'; // pensativo.svg — Aceptable
                        if (evaluation.accuracyScore === 0) return '😠'; // enojado.svg  — Sin voz
                        return '😢';                                                              // triste.svg   — Error fonético
                    }

                    return '😊'; // alegre.svg — Estado pasivo por defecto
                },

                // ── Helpers de estilos reactivos (clases Tailwind) ────────────────────

                getEvaluationClasses(index) {
                    const ev = this.evaluations[index];
                    if (!ev) return 'bg-surface border-borderdim';
                    if (ev.isPerfect && ev.accuracyScore >= 85) return 'bg-carbon border-cyan/50';
                    if (ev.isPerfect) return 'bg-bone/5 border-amber-400/50';
                    return 'bg-surface border-borderdim';
                },

                getScoreTextColor(index) {
                    const ev = this.evaluations[index];
                    if (!ev) return 'text-bone';
                    if (ev.isPerfect && ev.accuracyScore >= 85) return 'text-cyan';
                    if (ev.isPerfect) return 'text-amber-400';
                    return 'text-magenta';
                },

                getScoreBadgeColor(index) {
                    const ev = this.evaluations[index];
                    if (!ev) return 'bg-magenta';
                    if (ev.isPerfect && ev.accuracyScore >= 85) return 'bg-cyan !text-carbon';
                    if (ev.isPerfect) return 'bg-amber-400 !text-carbon';
                    return 'bg-magenta';
                },
            };
        }
    </script>
@endpush