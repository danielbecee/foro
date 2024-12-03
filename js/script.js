document.getElementById("identifier").addEventListener("blur", function () {
    const identifier = this.value.trim();
    const errorDiv = document.querySelector("#identifier + .error-message");

    if (!identifier) {
        errorDiv.textContent = "El campo Usuario o Correo Electrónico es obligatorio.";
    } else {
        errorDiv.textContent = ""; // Sin errores
    }
});

document.getElementById("password").addEventListener("blur", function () {
    const password = this.value;
    const errorDiv = document.querySelector("#password + .error-message");

    if (!password) {
        errorDiv.textContent = "El campo Contraseña es obligatorio.";
    } else {
        errorDiv.textContent = ""; // Sin errores
    }
});

// Prevenir envío si hay errores
document.getElementById("loginForm").addEventListener("submit", function (event) {
    const identifier = document.getElementById("identifier").value.trim();
    const password = document.getElementById("password").value;

    const identifierError = document.querySelector("#identifier + .error-message");
    const passwordError = document.querySelector("#password + .error-message");

    let hasError = false;

    if (!identifier) {
        identifierError.textContent = "El campo Usuario o Correo Electrónico es obligatorio.";
        hasError = true;
    }

    if (!password) {
        passwordError.textContent = "El campo Contraseña es obligatorio.";
        hasError = true;
    }

    if (hasError) {
        event.preventDefault(); // Prevenir envío si hay errores
    }
});
