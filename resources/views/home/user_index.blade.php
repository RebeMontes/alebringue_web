@extends('layouts.user')

@section('title', 'Mi Aprendizaje - Alebringüe')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">

    <!-- Título principal ALEBRINGÜE -->
    <div class="flex flex-col items-center justify-center mb-8">
    
    <img 
        src="{{ asset('images/Logo.png') }}" 
        alt="Texto Alebringüe" 
        class="w-auto h-36 sm:h-40 md:h-44 object-contain"
        loading="eager"
        decoding="async"
    >

    <img 
        src="{{ asset('images/alebringue_logo.png') }}" 
        alt="Mascota Alebringüe" 
        class="w-auto h-24 sm:h-28 md:h-32 object-contain -mt-8 sm:-mt-10 md:-mt-12" 
        loading="eager"
        decoding="async"
    >

</div>

    <!-- Saludo principal -->
    <div class="mb-8 text-center sm:text-left">
        <h2 class="text-3xl font-bold" style="color: #FFFFFF; font-family: 'Bungee', cursive;">
            ¡HOLA, {{ strtoupper($user->name) }}!
        </h2>
        <p class="text-xl mt-2" style="color: #00E5FF; font-family: 'Bungee', cursive;">
            ¿Qué vamos a aprender hoy?
        </p>
    </div>

    <!-- RACHA ACTUAL -->
    <div class="rounded-2xl p-6 mb-8" style="background: #1a1a1a; border: 1px solid #2a2a2a;">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="text-lg font-semibold" style="color: #FFFFFF; font-family: 'Bungee', cursive;">
                    RACHA ACTUAL
                </h3>
                <p class="text-4xl font-bold mt-1" id="streak-days" style="color: #E0007C;">2 días</p>
                <p class="text-sm mt-2" style="color: #888888;">
                    Mantén tu progreso activo estudiando todos los días.
                </p>
            </div>
        </div>

        <!-- Días de la semana -->
        <div class="grid grid-cols-7 gap-2 sm:gap-3 mt-6 mb-6">
            @php
                $days = ['LUN', 'MAR', 'MIÉ', 'JUE', 'VIE', 'SÁB', 'DOM'];
            @endphp

            @foreach($days as $index => $day)
                <div class="rounded-xl p-2 sm:p-3 text-center day-box transition" data-day="{{ $index }}" style="background: #0d0d0d; border: 1px solid #2a2a2a;">
                    <div class="font-bold text-xs sm:text-sm mb-1" style="color: #FFFFFF;">{{ $day }}</div>
                    <i class="fas fa-circle text-xs"></i>
                </div>
            @endforeach
        </div>

        <!-- Mensaje motivacional -->
        <div class="mt-4 p-3 rounded-xl text-center" style="background: rgba(228, 0, 124, 0.08); border: 1px solid rgba(228, 0, 124, 0.2);">
            <p class="text-sm" id="motivational-message" style="color: #AAAAAA;">
                ¡Sigue así! Completa 3 días más para desbloquear una racha de 5 días.
            </p>
        </div>

        <!-- Mascota dinámica (Bringüí) -->
        <div class="flex flex-col items-center mt-6">
            <div id="mascota-imagen"></div>
            <p id="mascota-mensaje" class="text-sm mt-3 font-medium text-center" style="color: #888888;"></p>
        </div>
    </div>

    <!-- Tarjeta de presentación de Bringui -->
    <div class="rounded-2xl p-6 text-center" style="background: #1a1a1a; border: 1px solid #2a2a2a;">
        <h3 class="text-xl font-bold mb-2" style="color: #00E5FF; font-family: 'Bungee', cursive;">
            TE PRESENTAMOS A
        </h3>
        <h2 class="text-3xl font-bold mb-8" style="color: #E0007C; font-family: 'Bungee', cursive;">
            ¡BRINGÜI!
        </h2>
        
        <!-- Grid de expresiones optimizado para móviles y pantallas grandes -->
        <div class="grid grid-cols-2 xs:grid-cols-3 sm:grid-cols-5 gap-4 max-w-3xl mx-auto justify-center items-center">
            
            <!-- Imagen 1: Triste -->
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl flex items-center justify-center" 
                     style="background: #0d0d0d; border: 3px solid #00E5FF;">
                    <img src="{{ asset('images/triste.png') }}" alt="Bringui Triste" 
                         class="w-16 h-16 sm:w-20 sm:h-20 object-contain" 
                         onerror="this.src='https://via.placeholder.com/80?text=😢'">
                </div>
                <span class="text-xs mt-2 text-gray-500 font-semibold">Triste</span>
            </div>
            
            <!-- Imagen 2: Sorprendido -->
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl flex items-center justify-center" 
                     style="background: #0d0d0d; border: 3px solid #00E5FF;">
                    <img src="{{ asset('images/sorprendido.png') }}" alt="Bringui Sorprendido" 
                         class="w-16 h-16 sm:w-20 sm:h-20 object-contain" 
                         onerror="this.src='https://via.placeholder.com/80?text=😲'">
                </div>
                <span class="text-xs mt-2 text-gray-500 font-semibold">Sorprendido</span>
            </div>
            
            <!-- Imagen 3: Feliz -->
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl flex items-center justify-center" 
                     style="background: #0d0d0d; border: 3px solid #00E5FF;">
                    <img src="{{ asset('images/alegre.png') }}" alt="Bringui Feliz" 
                         class="w-16 h-16 sm:w-20 sm:h-20 object-contain" 
                         onerror="this.src='https://via.placeholder.com/80?text=😊'">
                </div>
                <span class="text-xs mt-2 text-gray-500 font-semibold">Alegre</span>
            </div>

            <!-- Imagen 4: Enojado -->
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl flex items-center justify-center" 
                     style="background: #0d0d0d; border: 3px solid #00E5FF;">
                    <img src="{{ asset('images/enojado.png') }}" alt="Bringui Enojado" 
                         class="w-16 h-16 sm:w-20 sm:h-20 object-contain" 
                         onerror="this.src='https://via.placeholder.com/80?text=😠'">
                </div>
                <span class="text-xs mt-2 text-gray-500 font-semibold">Enojado</span>
            </div>

            <!-- Imagen 5: Pensativo -->
            <div class="flex flex-col items-center col-span-2 sm:col-span-1 mt-2 sm:mt-0">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl flex items-center justify-center" 
                     style="background: #0d0d0d; border: 3px solid #00E5FF;">
                    <img src="{{ asset('images/pensativo.png') }}" alt="Bringui Pensativo" 
                         class="w-16 h-16 sm:w-20 sm:h-20 object-contain" 
                         onerror="this.src='https://via.placeholder.com/80?text=🤔'">
                </div>
                <span class="text-xs mt-2 text-gray-500 font-semibold">Pensativo</span>
            </div>
        </div>
        
        <p class="text-sm max-w-md mx-auto mt-8 pt-4 border-t" style="color: #888888; border-color: #2a2a2a;">
            🎯 Bringüi es tu compañero de pronunciación.<br>
            Mientras más días practiques, más feliz se pondrá.
        </p>
    </div>

