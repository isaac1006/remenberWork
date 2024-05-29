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

  

    // Método para insertar datos en la base de datos //
    public function insertarDatos($tabla, $datos) {
        $campos = implode(', ', array_keys($datos));
        $valores = implode(', ', array_fill(0, count($datos), '?'));
        $tipos = str_repeat('s', count($datos));
        $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";
        
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param($tipos, ...array_values($datos));
            if ($stmt->execute()) {
                echo "Datos insertados correctamente.";
            } else {
                echo "Error al insertar datos: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al preparar la inserción: " . $this->conn->error;
        }
    }

    // Método para obtener datos
    public function obtenerDatos($tabla, $condicion = "") {
        $sql = "SELECT * FROM $tabla";
        if (!empty($condicion)) {
            $sql .= " WHERE $condicion";
        }
        $result = $this->conn->query($sql);
        if($result=== false){
            echo "error en la conexion: ".$this->conn->error;
            return false;
        }
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Método para actualizar datos
    public function actualizarDatos($tabla, $datos, $condicion) {
        $actualizaciones = [];
        $tipos = '';
        $valores = [];
        foreach ($datos as $campo => $valor) {
            $actualizaciones[] = "$campo = ?";
            $tipos .= 's';
            $valores[] = $valor;
        }
        $valores[] = $condicion;
        $tipos .= 's';
        $actualizaciones_str = implode(', ', $actualizaciones);
        $sql = "UPDATE $tabla SET $actualizaciones_str WHERE $condicion";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param($tipos, ...$valores);
            if ($stmt->execute()) {
                echo "Datos actualizados correctamente.";
            } else {
                echo "Error al actualizar datos: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al preparar la actualización: " . $this->conn->error;
        }
    }

    // Método para eliminar datos
    public function eliminarDatos($tabla, $condicion) {
        $sql = "DELETE FROM $tabla WHERE $condicion";

        if ($this->conn->query($sql) === TRUE) {
            echo "Datos eliminados correctamente.";
        } else {
            echo "Error al eliminar datos: " . $this->conn->error;
        }
    }
       // Método para validar si existen los campos en la base de datos
    public function validarIngreso($usuario, $contrasena, $tabla, $condicion,$cualquierPagina) {
        // Usar el método obtenerDatos para obtener los datos del usuario
        $datos_usuario = $this->obtenerDatos($tabla, $condicion);
        // Verificar si se encontraron datos del usuario
        if ($datos_usuario !== false && !empty($datos_usuario)) {
            // Obtener la contraseña del usuario
            $contrasena_usuario = $datos_usuario[0]['contrasena'];
    
            // Verificar si la contraseña proporcionada coincide con la contraseña del usuario
            if ($contrasena === $contrasena_usuario) {
                // Redirigir a la siguiente página si los datos son correctos
                header("Location:$cualquierPagina");
                exit();
            } else {
                                
               echo "<script>document.getElementById('mensajeError').innerText = 'Error: Usuario o contraseña incorrectos.';</script>";
                
            }
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
    // metodos de validacion //   
  
    // Método genérico para verificar si un campo existe en una tabla
    public function campoExiste($tabla, $campo, $valor) {
        $consulta = "SELECT COUNT(*) AS total FROM `$tabla` WHERE `$campo` = ?";
        $stmt = $this->conn->prepare($consulta);
        
        if ($stmt) {
            $stmt->bind_param("s", $valor);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();

            return intval($row['total']) > 0;
        } else {
            die("Error en la consulta: " . $this->conn->error);
        }
    }
}
?>