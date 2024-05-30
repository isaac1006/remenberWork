<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validación de campos del formulario
    $campos = ['nombre', 'placa', 'tipologia', 'fecha'];
    $validar = true;

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            break;
        }
    }
    if ($validar) {
        // Obtenemos los valores del formulario en variables
        $nombre = trim($_POST['nombre']);
        $placa = trim($_POST['placa']);
        $tipologia = trim($_POST['tipologia']);
        $fecha = trim($_POST['fecha']);


        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
            // preparo los datos que enviare con el metodo cargar datos //
            $datos = [
                'Tipologia' => $Tipologia
                
            ];
               // ejecuto la inyeccion de los datos //
            if ($conexion->insertarDatos('nombreDeTipologia', $datos)) {
                echo "Se han insertado los datos correctamente";
            } else {
                echo "Hubo un error al insertar los datos";
        }

        $conexion->cerrarConexion();
    } else {
        echo "Todos los campos son obligatorios";
    }
}
?>
