<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Unificar campos para hacer validación de ingreso
    $campos = array('Placa', 'Fecha', 'usuarioId', 'tipologiaId'); // Agregar usuarioId y tipologiaId a la validación
    $validar = true;

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            // Puedes agregar un mensaje de error aquí si lo deseas
        }
        
    }

    if ($validar) { // Realizar todas las validaciones
        // Tenemos los valores del formulario en variables
        $Placa = trim($_POST['Placa']);
        $Fecha = trim($_POST['Fecha']);
<<<<<<< HEAD
        var_dump($placa);
=======
        $usuarioId = intval($_POST['usuarioId']);
        $tipologiaId = intval($_POST['tipologiaId']);
>>>>>>> b54bad99f03bd70a119cd055351ac0f514fa2eee

        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
    
        $datos2 = [
            'usuarioId' => $usuarioId,
            'tipologiaId' => $tipologiaId,
            'placa' => $Placa,
            'fecha' => $Fecha
        ];

        // Insertar los datos en la tabla 'supervisiones' utilizando el método insertarDatos
        if ($conexion->insertarDatos('supervisiones', $datos2)) {
            var_dump($datos2);
            echo "Se han insertado los datos correctamente";
        } else {
            echo "Hubo un error al insertar los datos";
        }

        // Cerrar la conexión
        $conexion->cerrarConexion();
    } else {
        echo "Error en validación";
    } 
}
?>
