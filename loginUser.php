<?php
session_start(); // iniciar sesion al comienzo del script //
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
                $condicion = "email= '$usuario'"; //consulta sql

                // Llamar al método para validar ingreso
                if ($conexion->validarIngreso($usuario, $contrasenaUser, 'registrodeusuarios', $condicion)) {
                    // Obtener los datos de usuario de acuerdo al correo
                    $datosNombre = $conexion->obtenerDatos('registrodeusuarios', $condicion);
                    
                    // Obtener todas las tipologías
                    $obtenerTipologias = $conexion->obtenerDatos('tipologias');
                    
                    // Verificar si se encontraron datos
                    if (!empty($datosNombre) && !empty($obtenerTipologias)) {
                          // Almacenar datos en la sesión
                          $_SESSION['nombre'] = $datosNombre[0]['nombre'];
                          $_SESSION['tipologias'] = $obtenerTipologias;
  
                         header("Location: supervisiones.php");
                        exit(); // Es importante salir del script después de la redirección
                    } else {
                        echo "No se encontraron datos para el correo $usuario";
                    }
                }else {
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