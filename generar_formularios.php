<?php
require_once 'MetodosConexion.php';

// Cargar configuración
$config = require 'config.php';
// Crear una instancia de la clase MetodosConexion
$conexion = new MetodosConexion($config);

function obtenerEstructuraTabla($conexion, $tabla) {
    // Obtener la estructura de la tabla
    $sql = "DESCRIBE $tabla";
    $result = $conexion->getConnection()->query($sql);

    if ($result === false) {
        die("Error al obtener la estructura de la tabla: " . $conexion->getConnection()->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

function generarFormulario($campos) {
    echo "<form action='procesar_insercion.php' method='post'>";
    foreach ($campos as $campo) {
        echo "<fieldset>";
        echo "<legend>{$campo['Field']}</legend>";
        echo "<label for='{$campo['Field']}'>{$campo['Field']}:</label>";
        echo "<input type='text' id='{$campo['Field']}' name='{$campo['Field']}' required><br>";
        echo "</fieldset>";
    }
    echo "<button type='submit'>Enviar</button>";
    echo "</form>";
}
?>
