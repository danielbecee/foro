<?php
session_start();

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



// Eliminar la pregunta
$deleteQuery = "DELETE FROM questions WHERE id = ?";
$deleteStmt = $pdo->prepare($deleteQuery);
$deleteStmt->execute([$pregunta_id]);

header('Location: mis_preguntas.php');
exit;
?>
