<?php
class MetodosConexion {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    // Constructor para establecer la conexión
    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        // Crear conexión
        $this->conn = new mysqli($servername, $username, $password, $dbname);

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
        $valores = implode("', '", array_values($datos));
        $sql = "INSERT INTO $tabla ($campos) VALUES ('$valores')";
        
        if ($this->conn->query($sql) === TRUE) {
            echo "Datos insertados correctamente.";
        } else {
            echo "Error al insertar datos: " . $this->conn->error;
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
        foreach ($datos as $campo => $valor) {
            $actualizaciones[] = "$campo = '$valor'";
        }
        $actualizaciones_str = implode(', ', $actualizaciones);
        $sql = "UPDATE $tabla SET $actualizaciones_str WHERE $condicion";

        if ($this->conn->query($sql) === TRUE) {
            echo "Datos actualizados correctamente.";
        } else {
            echo "Error al actualizar datos: " . $this->conn->error;
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
}
?>