<?php
include("db/conexion.php");

try {
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
