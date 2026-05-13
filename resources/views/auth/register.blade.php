<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Alebringüe · Crear cuenta</title>
  <!-- Google Fonts: Bricolage Grotesque (general) & Bungee (brand) -->
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..28,300;12..28,400;12..28,500;12..28,600;12..28,700;12..28,800&family=Bungee&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #131313; /* 0xFF131313 */
      font-family: 'Bricolage Grotesque', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }

    /* card principal */
    .register-container {
      max-width: 520px;
      width: 100%;
      background: rgba(19, 19, 19, 0.85);
      backdrop-filter: blur(1px);
      border-radius: 2rem;
      padding: 2rem 1.8rem 2.5rem;
      box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(228, 0, 124, 0.15);
    }

    /* encabezado con Bungee */
    .brand-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .brand-name {
      font-family: 'Bungee', cursive;
      font-size: 2.2rem;
      letter-spacing: 0.02em;
      background: linear-gradient(135deg, #E4007C 0%, #E4007C 70%, #ff66b5 100%);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      display: inline-block;
      margin-bottom: 0.35rem;
    }

    .sub-brand {
      font-size: 0.85rem;
      color: #FAF9F6;
      opacity: 0.7;
      font-weight: 500;
      letter-spacing: 0.5px;
    }

    .accent-line {
      width: 70px;
      height: 3px;
      background: #E4007C;
      margin: 0.75rem auto 0;
      border-radius: 10px;
    }

    .auth-header {
      text-align: center;
      margin-bottom: 1.8rem;
    }

    .auth-title {
      font-size: 1.75rem;
      font-weight: 700;
      color: #FAF9F6;
      letter-spacing: -0.3px;
      margin-bottom: 0.5rem;
    }

    .auth-description {
      font-size: 0.95rem;
      color: rgba(250, 249, 246, 0.75);
      font-weight: 450;
    }

    /* formulario */
    .form-group {
      margin-bottom: 1.5rem;
    }

    .input-label {
      display: block;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: #FAF9F6;
      margin-bottom: 0.5rem;
    }

    .input-label span {
      color: #E4007C;
      margin-left: 2px;
    }

    .input-field {
      width: 100%;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(228, 0, 124, 0.35);
      border-radius: 1.2rem;
      padding: 0.85rem 1.2rem;
      font-family: 'Bricolage Grotesque', monospace;
      font-size: 1rem;
      font-weight: 500;
      color: #FAF9F6;
      transition: all 0.25s ease;
      outline: none;
    }

    .input-field:focus {
      border-color: #E4007C;
      box-shadow: 0 0 0 3px rgba(228, 0, 124, 0.25);
      background: rgba(255, 255, 255, 0.1);
    }

    .input-field::placeholder {
      color: rgba(250, 249, 246, 0.4);
      font-weight: 400;
      font-size: 0.9rem;
    }

    /* wrapper para contraseña con botón de mostrar/ocultar */
    .password-wrapper {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: rgba(250, 249, 246, 0.7);
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      padding: 0;
      transition: color 0.2s;
    }

    .toggle-password:hover {
      color: #E4007C;
    }

    /* Botón principal */
    .btn-primary {
      width: 100%;
      background: #E4007C;
      border: none;
      border-radius: 2.5rem;
      padding: 0.9rem 1rem;
      font-family: 'Bricolage Grotesque', sans-serif;
      font-weight: 700;
      font-size: 1.1rem;
      letter-spacing: 0.8px;
      color: #FAF9F6;
      cursor: pointer;
      transition: transform 0.15s ease, background 0.2s, box-shadow 0.2s;
      box-shadow: 0 6px 14px rgba(228, 0, 124, 0.3);
    }

    .btn-primary:hover {
      background: #c2006b;
      transform: scale(0.98);
      box-shadow: 0 4px 10px rgba(228, 0, 124, 0.4);
    }

    .btn-primary:active {
      transform: scale(0.96);
    }

    /* session status (mensajes desde backend) */
    .session-status {
      text-align: center;
      background: rgba(228, 0, 124, 0.12);
      border-left: 3px solid #E4007C;
      padding: 0.65rem;
      border-radius: 1rem;
      margin-bottom: 1.2rem;
      font-size: 0.85rem;
      color: #FAF9F6;
      backdrop-filter: blur(2px);
    }

    /* enlace de login */
    .login-section {
      text-align: center;
      margin-top: 1.8rem;
      font-size: 0.9rem;
      color: rgba(250, 249, 246, 0.7);
    }

    .login-link {
      color: #E4007C;
      font-weight: 700;
      text-decoration: none;
      border-bottom: 1px solid transparent;
      transition: 0.2s;
      margin-left: 0.25rem;
    }

    .login-link:hover {
      color: #ff66b5;
      border-bottom-color: #E4007C;
    }

    @media (max-width: 550px) {
      .register-container {
        padding: 1.5rem;
      }
      .brand-name {
        font-size: 1.8rem;
      }
      .auth-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
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