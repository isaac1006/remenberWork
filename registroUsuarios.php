<?php
// Incluye tu archivo de clase
require_once 'MetodosConexion.php';
// Cargar configuración
$config = require 'config.php';

if($_SERVER['REQUEST_METHOD']==$_POST){
    // unificar campos para hacer validacion de ingreso //
    $camposDeUsuario=array('nombreUsuario','cedulaUsuario','emailUsuario','telefonoUsuario');
    $validar=true;
    foreach($campos as $camposDeUsuario){
        if(!isset($_POST[$campos]) || empty($_POST[$campos])){
            $validar=false;
            break;
        }
    }
    if($validar){ // realizar todas las validaciones  // 
        // 1 Tenemos los valores del formulario posten variables //
        $nombre=trim($_POST['nombreUsuario'])
        $cedula=trim($_POST['cedulaUsuario'])
        $email=trim($_POST['emailUsuario'])
        $telefono=trim($_POST['lefonoUsuario'])

        // iniciamos conexion con base de datos //
        $conexion=new MetodosConexion($config);
        echo $conexion->correoExiste($email);
       $conexion->cerrarConexion(); */
    }
}
?>