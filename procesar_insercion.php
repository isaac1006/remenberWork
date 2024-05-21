<?php
// Incluir el archivo de conexión y cualquier otra configuración necesaria
require_once 'MetodosConexion.php';
$config = require 'config.php';
$conexion = new MetodosConexion($config);

// Función para insertar datos en la base de datos
function insertarDatos($conexion, $tabla, $campos) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Construir la consulta de inserción
        $sql = "INSERT INTO $tabla (";
        $values = "VALUES (";
        foreach ($campos as $campo) {
            $nombreCampo = $campo['Field'];
            if (isset($_POST[$nombreCampo])) {
                $valor = $_POST[$nombreCampo];
                $sql .= "$nombreCampo, ";
                $values .= "'$valor', ";
            }
        }
        // Eliminar la coma y el espacio extra al final
        $sql = rtrim($sql, ', ');
        $values = rtrim($values, ', ');
        $sql .= ") $values)";

        // Ejecutar la consulta de inserción
        $resultado = $conexion->getConnection()->query($sql);
        if ($resultado) {
            echo "Datos insertados correctamente en la tabla $tabla.";
        } else {
            echo "Error al insertar datos en la tabla $tabla: " . $conexion->getConnection()->error;
        }
    }
}

// Obtener la tabla y los campos para la inserción
$tabla = $_POST['tabla']; // Suponiendo que envías el nombre de la tabla desde el formulario
$campos = obtenerEstructuraTabla($conexion, $tabla);

// Insertar datos en la base de datos
insertarDatos($conexion, $tabla, $campos);

// Cerrar la conexión si es necesario
$conexion->cerrarConexion();
?>