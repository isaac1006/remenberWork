<?php

// Incluye tu archivo de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

// Depuración: mostrar la configuración cargada
var_dump($config);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos no sean nulos
    if (isset($_POST['usuarioAdm'], $_POST['contrasenaAdm'])) {
        $usuarioAdm = trim($_POST['usuarioAdm']);
        $contrasenaAdm = trim($_POST['contrasenaAdm']);

        // Verifico que los campos no estén vacíos para ejecutar la función
        if (!empty($usuarioAdm) && !empty($contrasenaAdm)) {
            try {
                // Crear una instancia de la clase
                $conexion = new MetodosConexion($config);

                  // Condición para seleccionar el usuario adecuado
                  $condicion = "usuario = '$usuarioAdm'"; //consulta sql
               
                // Llamar al método para validar ingreso
                if ($conexion->validarIngreso($usuarioAdm, $contrasenaAdm, 'administrador',$condicion,'formularios_admin.php')) { // administrador es la tabla//
                    // Redirigir a la página de formularios
                    header("Location: formularios_admin.php");
                    exit();
                } else {
                    echo "Error: Usuario o contraseña incorrectos.";
                }

                // Cerrar la conexión
                $conexion->cerrarConexion();
                
            } catch (Exception $e) {
                echo "Error: No se pudo establecer la conexión con la base de datos. Por favor, intenta más tarde.<br>";
            }
        } else {
            echo "Error: Usuario y contraseña no pueden estar vacíos.";
        }
    } else {
        echo "Error: Usuario y contraseña son obligatorios.";
    }
}
?>