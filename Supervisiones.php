<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    // Unificar campos para hacer validación de ingreso
    $campos = array('Placa', 'Fecha'); // Aquí corregimos el nombre de la variable
    $validar = true;

    foreach ($campos as $campo) { // Aquí también corregimos el nombre de la variable
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            // Puedes agregar un mensaje de error aquí si lo deseas
        }
    }

    if ($validar) { // Realizar todas las validaciones
        // Tenemos los valores del formulario en variables
        $Placa = trim($_POST['Placa']);
        $Fecha = trim($_POST['Fecha']);

        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
        

        
        // Verificar si la placa ya está registrada
       // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
    }
    // Verificar si la placa ya está registrada
    if ($conexion->placaExiste($Placa)) {
    echo "La placa ya está registrada. Por favor, ingrese otra placa.";
    } else {
    // Preparar los datos para la inserción
    $datos = [
        'Placa' => $Placa,
        'Fecha' => $Fecha
    ];
    
    // Insertar los datos en la tabla 'supervisiones' utilizando el método insertarDatos
    if ($conexion->insertarDatos('supervisiones', $datos)) {
        echo "Se han insertado los datos correctamente";
    } else {
        echo "Hubo un error al insertar los datos";
    }
}

    // Cerrar la conexión
    $conexion->cerrarConexion();
}
?>
