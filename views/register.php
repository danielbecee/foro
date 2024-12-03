<?php include('../logic/register.php');
$userLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 0.25em;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">StackOverflow Clone</a>
    </div>
</nav>
<div class="container mt-5">
    <h1>Registro de Usuario</h1>
    <form id="registerForm" action="register.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nombre de Usuario</label>
            <input 
                type="text" 
                class="form-control" 
                id="username" 
                name="username" 
                value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            <div class="error-message"><?= htmlspecialchars($errors['username']) ?></div>
        </div>
        <div class="mb-3">
            <label for="real_name" class="form-label">Nombre Real</label>
            <input 
                type="text" 
                class="form-control" 
                id="real_name" 
                name="real_name" 
                value="<?= htmlspecialchars($_POST['real_name'] ?? '') ?>">
            <div class="error-message"><?= htmlspecialchars($errors['real_name']) ?></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input 
                type="email" 
                class="form-control" 
                id="email" 
                name="email" 
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <div class="error-message"><?= htmlspecialchars($errors['email']) ?></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password">
            <div class="error-message"><?= htmlspecialchars($errors['password']) ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
</div>
<script src="../js/register.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
