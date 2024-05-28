<?php

class MetodosConexion {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $puerto;
    private $conn;

    // Constructor para establecer la conexión
    public function __construct($config) {
        $this->servername = $config['servername'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->dbname = $config['dbname'];
        $this->puerto = $config['puerto'];

        // Crear conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname, $this->puerto);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        echo "Conexión establecida correctamente.<br>";
    }

    // Método para cerrar la conexión
    public function cerrarConexion() { 
        $this->conn->close();
        echo "Conexión cerrada correctamente.<br>";
    }

    // Método para obtener la conexión
    public function getConnection() {
        return $this->conn;
    }

if($_SERVER["REQUEST_METHOD"]=="POST"){

$cedula=$_POST["cedula"];
$usuario=$_POST["usuario"];
$permiso=$_POST["acceso_a"];
$contrasena=$_POST["contrasena"];

echo"<p><strong>Nota Final:<strong>$notafinal<p>";

function registraracceso($cedula,$usuario,$permiso,$deporte,$contrasena){
    //preparo la consulta //
    $sqlRegistrar="INSERT INTO `acceso`(`acceso_a`,`cedula`, `contraeña`) VALUES ('$cedula','$permiso', '$contrasena')";
    //llamo la funcion conexion //
    $conectar=conexion();
    //ejecuto la consulta y verifico si hay errores en la consulta//
    if($conectar->query($sqlRegistrar)===TRUE){
    //verifico el registro de los datos //
        echo "se guardaron los datos correctamente  ";
    }else{
        echo "error en el registro de los datos ";
    }
    $conectar->close();
    
}

}
}
?>