<?php
session_start(); // Asegurarse de que la sesión esté activa
$userLoggedIn = isset($_SESSION['user_id']); // Verificar si el usuario está autenticado
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
                    <a href="./questions.php" class="nav-link">
                        <i class="bi bi-question-circle me-2"></i> Questions
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./tags.php" class="nav-link">
                        <i class="bi bi-tags me-2"></i> Tags
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./saves.php" class="nav-link">
                        <i class="bi bi-bookmark me-2"></i> Saves
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

    <div class="container mt-5">
        <h2 class="h4 mb-4">Hacer una Pregunta</h2>
        <form method="POST" action="./logic/crear_pregunta.php">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Escribe un título claro y conciso">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Describe tu problema con detalles"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publicar Pregunta</button>
        </form>
    </div>
    </div>


    <!-- Pie de Página -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>StackOverflow Clone © 2024. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>