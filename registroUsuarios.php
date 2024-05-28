<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Unificar campos para hacer validación de ingreso
    $camposDeUsuario = array('nombreUsuario', 'cedulaUsuario', 'emailUsuario', 'telefonoUsuario');
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
        $telefono = trim($_POST['telefonoUsuario']);
        $profesion= trim($_POST['profesioUsuario']);

        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
        // validamos con el metodo que no exista el correo //
    
        $mensajeCorreo = $conexion->correoExiste($email);
        if ($mensajeCorreo === "El correo ya está registrado. Inicie sesión o use otro correo.") {
            echo $mensajeCorreo;
        } else {
            // preparo los datos que enviare con el metodo cargar datos //
            $datos = [
                'nombre' => $nombre,
                'cedula' => $cedula,
                'email' => $email,
                'telefono' => $telefono,
                'profesion'=>$profesion
            ];
               // ejecuto la inyeccion de los datos //
            if ($conexion->insertarDatos('informacion_usuarios', $datos)) {
                echo "Se han insertado los datos correctamente";
            } else {
                echo "Hubo un error al insertar los datos";
            }
        }

        $conexion->cerrarConexion();
    } else {
        echo "Todos los campos son obligatorios";
    }
}
?>