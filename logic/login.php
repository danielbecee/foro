<?php
session_start();

// Inicializar errores como un array vacío
$errors = [
    'identifier' => '',
    'password' => ''
];

// Validar el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = htmlspecialchars(trim($_POST['identifier']));
    $password = trim($_POST['password']);

    // Validar campos
    if (empty($identifier)) {
        $errors['identifier'] = "El campo Usuario o Correo Electrónico es obligatorio.";
    }

    if (empty($password)) {
        $errors['password'] = "El campo Contraseña es obligatorio.";
    }

    // Si no hay errores, continuar con la autenticación
    if (empty(array_filter($errors))) {
        include('../db/conexion.php');
        try {
            $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$identifier, $identifier]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: ../index.php");
                exit;
            } else {
                $errors['identifier'] = "Usuario o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            $errors['identifier'] = "Error del servidor: " . htmlspecialchars($e->getMessage());
        }
    }
}
