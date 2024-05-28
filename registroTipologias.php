<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Unificar campos para hacer validación de ingreso
    $nombreDeTipologia = $conn->real_escape_string($_POST['nombreDeTipologia']);
    $validar = true;

    foreach ($nombreDeTipologia as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            break;
        }
    }

    if ($validar) { // Realizar todas las validaciones
        // Tenemos los valores del formulario en variables
        $Tipologia = trim($_POST['Tipologia']);
        $Fecha = trim($_POST['Fecha']);

        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
        // validamos con el metodo que no exista el correo //
    
       
        if ($mensajeCorreo === "El correo ya está registrado. Inicie sesión o use otro correo.") {
            echo $mensajeCorreo;
        } else {
            // preparo los datos que enviare con el metodo cargar datos //
            $datos = [
                'Tipologia' => $Tipologia,
                'Fecha' => $Fecha,
                
            ];
               // ejecuto la inyeccion de los datos //
            if ($conexion->insertarDatos('nombreDeTipologia', $datos)) {
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
