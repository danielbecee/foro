<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./views/login.php');
    exit;
}

require './db/conexion.php';

// Verificar si se proporcionó un ID de respuesta
if (!isset($_GET['id'])) {
    header('Location: mis_respuestas.php');
    exit;
}

$respuestaId = intval($_GET['id']);
$userId = $_SESSION['user_id'];

// Eliminar la respuesta
$stmt = $pdo->prepare("DELETE FROM answers WHERE id = ? AND user_id = ?");
$stmt->execute([$respuestaId, $userId]);

header('Location: mis_respuestas.php');
exit;
