<?php
session_start(); // Asegurarse de que la sesión esté activa
$userLoggedIn = isset($_SESSION['user_id']); // Verificar si el usuario está autenticado
require './logic/get_pregunta.php'; // Archivo que contiene la lógica de las preguntas
// Obtener detalles de la pregunta
$preguntas = obtenerPreguntas($pdo);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StackOverflow Clone</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">StackOverflow Clone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex me-auto" action="./search.php" method="GET">
                    <input
                        class="form-control me-2"
                        type="search"
                        name="query"
                        placeholder="Buscar preguntas..."
                        aria-label="Buscar">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
                <ul class="navbar-nav ms-auto">
                    <?php if ($userLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Hola, <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger text-white" href="./logic/logout.php">Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./views/login.php">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./views/register.php">Registrarse</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Barra lateral -->
    <div class="sidebar">
        <div class="p-3">
            <!-- Navegación principal -->
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="./index.php" class="nav-link">
                        <i class="bi bi-house-door me-2"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="preguntas.php" class="nav-link">
                        <i class="bi bi-question-circle me-2"></i> Questions
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./tags.php" class="nav-link">
                        <i class="bi bi-tags me-2"></i> Tags
                    </a>
                </li>
                <li class="nav-item">
                    <a href="mis_preguntas.php" class="nav-link">
                        <i class="bi bi-list-task me-2"></i> Mis Preguntas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./users.php" class="nav-link">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Contenedor Principal -->
    <div class="container mt-5">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Preguntas Recientes</h1>
            <a href="add_pregunta.php" class="btn btn-primary">Añadir Pregunta</a>

        </div>

        <!-- Lista de Preguntas -->
        <?php foreach ($preguntas as $pregunta): ?>
            <div class="list-group-item">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-1"><?= htmlspecialchars($pregunta['title'], ENT_QUOTES) ?></h5>
                    <small><?= htmlspecialchars($pregunta['created_at'], ENT_QUOTES) ?></small>
                </div>
                <p class="mb-1"><?= htmlspecialchars($pregunta['description'], ENT_QUOTES) ?></p>
                <small class="text-muted">Publicado por: <?= htmlspecialchars($pregunta['username'], ENT_QUOTES) ?></small>
                <!-- Botón para ver detalles y responder -->
                <a href="ver_pregunta.php?id=<?= $pregunta['id'] ?>" class="btn btn-primary btn-sm mt-2">Responder</a>
            </div>
        <?php endforeach; ?>



    </div>


    <!-- Pie de Página -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>StackOverflow Clone © 2024. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>