<?php
session_start();
require '../db/conexion.php';

if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
    header('Location: ../index.php'); // Redirige a la página principal si no hay búsqueda
    exit;
}

$query = trim($_GET['query']);
$query = "%$query%"; // Agrega comodines para la búsqueda en SQL

// Buscar preguntas por título
$preguntas_query = "
    SELECT q.id, q.title, q.description, q.created_at, u.username
    FROM questions q
    JOIN users u ON q.user_id = u.id
    WHERE q.title LIKE ?
    ORDER BY q.created_at DESC
";
$stmt = $pdo->prepare($preguntas_query);
$stmt->execute([$query]);
$preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar usuarios por nombre o nombre real
$usuarios_query = "
    SELECT id, username, real_name
    FROM users
    WHERE username LIKE ? OR real_name LIKE ?
";
$stmt = $pdo->prepare($usuarios_query);
$stmt->execute([$query, $query]);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">StackOverflow Clone</a>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="h3">Resultados de Búsqueda</h1>

    <!-- Resultados de Preguntas -->
    <div class="mt-4">
        <h2>Preguntas</h2>
        <?php if ($preguntas): ?>
            <ul class="list-group">
                <?php foreach ($preguntas as $pregunta): ?>
                    <li class="list-group-item">
                        <h5><?= htmlspecialchars($pregunta['title'], ENT_QUOTES) ?></h5>
                        <p><?= htmlspecialchars($pregunta['description'], ENT_QUOTES) ?></p>
                        <small class="text-muted">Publicado por <?= htmlspecialchars($pregunta['username'], ENT_QUOTES) ?> el <?= htmlspecialchars($pregunta['created_at'], ENT_QUOTES) ?></small>
                        <br>
                        <a href="../ver_pregunta.php?id=<?= $pregunta['id'] ?>" class="btn btn-primary btn-sm mt-2">Ver Pregunta</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron preguntas relacionadas con tu búsqueda.</p>
        <?php endif; ?>
    </div>

    <!-- Resultados de Usuarios -->
    <div class="mt-4">
        <h2>Usuarios</h2>
        <?php if ($usuarios): ?>
            <ul class="list-group">
                <?php foreach ($usuarios as $usuario): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($usuario['username'], ENT_QUOTES) ?></strong>
                        <p><?= htmlspecialchars($usuario['real_name'], ENT_QUOTES) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron usuarios relacionados con tu búsqueda.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
