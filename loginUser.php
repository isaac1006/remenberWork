<?php
// Incluye tu archivo de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos no sean nulos
    if (isset($_POST['usuario'], $_POST['contrasenaUser'])) {
        $usuario = trim($_POST['usuario']);
        $contrasenaUser = trim($_POST['contrasenaUser']);

        // Verifico que los campos no estén vacíos para ejecutar la función
        if (!empty($usuario) && !empty($contrasenaUser)) {
            try {
                // Crear una instancia de la clase
                $conexion = new MetodosConexion($config);

                  // Consulto el campo de la tabla //
                  $condicion = "email = '$usuario'"; //consulta sql
               
                // Llamar al método para validar ingreso
                if ($conexion->validarIngreso($usuario, $contrasenaUser, 'informacion_usuarios',$condicion,'Supervisiones.html')) { // administrador es la tabla//
                    // Redirigir a la página superviciones
                    header("Location: Supervisiones.php");
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