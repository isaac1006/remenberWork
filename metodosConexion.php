<?php
class MetodosConexion {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $puerto;
    private $conn;

    // Constructor para establecer la conexión
    public function __construct($servername, $username, $password, $dbname, $puerto) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->puerto = $puerto;

        // Crear conexión
        $this->conn = new mysqli($servername, $username, $password, $dbname, $puerto);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        echo "Conexión establecida correctamente.";
    }

    // Método para cerrar la conexión
    public function cerrarConexion() {
        $this->conn->close();
        echo "Conexión cerrada correctamente.";
    }

    // Método para insertar datos
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

    public function validarIngreso($usuario, $contrasena, $tabla, $condicion,$cualquierPagina) {
        // Usar el método obtenerDatos para obtener los datos del usuario
        $datos_usuario = $this->obtenerDatos($tabla, $condicion);
        // Verificar si se encontraron datos del usuario
        if (!empty($datos_usuario)) {
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
}
?>