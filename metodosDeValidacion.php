<?php
    // Método para verificar si un correo existe
    public function correoExiste($correo) {
        $mensaje = ''; // Variable para almacenar el mensaje
        $verificarCorreoExi = "SELECT COUNT(*) AS total FROM `informacion_usuarios` WHERE EMAIL = ?"; // Consulta con alias total para guardar la consulta en verificarCorreo
        $stmt = $this->conn->prepare($verificarCorreoExi);
        
        if ($stmt) {
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if (intval($row['total']) == 1) {
                $mensaje = "El correo ya está registrado. Inicie sesión o use otro correo.";
            } else {
                $mensaje = "El correo no está registrado. ¿Desea registrarlo?";
            }

            $stmt->close();
        } else {
            $mensaje = "Error en la consulta: " . $this->conn->error;
        }

        return $mensaje; // Devolver el mensaje
    }
    /*$conexion = new MetodosConexion($config);
$correo = "ejemplo@correo.com";
echo $conexion->correoExiste($correo);
$conexion->cerrarConexion(); */


?>