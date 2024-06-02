<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Unificar campos para hacer validación de ingreso
    $camposDeUsuario = array('nombreUsuario', 'tipologia', 'placa', 'fecha');
    $validar = true;

    foreach ($camposDeUsuario as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            break;
        }
    }

    if ($validar) { // Realizar todas las validaciones
        // Tenemos los valores del formulario en variables
        $nombreUsuario = trim($_POST['nombreUsuario']);
        $tipologiaSeleccionada = trim($_POST['tipologia']);
        $placaPost = trim($_POST['placa']);
        $fechaPost = trim($_POST['fecha']);

        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);

        // Obtener el año de la fecha de supervisión
        $anioSupervision = date('Y', strtotime($fechaPost));

        // Verificar si ya existe una supervisión para esta tipología y usuario en el mismo año
        if ($conexion->campoExiste('supervisiones', 'nombre', $nombreUsuario) && 
            $conexion->campoExiste('supervisiones', 'tipologia', $tipologiaSeleccionada)) {
               // Validar si existe dentro del año actual
               $supervisionesExistente = $conexion->obtenerDatos('supervisiones', "nombre = '$nombreUsuario' AND tipologia = '$tipologiaSeleccionada' AND YEAR(fecha) = YEAR(NOW())");
               if (!empty($supervisionesExistente)) {
                  echo "Error: Ya existe una supervisión para esta tipología y usuario en el año actual.";
               } else {
                  // Aquí puedes decidir qué hacer si no existe una supervisión para esta tipología y usuario en el año actual
               }

        } else {
             // lado izquiero los campos de las tablas los datos que enviare con el metodo cargar datos //
             $datos = [
                'nombre' => $nombreUsuario,
                'tipologia' => $tipologiaSeleccionada,
                'placa' => $placaPost,
                'fecha' => $fechaPost
            ];
               // ejecuto la inyeccion de los datos //
            if ($conexion->insertarDatos('supervisiones', $datos)) {
                echo "la supervision se ha insertado correctamente";
            } else {
                echo "Hubo un error al insertar la supervision";
            }
        }
        
        $conexion->cerrarConexion();
    } else {
        echo "Todos los campos son obligatorios";
    }
}
?>