<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    // Validación de campos del formulario
    $campos = ['nombreDeTipologia'];
    $validar = true;

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            $validar = false;
            break;
        }
    }
    if ($validar) {
        // Obtenemos los valores del formulario en variables
        $tipologiaDePost = trim($_POST['nombreDeTipologia']);
        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
            // preparo los datos que enviare con el metodo cargar datos //
            $datos = [
                'nombreDeTipologia' => $tipologiaDePost   
            ];
            if($conexion->campoExiste('tipologias','nombreDeTipologia',$tipologiaDePost)) {
                echo"el campo ya existe no se puede ingresar";
            }else {

                $conexion->insertarDatos('tipologias', $datos);
                    echo"Se han insertado los datos correctamente"; 
            }
               // ejecuto la inyeccion de los datos 
        $conexion->cerrarConexion();
    } else {
        echo "Todos los campos son obligatorios";
    }
}
?>
