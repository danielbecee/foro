<?php
// Inicializar arreglo de errores
$errors = [
    'username' => '',
    'real_name' => '',
    'email' => '',
    'password' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Incluir el archivo de conexión
    include("../db/conexion.php");

    // Obtener los datos del formulario
    $username = htmlspecialchars(trim($_POST['username']));
    $real_name = htmlspecialchars(trim($_POST['real_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Validar campos vacíos
    if (empty($username)) {
        $errors['username'] = "El nombre de usuario es obligatorio.";
    }

    if (empty($real_name)) {
        $errors['real_name'] = "El nombre real es obligatorio.";
    }

    if (empty($email)) {
        $errors['email'] = "El correo electrónico es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "El correo electrónico no es válido.";
    }

    if (empty($password)) {
        $errors['password'] = "La contraseña es obligatoria.";
    }

    // Si no hay errores, insertar en la base de datos
    if (empty(array_filter($errors))) {
        try {
            // Insertar el usuario en la base de datos
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, real_name, email, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $real_name, $email, $hashed_password]);

            // Redirigir al login
            header("Location: ../views/login.php?success=1");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errors['email'] = "El correo electrónico ya está registrado.";
            } else {
                die("Error en el registro: " . $e->getMessage());
            }
        }
    }
}
?>
