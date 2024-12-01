# Foro - Proyecto Web Tipo StackOverflow

Este proyecto consiste en la creación de un foro web inspirado en el funcionamiento de **StackOverflow**. Permite a los usuarios registrarse, iniciar sesión, publicar preguntas, responderlas y realizar interacciones adicionales. Está diseñado para practicar la creación de sistemas completos con un backend seguro y funcional.

## Funcionalidades Principales

### Inicio de Sesión y Registro
- **Pantalla inicial**: permite registrarse o iniciar sesión.
- **Registro de usuarios**:
  - Datos solicitados: nombre de usuario, nombre real, email y contraseña.
  - Validación y saneamiento de datos para evitar inyección de código.
  - Contraseñas almacenadas de forma segura utilizando **BCRYPT**.

### Gestión de Preguntas
- **Publicación de preguntas**:
  - Los usuarios pueden crear preguntas añadiendo un título y una descripción.
- **Listado de preguntas**:
  - Cada usuario puede ver las preguntas publicadas por él mismo.
- **Edición y eliminación**:
  - Sólo se puede editar o eliminar preguntas propias.

### Respuestas a Preguntas
- Los usuarios pueden responder a preguntas mediante un formulario que permite un máximo de 500 caracteres por respuesta.
- **Listado de respuestas**:
  - Aparecen ordenadas de más reciente a más antigua.
- Cada respuesta incluye:
  - El nombre del usuario que la escribió.
  - La fecha de publicación.

### Búsqueda
- **Búsqueda de preguntas**:
  - Por título.
- **Búsqueda de usuarios**:
  - Por nombre de usuario o nombre real.
  - Muestra una lista de usuarios que coincidan con los términos de búsqueda.

### Interacciones con otros usuarios (Opcional)
- **Solicitud de amistad**:
  - Se pueden enviar solicitudes de amistad entre usuarios.
- **Mensajes privados**:
  - Si dos usuarios son amigos, pueden intercambiar mensajes mediante un sistema de chat.

### Etiquetas
- **Gestión de etiquetas**:
  - Las preguntas pueden incluir etiquetas para facilitar búsquedas específicas.

---

## Configuración de la Base de Datos

La base de datos incluye tablas bien estructuradas para soportar todas las funcionalidades:

1. **Usuarios**:
   - Almacena información del usuario, como nombre de usuario, nombre real, email y contraseña.
   - Contraseñas encriptadas con **BCRYPT**.
   
2. **Preguntas**:
   - Almacena el título, descripción, fecha de publicación y usuario que la creó.

3. **Respuestas**:
   - Vinculadas a una pregunta específica, incluyen el contenido, fecha de publicación y el usuario que respondió.

4. **Amistades (Opcional)**:
   - Tabla para gestionar relaciones de amistad entre usuarios.

5. **Mensajes (Opcional)**:
   - Tabla para almacenar mensajes intercambiados entre usuarios amigos.

---

## Tecnologías Utilizadas

### Frontend
- **HTML5, CSS3, Bootstrap**:
  - Para crear una interfaz atractiva, homogénea y responsive.
- **JavaScript**:
  - Validación de formularios y notificaciones dinámicas.

### Backend
- **PHP procedural**:
  - Procesamiento de formularios, gestión de sesiones y ejecución de consultas SQL.
- **Validación de datos**:
  - Protección contra inyección de código y validación de formularios.

### Base de Datos
- **MySQL**:
  - Para almacenamiento de usuarios, preguntas, respuestas y otras interacciones.
- **Consultas seguras**:
  - Preparación de consultas para evitar inyección SQL.

---

## Estructura del Proyecto en Git

- **Ramas**:
  - Separación del proyecto en ramas para desarrollar funcionalidades específicas.
- **Commits**:
  - Frecuentes y descriptivos para documentar el progreso.
- **README**:
  - Explicación del proyecto, su funcionalidad y cómo realizar pruebas.

---

## Detalles Adicionales

- Cada pregunta muestra:
  - Fecha de publicación.
  - Usuario que la publicó.
- Cada respuesta muestra:
  - Nombre del usuario que la escribió.
  - Fecha de publicación.

---