<?php
// Incluye tus archivos de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validación de campos del formulario
    if (isset($_POST['nombreDeTipologia']) && !empty($_POST['nombreDeTipologia'])) {
        // Iniciamos conexión con base de datos
        $conexion = new MetodosConexion($config);
        $nombreDeTipologia = $_POST['nombreDeTipologia'];

        // Verificar si el campo ya existe en la base de datos
        if($conexion->campoExiste('tipologias','nombreDeTipologia', $nombreDeTipologia)) {
            echo "El campo ya existe, no se puede ingresar.";
            header("Location:formulariosAdministrador.html");
            exit;
        } else {
            // Preparar los datos para la inserción
            $datos = [
                'nombreDeTipologia' => $nombreDeTipologia
            ];

            // Insertar los datos en la base de datos
            $conexion->insertarDatos('tipologias', $datos);
            echo "Se han insertado los datos correctamente.";
        }

        // Cerrar conexión
        $conexion->cerrarConexion();
    } else {
        echo "El campo 'nombreDeTipologia' es obligatorio.";
    }
}
?>