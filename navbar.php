<?php
session_start(); // Asegurarse de que la sesión esté activa
$userLoggedIn = isset($_SESSION['user_id']); // Verificar si el usuario está autenticado
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">StackOverflow Clone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($userLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hola, <?= htmlspecialchars($_SESSION['username']) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="./logic/logout.php">Cerrar Sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="./index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./views/login.php">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./views/register.php">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="#">Hacer una Pregunta</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
