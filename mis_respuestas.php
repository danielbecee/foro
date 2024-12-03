<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./views/login.php');
    exit;
}

require './db/conexion.php';

// Obtener las respuestas del usuario autenticado
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT 
        answers.id AS respuesta_id, 
        answers.content, 
        answers.created_at, 
        questions.title AS pregunta_titulo 
    FROM answers
    INNER JOIN questions ON answers.question_id = questions.id
    WHERE answers.user_id = ?
    ORDER BY answers.created_at DESC
");
$stmt->execute([$userId]);
$respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Respuestas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">StackOverflow Clone</a>
    </div>
</nav>
<div class="container mt-5">
    <h1>Mis Respuestas</h1>
    <?php if (count($respuestas) > 0): ?>
        <ul class="list-group">
            <?php foreach ($respuestas as $respuesta): ?>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5><?= htmlspecialchars($respuesta['pregunta_titulo']) ?></h5>
                        <small class="text-muted"><?= htmlspecialchars($respuesta['created_at']) ?></small>
                    </div>
                    <p><?= nl2br(htmlspecialchars($respuesta['content'])) ?></p>
                    <div class="d-flex justify-content-end">
                        <a href="editar_respuestas.php?id=<?= $respuesta['respuesta_id'] ?>" class="btn btn-sm btn-warning me-2">Editar</a>
                        <a href="eliminar_respuestas.php?id=<?= $respuesta['respuesta_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta respuesta?')">Eliminar</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-muted">No has publicado ninguna respuesta aún.</p>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
