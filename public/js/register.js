(function () {
    "use strict";
    var forms = document.getElementsByClassName("needs-validation");

    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                // Comprobación de contraseñas iguales
                var password = document.getElementById("password").value;
                var passwordConfirmation = document.getElementById(
                    "password_confirmation"
                ).value;
                var passwordConfirmInput = document.getElementById(
                    "password_confirmation"
                );
                var passwordConfirmError = document.getElementById(
                    "password-confirm-error"
                );

                if (password !== passwordConfirmation) {
                    passwordConfirmInput.classList.add("is-invalid");
                    passwordConfirmError.style.display = "block";
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    passwordConfirmInput.classList.remove("is-invalid");
                    passwordConfirmError.style.display = "none";
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add("was-validated");
            },
            false
        );
    });
})();

document.querySelectorAll(".show-password").forEach((btn) => {
    btn.addEventListener("click", function () {
        const input = this.closest(".input-group").querySelector("input");
        const icon = this.querySelector("i");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
});
