<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php'); // Redirigir si no está autenticado
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../db/conexion.php';
    $pregunta_id = $_POST['question_id'];
    $contenido = htmlspecialchars($_POST['content'], ENT_QUOTES);
    $usuario_id = $_SESSION['user_id'];

    $query = "INSERT INTO answers (content, question_id, user_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$contenido, $pregunta_id, $usuario_id]);

    header("Location: ../ver_pregunta.php?id=$pregunta_id");
    exit();
}
?>
