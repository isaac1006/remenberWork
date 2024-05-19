<?php
// Incluye tu archivo de clase
require_once 'MetodosConexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos no sean nulos
    if (isset($_POST['usuarioAdm'], $_POST['contrasenaAdm'])) {
        $usuarioAdm = trim($_POST['usuarioAdm']);
        $contrasenaAdm = trim($_POST['contrasenaAdm']);

        // Verifico que los campos no estén vacíos para ejecutar la función
        if (!empty($usuarioAdm) && !empty($contrasenaAdm)) {
            try {
                // Crear una instancia de la clase
                $conexion = new MetodosConexion('localhost', 'root', 'password', 'remenberWorkdb', '3306');
                if($conexion==true){
                // Llamar al método para validar ingreso
                $conexion->validarIngreso($usuarioAdm, $contrasenaAdm, '/.administradorLogin.php');

                // Cerrar la conexión
                $conexion->cerrarConexion();
                echo ("se realizo la conexion");

                }else{
                    echo(" erro en la conexion");

                }

             
            } catch (Exception $e) {
                echo "Error: No se pudo establecer la conexión con la base de datos. Por favor, intenta más tarde.";
            }
        } else {
            echo "Error: Usuario y contraseña no pueden estar vacíos.";
        }
    } else {
        echo "Error: Usuario y contraseña son obligatorios.";
    }
}
?>