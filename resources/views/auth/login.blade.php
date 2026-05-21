<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Alebringüe · Iniciar sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Bricolage Grotesque (general) & Bungee (brand) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..28,300;12..28,400;12..28,500;12..28,600;12..28,700;12..28,800&family=Bungee&display=swap"
        rel="stylesheet">
</head>

<body class="login-page">
    <div class="top-nav">
        <a href="{{ route('welcome') }}" class="back-link">
            <!-- Ícono flecha -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Volver</span>
        </a>
    </div>
    <div class="login-container">
        <!-- Branding -->
 <div class="brand-header flex flex-col items-center justify-center w-full">
    <div class="flex items-center justify-center">
        <img 
            src="{{ asset('images/Logo.png') }}" 
            alt="Logo Alebringüe" 
            class="w-auto h-12 md:h-16 object-contain"
            loading="eager"
            decoding="async"
        >
    </div>
    <div class="accent-line mt-4"></div>
</div>
        <!-- Título y descripción -->
        <div class="auth-header">
            <div class="auth-title">Iniciar sesión</div>
            <div class="auth-description">Ingresa tu correo y contraseña para continuar</div>
        </div>

        <!-- Componente para mensajes de sesión (errores, éxito, etc.) -->
        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="session-status" style="background: rgba(228, 0, 124, 0.2);">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <!-- Formulario con acción y método reales para backend -->
        <form method="POST" action="#" class="flex flex-col gap-5">
            @csrf

            <!-- Correo electrónico -->
            <div class="form-group">
                <label class="input-label" for="email">Correo electrónico <span>*</span></label>
                <input type="email" id="email" name="email" class="input-field" placeholder="ejemplo@correo.com"
                    value="{{ old('email') }}" autocomplete="email" required autofocus>
            </div>

            <!-- Contraseña con botón viewable y enlace "¿Olvidaste tu contraseña?" -->
            <div class="form-group">
                <label class="input-label" for="password">Contraseña <span>*</span></label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" class="input-field" placeholder="••••••••"
                        autocomplete="new-password" required>
                    <button type="button" class="toggle-password toggle-pwd" data-target="password"
                        aria-label="Mostrar contraseña">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Recordarme -->
            <div class="checkbox-group">
                <input type="checkbox" id="remember_check" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember_check">Recordarme</label>
            </div>

            <!-- Botón INGRESAR -->
            <button type="submit" class="btn-primary">INGRESAR</button>

        </form>

        <!-- Enlace para Registrase (si ya tiene cuenta) -->
        <div class="register-section">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="register-link">Regístrate</a>
        </div>
    </div>

    <!-- Solo JavaScript para funcionalidad de mostrar/ocultar contraseña (no afecta validación ni envío) -->
    <script>
        (function () {
            function setupPasswordToggle(buttonSelector, inputId) {
                const toggleBtn = document.querySelector(buttonSelector);
                const passwordInput = document.getElementById(inputId);

                if (toggleBtn && passwordInput) {
                    toggleBtn.addEventListener('click', function () {
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        // Cambiar ícono según estado
                        const svg = toggleBtn.querySelector('svg');
                        if (type === 'text') {
                            svg.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
                        } else {
                            svg.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
                        }
                    });
                }
            }

            // Configurar ambos toggles
            setupPasswordToggle('.toggle-pwd', 'password');
        })();
    </script>
</body>

</html>