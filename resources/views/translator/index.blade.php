@extends('layouts.user')

@section('title', 'Traductor - Àlebríngüe')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-8">

    <!-- Título -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold" style="color: #E0007C; font-family: 'Bungee', cursive;">
            TRADUCTOR
        </h1>
        <p class="text-gray-400 mt-2">Traduce entre Inglés y Español</p>
    </div>

    <!-- Tarjeta del traductor -->
    <div class="rounded-2xl p-6" style="background: #1a1a1a; border: 1px solid #2a2a2a;">
        
        <!-- Selector de dirección -->
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2" style="color: #ffffff;">Dirección:</label>
            <div class="grid grid-cols-2 gap-3">
                <button id="btnEnToEs" onclick="setDirection('en_to_es')" 
                        class="py-2 rounded-xl font-medium transition"
                        style="background: #00E5FF; color: #002025; font-family: 'Bungee', cursive;">
                    Inglés → Español
                </button>
                <button id="btnEsToEn" onclick="setDirection('es_to_en')" 
                        class="py-2 rounded-xl font-medium transition"
                        style="background: #2a2a2a; color: #FFFFFF; border: 1px solid #2a2a2a; font-family: 'Bungee', cursive;">
                    Español → Inglés
                </button>
            </div>
        </div>
        
        <!-- Área de texto a traducir -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2" style="color: #ffffff;">Texto a traducir:</label>
            <textarea id="inputText" rows="4" class="w-full rounded-xl px-4 py-2" 
                      style="background: #0d0d0d; border: 1px solid #2a2a2a; color: #FFFFFF; resize: none;"
                      placeholder="Escribe o pega tu texto aquí..."></textarea>
        </div>
        
        <!-- Botón de traducción -->
        <button onclick="translateText()" class="w-full py-3 rounded-xl font-medium transition mb-6"
                style="background: #00E5FF; color: #002025; font-family: 'Bungee', cursive;">
            <i class="fas fa-language mr-2"></i>
            Traducir
        </button>
        
        <!-- Resultado -->
        <div class="rounded-xl p-4" style="background: #0d0d0d; border: 1px solid #2a2a2a;">
            <div id="resultText" class="text-gray-300 min-h-[100px]">
                Traducción...
            </div>
        </div>
        
    </div>

</div>
@endsection

@push('scripts')
<script>
    let currentDirection = 'en_to_es'; // en_to_es o es_to_en
    
    function setDirection(direction) {
        currentDirection = direction;
        
        const btnEnToEs = document.getElementById('btnEnToEs');
        const btnEsToEn = document.getElementById('btnEsToEn');
        
        if (direction === 'en_to_es') {
            btnEnToEs.style.background = '#00E5FF';
            btnEnToEs.style.color = '#002025';
            btnEsToEn.style.background = '#2a2a2a';
            btnEsToEn.style.color = '#FFFFFF';
            btnEsToEn.style.border = '1px solid #2a2a2a';
        } else {
            btnEsToEn.style.background = '#00E5FF';
            btnEsToEn.style.color = '#002025';
            btnEnToEs.style.background = '#2a2a2a';
            btnEnToEs.style.color = '#FFFFFF';
            btnEnToEs.style.border = '1px solid #2a2a2a';
        }
    }
    
    async function translateText() {
        const text = document.getElementById('inputText').value;
        const resultDiv = document.getElementById('resultText');
        
        if (!text.trim()) {
            resultDiv.innerHTML = '<span style="color: #ff6b6b;">Por favor, escribe algún texto para traducir.</span>';
            return;
        }
        
        resultDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traduciendo...';
        
        try {
            const response = await fetch('{{ route("translator.translate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    text: text,
                    direction: currentDirection
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                const flag = data.target === 'es' ? '🇪🇸' : '🇬🇧';
                resultDiv.innerHTML = `
                    <div class="mb-2">
                        <span class="text-xs" style="color: #00E5FF;">${flag} Traducción:</span>
                    </div>
                    <div class="text-lg">${escapeHtml(data.translated)}</div>
                `;
            } else {
                resultDiv.innerHTML = `<span style="color: #ff6b6b;">Error: ${data.message}</span>`;
            }
        } catch (error) {
            resultDiv.innerHTML = '<span style="color: #ff6b6b;">Error de conexión. Intenta de nuevo.</span>';
        }
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
</script>
@endpush