<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php'); // Redirigir si no está autenticado
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../db/conexion.php'; // Archivo con la conexión a la base de datos

    $titulo = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $descripcion = htmlspecialchars($_POST['description'], ENT_QUOTES);
    $usuario_id = $_SESSION['user_id'];

    $query = "INSERT INTO questions (title, description, user_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$titulo, $descripcion, $usuario_id]);

    header('Location: ../index.php'); // Redirigir a la página principal
    exit();
}
?>
