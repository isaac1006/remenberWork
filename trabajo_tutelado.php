<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Unificar campos para hacer validación de ingreso
    $camposDeUsuario = array('NombreTutor', 'Placa', 'Fecha');
    $validar = true;

    foreach ($camposDeUsuario as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            break;
        }
    }

    if ($validar) { // Realizar todas las validaciones
        // Tenemos los valores del formulario en variables
        $Placa = trim($_POST['Placa']);
        $Fecha = trim($_POST['Fecha']);
        $NombreTutor= trim($_POST['Fecha']);

        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
        // validamos con el metodo que no exista el correo //
    
       
        if ($mensajeCorreo === "El correo ya está registrado. Inicie sesión o use otro correo.") {
            echo $mensajeCorreo;
        } else {
            // preparo los datos que enviare con el metodo cargar datos //
            $datos = [
                'NombreTutor' => $NombreTutor,
                'Placa' => $Placa,
                'Fecha' => $Fecha,
                
            ];
               // ejecuto la inyeccion de los datos //
            if ($conexion->insertarDatos('trabajotutelado.php', $datos)) {
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