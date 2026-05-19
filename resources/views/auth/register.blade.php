<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Alebringüe · Crear cuenta</title>
 @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Google Fonts: Bricolage Grotesque (general) & Bungee (brand) -->
  <link 
    href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..28,300;12..28,400;12..28,500;12..28,600;12..28,700;12..28,800&family=Bungee&display=swap" 
    rel="stylesheet">
</head>
<body class="register-page">
  <div class="top-nav">
  <a href="{{ route('welcome') }}" class="back-link">
    <!-- Ícono flecha -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         width="20" height="20" 
         viewBox="0 0 24 24" 
         fill="none" 
         stroke="currentColor" 
         stroke-width="2" 
         stroke-linecap="round" 
         stroke-linejoin="round">
      <line x1="19" y1="12" x2="5" y2="12"></line>
      <polyline points="12 19 5 12 12 5"></polyline>
    </svg>
    <span>Volver</span>
  </a>
</div>
<div class="register-container">
  <!-- Branding igual que login -->
  <div class="brand-header">
    <div class="brand-name">ALEBRINGÜE</div>
    <div class="sub-brand">únete a la experiencia</div>
    <div class="accent-line"></div>
  </div>

  <!-- Título y descripción -->
  <div class="auth-header">
    <div class="auth-title">Crear cuenta</div>
    <div class="auth-description">Ingresa tus datos para formar parte de Alebringüe</div>
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

  <!-- Formulario de registro con acción real para backend -->
  <form method="POST" action="#" class="flex flex-col gap-5">
    @csrf

    <!-- Nombre completo -->
    <div class="form-group">
      <label class="input-label" for="name">Nombre completo <span>*</span></label>
      <input type="text" id="name" name="name" class="input-field" 
             placeholder="Nombre Apellido" 
             value="{{ old('name') }}"
             autocomplete="name" required autofocus>
    </div>

    <!-- Correo electrónico -->
    <div class="form-group">
      <label class="input-label" for="email">Correo electrónico <span>*</span></label>
      <input type="email" id="email" name="email" class="input-field" 
             placeholder="ejemplo@correo.com" 
             value="{{ old('email') }}"
             autocomplete="email" required>
    </div>

    <!-- Contraseña con botón viewable -->
    <div class="form-group">
      <label class="input-label" for="password">Contraseña <span>*</span></label>
      <div class="password-wrapper">
        <input type="password" id="password" name="password" class="input-field" 
               placeholder="••••••••" autocomplete="new-password" required>
        <button type="button" class="toggle-password toggle-pwd" data-target="password" aria-label="Mostrar contraseña">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
          </svg>
        </button>
      </div>
    </div>

    <!-- Confirmar contraseña con botón viewable -->
    <div class="form-group">
      <label class="input-label" for="password_confirmation">Confirmar contraseña <span>*</span></label>
      <div class="password-wrapper">
        <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" 
               placeholder="••••••••" autocomplete="new-password" required>
        <button type="button" class="toggle-password toggle-confirm" data-target="password_confirmation" aria-label="Mostrar contraseña">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
          </svg>
        </button>
      </div>
    </div>

    <!-- Botón Crear cuenta -->
    <button type="submit" class="btn-primary" data-test="register-user-button">CREAR CUENTA</button>
  </form>

  <!-- Enlace para iniciar sesión (si ya tiene cuenta) -->
  <div class="login-section">
    ¿Ya tienes una cuenta?
    <a href="{{ route('login') }}" class="login-link">Iniciar sesión</a>
  </div>
</div>

<!-- Solo JavaScript para funcionalidad de mostrar/ocultar contraseña (no afecta validación ni envío) -->
<script>
  (function() {
    // Función para manejar toggles de contraseña
    function setupPasswordToggle(buttonSelector, inputId) {
      const toggleBtn = document.querySelector(buttonSelector);
      const passwordInput = document.getElementById(inputId);
      
      if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function() {
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
    setupPasswordToggle('.toggle-confirm', 'password_confirmation');
  })();
</script>
</body>
</html>