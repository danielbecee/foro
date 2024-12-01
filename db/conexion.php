<?php
// Configuración de conexión a la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_foro'); // Nombre de la base de datos
define('DB_USER', 'root'); // Usuario de la base de datos
define('DB_PASS', ''); // Contraseña (déjalo vacío si no tienes una)

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
