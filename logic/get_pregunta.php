<?php
require './db/conexion.php'; // Archivo de conexión a la base de datos

// Función para obtener todas las preguntas
function obtenerPreguntas($pdo)
{
    $query = "
        SELECT q.id, q.title, q.description, q.created_at, u.username
        FROM questions q
        JOIN users u ON q.user_id = u.id
        ORDER BY q.created_at DESC
    ";
    $stmt = $pdo->query($query); // Ejecuta la consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todas las preguntas como un array asociativo
}

// Función para obtener los detalles de una pregunta específica
function obtenerPregunta($pregunta_id, $pdo)
{
    $query = "
        SELECT q.title, q.description, q.created_at, u.username
        FROM questions q
        JOIN users u ON q.user_id = u.id
        WHERE q.id = ?
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$pregunta_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna los detalles de la pregunta o false si no existe
}

// Función para obtener las respuestas de una pregunta específica
function obtenerRespuestas($pregunta_id, $pdo)
{
    $query = "
        SELECT a.content, a.created_at, u.username
        FROM answers a
        JOIN users u ON a.user_id = u.id
        WHERE a.question_id = ?
        ORDER BY a.created_at DESC
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$pregunta_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna un array de respuestas
}
