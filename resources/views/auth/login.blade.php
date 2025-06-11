<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Son Arte - Iniciar sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/SonArte.png') }}">

    <!-- Bootstrap y FontAwesome -->
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
                <h2 class="mb-4 font-weight-bold login-title text-center text-md-left">Iniciar sesión</h2>
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
                        <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}"
                            required autofocus>
                        <div class="invalid-feedback">
                            Introduce un correo electrónico válido.
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="password">Contraseña</label>
                            <a href="#" class="forgot-link" data-bs-toggle="modal" data-bs-target="#modalRecuperar">
                                ¿Olvidaste la contraseña?
                            </a>

                        </div>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control form-control-lg"
                                required>
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

    <div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="modalRecuperarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg">
                <div class="modal-header bg-opal border-0">
                    <h5 class="modal-title" id="modalRecuperarLabel">
                        <i class="fa-solid fa-unlock-keyhole me-2"></i>Restablecer contraseña
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body bg-champagne">
                    <form id="formRecuperar" method="POST" action="{{ route('recuperar.password') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="emailRecuperar" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control rounded-pill shadow-sm" id="emailRecuperar"
                                name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="passwordNueva" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control rounded-pill shadow-sm" id="passwordNueva"
                                name="password" required minlength="6">
                        </div>
                        <div class="mb-3">
                            <label for="passwordRepeat" class="form-label">Repetir contraseña</label>
                            <input type="password" class="form-control rounded-pill shadow-sm" id="passwordRepeat"
                                name="password_confirmation" required minlength="6">
                        </div>
                        <button type="submit"
                            class="btn btn-success w-100 rounded-pill animate__animated animate__pulse">
                            <i class="fa-solid fa-key me-2"></i>Actualizar contraseña
                        </button>
                    </form>
                    <div id="mensajeRecuperar" class="alert mt-3 d-none text-center"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>