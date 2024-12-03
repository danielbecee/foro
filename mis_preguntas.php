<?php
session_start();
$userLoggedIn = isset($_SESSION['user_id']); // Verificar si el usuario está autenticado

if (!isset($_SESSION['user_id'])) {
    header('Location: ./views/login.php');
    exit;
}

require './db/conexion.php';

// Obtener las preguntas del usuario autenticado
$user_id = $_SESSION['user_id'];

$query = "
    SELECT id, title, description, created_at
    FROM questions
    WHERE user_id = ?
    ORDER BY created_at DESC
";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Preguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
                    <a href="./mis_respuestas.php" class="nav-link">
                        <i class="bi bi-tags me-2"></i> Mis Respuestas
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
        <h1 class="h3 mb-4">Mis Preguntas</h1>
        <?php if ($preguntas): ?>
            <?php foreach ($preguntas as $pregunta): ?>
                <div class="list-group-item">
                    <h5><?= htmlspecialchars($pregunta['title'], ENT_QUOTES) ?></h5>
                    <p><?= htmlspecialchars($pregunta['description'], ENT_QUOTES) ?></p>
                    <small class="text-muted">Publicado el <?= htmlspecialchars($pregunta['created_at'], ENT_QUOTES) ?></small>
                    <div class="mt-3">
                        <a href="editar_pregunta.php?id=<?= $pregunta['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar<?= $pregunta['id'] ?>">
                            Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalEliminar<?= $pregunta['id'] ?>" tabindex="-1" aria-labelledby="modalEliminarLabel<?= $pregunta['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEliminarLabel<?= $pregunta['id'] ?>">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar esta pregunta? Esta acción no se puede deshacer.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="eliminar_pregunta.php?id=<?= $pregunta['id'] ?>" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No has publicado preguntas todavía.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>