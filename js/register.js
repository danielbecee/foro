// Validación para cada campo en el evento blur
document.getElementById("username").addEventListener("blur", function () {
    const username = this.value.trim();
    const errorDiv = document.querySelector("#username + .error-message");

    if (!username) {
        errorDiv.textContent = "El campo Nombre de Usuario es obligatorio.";
    } else {
        errorDiv.textContent = ""; // Sin errores
    }
});

document.getElementById("real_name").addEventListener("blur", function () {
    const realName = this.value.trim();
    const errorDiv = document.querySelector("#real_name + .error-message");

    if (!realName) {
        errorDiv.textContent = "El campo Nombre Real es obligatorio.";
    } else {
        errorDiv.textContent = ""; // Sin errores
    }
});

document.getElementById("email").addEventListener("blur", function () {
    const email = this.value.trim();
    const errorDiv = document.querySelector("#email + .error-message");

    if (!email) {
        errorDiv.textContent = "El campo Correo Electrónico es obligatorio.";
    } else {
        errorDiv.textContent = ""; // Sin errores
    }
});

document.getElementById("password").addEventListener("blur", function () {
    const password = this.value.trim();
    const errorDiv = document.querySelector("#password + .error-message");

    if (!password) {
        errorDiv.textContent = "El campo Contraseña es obligatorio.";
    } else {
        errorDiv.textContent = ""; // Sin errores
    }
});

// Prevenir envío si hay campos vacíos
document.getElementById("registerForm").addEventListener("submit", function (event) {
    let hasError = false;

    // Validar cada campo al intentar enviar el formulario
    document.querySelectorAll("input").forEach(input => {
        const errorDiv = input.nextElementSibling;

        if (!input.value.trim()) {
            errorDiv.textContent = `El campo ${input.previousElementSibling.textContent} es obligatorio.`;
            hasError = true;
        } else {
            errorDiv.textContent = ""; // Sin errores
        }
    });

    if (hasError) {
        event.preventDefault(); // Prevenir envío si hay errores
    }
});
