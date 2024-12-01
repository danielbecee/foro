<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StackOverflow Clone</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de Navegación -->
    <?php include 'navbar.php'; ?>

    <!-- Contenedor Principal -->
    <div class="container mt-5">
        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Preguntas Recientes</h1>
            <a href="#" class="btn btn-primary">Hacer una Pregunta</a>
        </div>

        <!-- Lista de Preguntas -->
        <div class="list-group">
            <!-- Pregunta 1 -->
            <div class="list-group-item">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-1">¿Cómo puedo optimizar una consulta SQL compleja?</h5>
                    <small>Publicado hace 2 horas</small>
                </div>
                <p class="mb-1">Estoy trabajando con una base de datos MySQL y tengo una consulta que tarda mucho en ejecutarse...</p>
                <small class="text-muted">Publicado por: Usuario1</small>
            </div>
            <!-- Pregunta 2 -->
            <div class="list-group-item">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-1">¿Cuál es la diferencia entre flexbox y grid en CSS?</h5>
                    <small>Publicado hace 1 día</small>
                </div>
                <p class="mb-1">Estoy tratando de entender cuándo debería usar flexbox o grid en el diseño de una página...</p>
                <small class="text-muted">Publicado por: Usuario2</small>
            </div>
            <!-- Pregunta 3 -->
            <div class="list-group-item">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-1">¿Cómo puedo manejar promesas en JavaScript?</h5>
                    <small>Publicado hace 3 días</small>
                </div>
                <p class="mb-1">He leído acerca de las promesas, pero no entiendo cómo encajan con async/await...</p>
                <small class="text-muted">Publicado por: Usuario3</small>
            </div>
        </div>
    </div>

    <!-- Formulario para Crear una Pregunta -->
    <div class="container mt-5">
        <h2 class="h4 mb-4">Hacer una Pregunta</h2>
        <form>
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" placeholder="Escribe un título claro y conciso">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" rows="5" placeholder="Describe tu problema con detalles"></textarea>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Etiquetas</label>
                <input type="text" class="form-control" id="tags" placeholder="Añade etiquetas separadas por comas (ejemplo: JavaScript, CSS, HTML)">
            </div>
            <button type="submit" class="btn btn-primary">Publicar Pregunta</button>
        </form>
    </div>

    <!-- Pie de Página -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>StackOverflow Clone © 2024. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
