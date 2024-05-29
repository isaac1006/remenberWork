<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Unificar campos para hacer validación de ingreso
    $camposDeUsuario = array('nombreUsuario', 'cedulaUsuario', 'emailUsuario', 'contrasenaUser');
    $validar = true;

    foreach ($camposDeUsuario as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            break;
        }
    }

    if ($validar) { // Realizar todas las validaciones
        // Tenemos los valores del formulario en variables
        $nombre = trim($_POST['nombreUsuario']);
        $cedula = trim($_POST['cedulaUsuario']);
        $email = trim($_POST['emailUsuario']);
        $contrasenaUser= trim($_POST['contrasenaUser']);

        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
            // Verifica la conexión
            if (!$conexion) {
                die('Error de conexión: ' . mysqli_connect_error());
            }
         // valido con el metodo de existencia que no exista el campo para inyectarlo a la base de datos //
         // 1 nombrede la tabla // 2 el campo // la variable post //
        if ($conexion->campoExiste('registrodeusuarios','email',$email)) {
            echo "El correo ya está registrado. Inicie sesión o use otro correo.";
        } else {
            // lado izquiero los campos de las tablas los datos que enviare con el metodo cargar datos //
            $datos = [
                'nombre' => $nombre,
                'cedula' => $cedula,
                'email' => $email,
                'contrasena' => $contrasenaUser
            ];
               // ejecuto la inyeccion de los datos //
            if ($conexion->insertarDatos('registrodeusuarios', $datos)) {
                echo "Se han insertado los datos correctamente";
            } else {
                echo "Hubo un error al insertar los datos mentiras";
            }
        }

        $conexion->cerrarConexion();
    } else {
        echo "Todos los campos son obligatorios";
    }
}
?>