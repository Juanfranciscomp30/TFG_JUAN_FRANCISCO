<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Music Store - Iniciar sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap y FontAwesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-bg d-flex justify-content-center align-items-center py-4">
        <div class="login-card row no-gutters shadow-lg rounded-lg overflow-hidden">
            <!-- Lado Ilustración -->
            <div class="col-md-6 ilustracion d-none d-md-flex flex-column justify-content-center align-items-center text-center p-4">
                <h1 class="logo-title mb-4">MUSIC STORE</h1>
                <img src="{{ asset('img/instrumentos-login.png') }}" alt="Instrumentos" class="img-fluid mb-2" style="max-height: 270px;">
            </div>
            <!-- Lado Formulario -->
            <div class="col-md-6 bg-white p-5">
                <h2 class="mb-4 font-weight-bold login-title">Iniciar sesión</h2>
                @if (session('login_intentado') && $errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required autofocus>
                        <div class="invalid-feedback">
                            Introduce un correo electrónico válido.
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="password">Contraseña</label>
                            <a href="#" class="forgot-link">¿Olvidaste la contraseña?</a>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent show-password" style="cursor:pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            La contraseña es obligatoria.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block login-btn mt-3">Entrar</button>
                </form>
                <div class="text-center mt-4">
                    <span>¿No tienes cuenta?</span>
                    <a href="{{ route('register.form') }}" class="signup-link">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
