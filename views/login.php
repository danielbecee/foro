<?php
$userLoggedIn = isset($_SESSION['user_id']); // Verificar si el usuario está autenticado
include('../logic/login.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 0.25em;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">StackOverflow Clone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="./login.php">Iniciar Sesión</a></li>
                <li class="nav-item"><a class="nav-link" href="./register.php">Registrarse</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1>Iniciar Sesión</h1>
    <form id="loginForm" action="../logic/login.php" method="POST">
        <div class="mb-3">
            <label for="identifier" class="form-label">Usuario o Correo Electrónico</label>
            <input 
                type="text" 
                class="form-control" 
                id="identifier" 
                name="identifier" 
                placeholder="Introduce tu usuario o correo" 
                aria-describedby="identifierHelp"
                value="<?= htmlspecialchars($_POST['identifier'] ?? '') ?>">
                
            <div class="error-message"><?= htmlspecialchars($errors['identifier']) ?></div> <!-- Elemento para el error -->
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password" 
                placeholder="Introduce tu contraseña" 
                aria-describedby="passwordHelp">
            <div class="error-message"><?= htmlspecialchars($errors['password']) ?></div> <!-- Elemento para el error -->
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>
<script src="../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
