<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar a la base de datos
    include("../db/conexion.php");

    // Obtener los datos del formulario
    $identifier = htmlspecialchars(trim($_POST['identifier'])); // Puede ser usuario o correo
    $password = $_POST['password'];

    try {
        // Consultar por usuario o correo
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$identifier, $identifier]);
        $user = $stmt->fetch();

        // Validar contraseña
        if ($user && password_verify($password, $user['password'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirigir al inicio
            header("Location: ../index.php");
        } else {
            // Credenciales incorrectas
            echo "<div class='alert alert-danger text-center'>Usuario o contraseña incorrectos.</div>";
        }
    } catch (PDOException $e) {
        die("Error en el inicio de sesión: " . $e->getMessage());
    }
}
?>
