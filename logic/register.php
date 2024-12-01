<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Incluir el archivo de conexión
    include("../db/conexion.php");

    // Obtener los datos del formulario
    $username = htmlspecialchars(trim($_POST['username']));
    $real_name = htmlspecialchars(trim($_POST['real_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        // Insertar el usuario en la base de datos
        $stmt = $pdo->prepare("INSERT INTO users (username, real_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $real_name, $email, $password]);

        // Redirigir al login
        header("Location: ../views/login.php?success=1");
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            die("Error: El nombre de usuario o correo ya está en uso.");
        }
        die("Error en el registro: " . $e->getMessage());
    }
}
?>
