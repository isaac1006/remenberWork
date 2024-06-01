<?php
// Incluir archivo de conexión a la base de datos y configuración
require_once 'MetodosConexion.php';
$config = require 'config.php';

// Iniciar conexión con la base de datos
$conexion = new MetodosConexion($config);

// Obtener todas las tipologías
$obtenerTipologias = $conexion->obtenerDatos('tipologias');

// Cerrar la conexión
$conexion->cerrarConexion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<header>
        <?php
            // Verificar si se ha pasado el nombre del usuario en la URL
            if (isset($_GET['nombre'])) {
                // Obtener el nombre del usuario de la URL
                $nombreUsuario = $_GET['nombre'];
                // Mostrar el nombre del usuario en el encabezado
                echo "<h1>Bienvenido(a): $nombreUsuario , registra una nueva Supervisión </h1>";
            } else {
                echo "<h1>Bienvenido, registra una nueva Supervisión </h1>";
            }
        ?>
    </header>
<body>  
    <div class="IngresoSistema">
            <form action="registroSupervisiones.php" method="post">
                <label for="cargarTipologia">Seleccione la Tipología a registrar: </label>
                <select name="tipologia" required>
                    <?php
                    // Verificar si se encontraron tipologías
                    if (!empty($obtenerTipologias)) {
                        // Iterar sobre cada tipología y crear una opción en el select
                        foreach ($obtenerTipologias as $tipologia) {
                            $nombreTipologia = htmlspecialchars($tipologia['nombreDeTipologia']);
                            echo "<option value=\"$nombreTipologia\">$nombreTipologia</option>";
                        }
                    } else {
                        // Si no se encontraron tipologías, mostrar un mensaje
                        echo "<option value=\"\">Error: No se han encontrado tipologías.</option>";
                    }
                    ?>
                </select><br>

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required><br>

                <label for="placa">Placa de vehículo:</label>
                <input type="text" name="placa" required><br>
                
                <label for="fecha">Fecha de supervisión:</label>
                <input type="date" name="fecha" required><br>

                <input type="submit" value="Registrar">
            </form>
    </div>
</body>
<footer>
    <p>&copy; Todos los derechos reservados</p>
</footer>
</html>
