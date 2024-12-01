<?php
require '../db/conexion.php';
$query = htmlspecialchars($_GET['query'], ENT_QUOTES);

$preguntas_query = "SELECT * FROM questions WHERE title LIKE ?";
$stmt = $pdo->prepare($preguntas_query);
$stmt->execute(["%$query%"]);
$preguntas = $stmt->fetchAll();

$usuarios_query = "SELECT * FROM users WHERE username LIKE ? OR real_name LIKE ?";
$stmt = $pdo->prepare($usuarios_query);
$stmt->execute(["%$query%", "%$query%"]);
$usuarios = $stmt->fetchAll();
?>
<div>
    <h2>Resultados de Preguntas</h2>
    <ul>
        <?php foreach ($preguntas as $pregunta): ?>
        <li><a href="./ver_pregunta.php?id=<?= $pregunta['id'] ?>"><?= htmlspecialchars($pregunta['title'], ENT_QUOTES) ?></a></li>
        <?php endforeach; ?>
    </ul>

    <h2>Resultados de Usuarios</h2>
    <ul>
        <?php foreach ($usuarios as $usuario): ?>
        <li><?= htmlspecialchars($usuario['username'], ENT_QUOTES) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
