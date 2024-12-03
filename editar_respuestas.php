<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./views/login.php');
    exit;
}

require './db/conexion.php';

// Verificar si se proporcionó un ID de respuesta


$respuestaId = intval($_GET['id']);
$userId = $_SESSION['user_id'];

// Obtener la respuesta del usuario
$stmt = $pdo->prepare("SELECT content FROM answers WHERE id = ? AND user_id = ?");
$stmt->execute([$respuestaId, $userId]);
$respuesta = $stmt->fetch();

if (!$respuesta) {
    header('Location: mis_respuestas.php');
    exit;
}

// Procesar el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoContenido = htmlspecialchars(trim($_POST['content']));

    if (empty($nuevoContenido)) {
        $error = "El contenido no puede estar vacío.";
    } else {
        $stmt = $pdo->prepare("UPDATE answers SET content = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$nuevoContenido, $respuestaId, $userId]);
        header('Location: mis_respuestas.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Respuesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Respuesta</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form action="editar_respuesta.php?id=<?= $respuestaId ?>" method="POST">
        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea 
                class="form-control" 
                id="content" 
                name="content" 
                rows="5"><?= htmlspecialchars($respuesta['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="mis_respuestas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