</div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bungee&display=swap');
    
    body {
        background-color: #131313 !important;
    }
    
    .day-box {
        transition: all 0.3s ease;
    }
    
    .day-today {
        background: #E0007C !important;
        border-color: #E0007C !important;
    }
    
    .day-today i {
        color: #FFFFFF !important;
    }
    
    .day-past {
        background: #2a2a2a !important;
        border-color: #E0007C !important;
    }
    
    .day-past i {
        color: #E0007C !important;
    }
    
    .day-future {
        background: #0d0d0d !important;
        border-color: #2a2a2a !important;
    }
    
    .day-future i {
        color: #444444 !important;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .mascota-bounce {
        animation: bounce 0.6s ease-in-out;
    }
</style>
@endpush

@push('scripts')
<script>
    (function() {
        const mascotas = {
            triste: {
                imagen: '{{ asset("images/triste.png") }}',
                mensajes: [
                    '🎤 ¡Ánimo! Practica tu pronunciación hoy',
                    '🗣️ Cada día cuenta para sonar como nativo',
                    '📢 ¡Empieza hoy! Di "Hello" con confianza'
                ]
            },
            sorprendido: {
                imagen: '{{ asset("images/sorprendido.png") }}',
                mensajes: [
                    '😲 ¡Wow! Tu pronunciación está mejorando',
                    '🎯 ¡Sigue así! Los sonidos cada vez salen mejor',
                    '🌟 ¡Increíble progreso! El acento nativo se acerca'
                ]
            },
            feliz: {
                imagen: '{{ asset("images/alegre.png") }}',
                mensajes: [
                    '🇬🇧 ¡Eres increíble! Suenas como un nativo',
                    '🏆 ¡Racha impresionante! Tu acento es perfecto',
                    '🎉 ¡Maestro de la pronunciación!'
                ]
            }
        };
        
        function getRandomMessage(messages) {
            return messages[Math.floor(Math.random() * messages.length)];
        }
        
        function getMascotaByRacha(racha) {
            if (racha <= 1) return mascotas.triste;
            if (racha >= 2 && racha <= 4) return mascotas.sorprendido;
            return mascotas.feliz;
        }
        
        function updateMascota(racha) {
            const mascota = getMascotaByRacha(racha);
            const container = document.getElementById('mascota-imagen');
            const mensajeContainer = document.getElementById('mascota-mensaje');
            
            if (container) {
                container.innerHTML = `
                    <div class="flex flex-col items-center mascota-bounce">
                        <img src="${mascota.imagen}" alt="Bringüí" class="w-32 h-32 object-contain drop-shadow-lg"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div style="display: none;" class="text-6xl">
                            ${mascota === mascotas.triste ? '😢' : (mascota === mascotas.sorprendido ? '😲' : '😊')}
                        </div>
                    </div>
                `;
            }
            if (mensajeContainer) {
                mensajeContainer.innerText = getRandomMessage(mascota.mensajes);
            }
        }
        
        const hoy = new Date();
        const diaSemana = hoy.getDay();
        let diaActualAjustado = diaSemana === 0 ? 6 : diaSemana - 1;
        let racha = diaActualAjustado + 1;
        
        const dias = document.querySelectorAll('.day-box');
        dias.forEach((dia, index) => {
            dia.classList.remove('day-today', 'day-past', 'day-future');
            if (index === diaActualAjustado) {
                dia.classList.add('day-today');
                const icono = dia.querySelector('i');
                if (icono) icono.className = 'far fa-circle text-xs';
            } 
            else if (index < diaActualAjustado) {
                dia.classList.add('day-past');
                const icono = dia.querySelector('i');
                if (icono) icono.className = 'fas fa-check-circle text-xs';
            } 
            else {
                dia.classList.add('day-future');
                const icono = dia.querySelector('i');
                if (icono) icono.className = 'far fa-clock text-xs';
            }
        });
        
        const streakDays = document.getElementById('streak-days');
        if (streakDays) streakDays.innerText = racha + ' días';
        
        updateMascota(racha);
        
        const msgDiv = document.getElementById('motivational-message');
        if (msgDiv) {
            if (racha < 3) {
                msgDiv.innerText = `¡Sigue así! Completa ${3 - racha} día(s) más para desbloquear una racha de 5 días.`;
            } else if (racha < 5) {
                msgDiv.innerText = `¡Sigue así! Completa ${5 - racha} día(s) más para desbloquear una racha de 5 días.`;
            } else {
                msgDiv.innerText = '🌟 ¡Increíble! Has superado los 5 días. ¡Sigue así!';
            }
        }
    })();
</script>
@endpush