//Validacion con boostrap
(function () {
    'use strict';
    var forms = document.getElementsByClassName('needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();

// Mostrar/ocultar contraseña en el formulario de login
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.show-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});

//Validacion contraseñas del recuperar contraseña
document.getElementById('formRecuperar').addEventListener('submit', function(e) {
    const pass1 = document.getElementById('passwordNueva').value;
    const pass2 = document.getElementById('passwordRepeat').value;
    const mensaje = document.getElementById('mensajeRecuperar');
    mensaje.classList.add('d-none');
    mensaje.classList.remove('alert-success', 'alert-danger', 'animate__fadeInDown');

    if (pass1 !== pass2) {
        e.preventDefault();
        mensaje.textContent = "Las contraseñas no coinciden.";
        mensaje.classList.remove('d-none');
        mensaje.classList.add('alert', 'alert-danger', 'animate__animated', 'animate__fadeInDown');
    }
});
