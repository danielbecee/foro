<?php
session_start();
require './logic/get_pregunta.php'; // Obtiene los detalles de la pregunta y respuestas
$userLoggedIn = isset($_SESSION['user_id']); // Verificar si el usuario está autenticado


$pregunta_id = (int)$_GET['id'];

// Obtener detalles de la pregunta
$pregunta = obtenerPregunta($pregunta_id, $pdo);

// Obtener respuestas de la pregunta
$respuestas = obtenerRespuestas($pregunta_id, $pdo);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pregunta['title'], ENT_QUOTES) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
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
    <div class="container mt-5">
        <h1><?= htmlspecialchars($pregunta['title'], ENT_QUOTES) ?></h1>
        <p><?= htmlspecialchars($pregunta['description'], ENT_QUOTES) ?></p>
        <small class="text-muted">Publicado por: <?= htmlspecialchars($pregunta['username'], ENT_QUOTES) ?> el <?= htmlspecialchars($pregunta['created_at'], ENT_QUOTES) ?></small>
        <hr>

        <!-- Mostrar respuestas existentes -->
        <h2>Respuestas</h2>
        <?php if ($respuestas): ?>
            <div class="list-group">
                <?php foreach ($respuestas as $respuesta): ?>
                    <div class="list-group-item">
                        <p><?= htmlspecialchars($respuesta['content'], ENT_QUOTES) ?></p>
                        <small class="text-muted">Por: <?= htmlspecialchars($respuesta['username'], ENT_QUOTES) ?> el <?= htmlspecialchars($respuesta['created_at'], ENT_QUOTES) ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay respuestas para esta pregunta.</p>
        <?php endif; ?>
        <hr>

        <!-- Formulario para agregar una respuesta -->
        <h3>Agregar una respuesta</h3>
        <form method="POST" action="./logic/crear_respuesta.php">
            <input type="hidden" name="question_id" value="<?= $pregunta_id ?>">
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="5" placeholder="Escribe tu respuesta..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publicar Respuesta</button>
        </form>
    </div>
</body>

</html>