<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Son Arte - Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/SonArte.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-bg d-flex justify-content-center align-items-center py-4" style="min-height: 100vh;">
        <div class="login-card row no-gutters shadow-lg rounded-lg overflow-hidden mx-1">
            <div
                class="col-md-6 ilustracion d-none d-md-flex flex-column justify-content-center align-items-center text-center p-4">
                <h1 class="logo-title mb-4">SON ARTE</h1>
                <img src="{{ asset('images/SonArte.png') }}" alt="Instrumentos" class="img-fluid mb-2"
                    style="max-height: 220px;">
            </div>
            <div class="col-md-6 bg-white p-5 d-flex flex-column justify-content-center">
                <h2 class="mb-4 font-weight-bold login-title text-center text-md-left">Registrar nuevo usuario</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="nombre"><i class="fas fa-user"></i> Nombre</label>
                        <input type="text" name="nombre" class="form-control form-control-lg"
                            value="{{ old('nombre') }}" required minlength="3">
                        <div class="invalid-feedback">
                            El nombre es obligatorio (mínimo 3 caracteres).
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Correo electrónico</label>
                        <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}"
                            required>
                        <div class="invalid-feedback">
                            Introduce un correo electrónico válido.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                required minlength="8">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent show-password" style="cursor:pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            La contraseña es obligatoria (mínimo 8 caracteres).
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation"><i class="fas fa-lock"></i> Confirmar contraseña</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control form-control-lg" required minlength="8">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent show-password" style="cursor:pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="password-confirm-error">
                            Debes repetir la contraseña correctamente.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block login-btn mt-3">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </button>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="signup-link">
                        <i class="fas fa-sign-in-alt"></i> ¿Ya tienes una cuenta? Inicia sesión aquí
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/register.js') }}"></script>
</body>

</html>