<?php
// 1. Depuración de datos: Mostrar contenido de $_POST para depuración
var_dump($_POST);

// 2. Inclusión de archivos: Incluir archivo de clase
require_once 'MetodosConexion.php';

// 3. Carga de configuración: Cargar configuración
$config = require 'config.php';
// Mostrar la configuración cargada para depuración
var_dump($config);

// 4. Validación de solicitud POST: Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 5. Validación de campos: Verificar que los campos no sean nulos y no estén vacíos
    if (isset($_POST['placa'], $_POST['fecha'], $_POST['nombreTuctor'])) {
        $placa = trim($_POST['placa']);
        $fecha = trim($_POST['fecha']);
        $nombretuctor = trim($_POST['nombreTuctor']);

        // 6. Conexión a la base de datos: Intentar establecer una conexión
        try {
            // Crear una instancia de la clase
            $conexion = new MetodosConexion($config);

            // 7. Consulta SQL y validación: Construir la condición SQL para seleccionar el registro adecuado
            $condicion = "placas = '$placa' AND fecha = '$fecha' AND nombreTuctor = '$nombretuctor'"; // consulta SQL

            // Llamar al método para validar el ingreso
            if ($conexion->validarIngreso($placa, $fecha,$nombretuctor, 'Trabajo_Tutelado', $condicion, 'RegistrarTrabajoTutelado')) { // 'Registrar visiones' es la tabla
                // 8. Redirección: Redirigir a la página de formularios si la validación es exitosa
                header("Location: trabajo_tutelado.php");
                exit();
            } else {
                echo "Error: Datos incorrectos.";
            }

            // Cerrar la conexión
            $conexion->cerrarConexion();

        } catch (Exception $e) {
            // 9. Manejo de errores: Manejar errores de conexión a la base de datos
            echo "Error: No se pudo establecer la conexión con la base de datos. Por favor, intenta más tarde.<br>";
        }
    } else {
        echo "Error: Placa, fecha y nombre del tuctor no pueden estar vacíos.";
    }
} else {
    echo "Error: Placa, fecha y nombre del tuctor son obligatorios.";
}
?>