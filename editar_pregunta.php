<?php
session_start();
$userLoggedIn = isset($_SESSION['user_id']); // Verificar si el usuario está autenticado

if (!isset($_SESSION['user_id'])) {
    header('Location: ./views/login.php');
    exit;
}

require './db/conexion.php';


$pregunta_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

// Verificar que la pregunta pertenece al usuario
$query = "SELECT * FROM questions WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$pregunta_id, $user_id]);
$pregunta = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    $updateQuery = "UPDATE questions SET title = ?, description = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([$title, $description, $pregunta_id]);

    header('Location: mis_preguntas.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pregunta</title>
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
        <h1 class="h3 mb-4">Editar Pregunta</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($pregunta['title'], ENT_QUOTES) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="5" required><?= htmlspecialchars($pregunta['description'], ENT_QUOTES) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
