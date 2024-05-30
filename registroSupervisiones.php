<?php
// Incluir archivo de conexión a la base de datos y configuración
require_once 'MetodosConexion.php';
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    // Validación de campos del formulario
    $campos = ['nombre', 'tipologia', 'placa', 'fecha'];
    $validar = true;

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            break;
        }
    }

    if ($validar) {
        // Obtenemos los valores del formulario en variables
        $SupervisionesDePost = trim($_POST['supervisiones']);
        // Obtener los valores del formulario en variables
        $nombre = trim($_POST['nombre']);
        $tipologia = trim($_POST['tipologia']);
        $placa = trim($_POST['placa']);
        $fecha = trim($_POST['fecha']);

        // Iniciar conexión con la base de datos
        $conexion = new MetodosConexion($config);

        // Preparar los datos para la inserción
        $datos = [
            'nombre' => $nombre,
            'tipologia' => $tipologia,
            'placa' => $placa,
            'fecha' => $fecha
        ];

        // Verificar si la supervisión ya existe antes de insertarla
        if ($conexion->campoExiste('supervisiones', 'nombre', $datos)) {
            echo "La supervisión ya existe, no se puede ingresar nuevamente.";
        } else {
            // Insertar los datos en la tabla 'supervisiones'
            $conexion->insertarDatos('supervisiones', $datos);
            echo "Se han insertado los datos correctamente.";
        }

        // Cerrar la conexión
        $conexion->cerrarConexion();
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
