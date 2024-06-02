<?php
session_start(); // Inicia la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit;
}

// Obtener los datos de la sesión
$nombreUsuario = $_SESSION['nombre'];
$tipologias = $_SESSION['tipologias'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registro de Supervisiones</title>
</head>
<body>
<header class="paginaInicial">
    <?php
    // Mostrar el nombre del usuario en el encabezado
    echo "<h1>Bienvenido(a): " . htmlspecialchars($nombreUsuario) . "</h1>";
    echo "<h2>Registra una nueva Supervisión</h2>";
    echo '<li><a href="logout.php">Cerrar sesión</a></li>';
    ?>
</header>
<div class="IngresoSistema">
    <form action="registroSupervisiones.php" method="post">
        
        <!-- Campo oculto para enviar el nombre del usuario -->
         <input type="hidden" name="nombreUsuario" value="<?php echo htmlspecialchars($nombreUsuario); ?>">

        <label for="tipologia">Seleccione la Tipología a registrar: </label>
        <select name="tipologia" required>
            <?php
            // Verificar si se encontraron tipologías
            if (!empty($tipologias)) {
                // Iterar sobre cada tipología y crear una opción en el select
                foreach ($tipologias as $tipologia) {
                    $nombreTipologia = htmlspecialchars($tipologia['nombreDeTipologia']);
                    echo "<option value=\"$nombreTipologia\">$nombreTipologia</option>";
                }
            } else {
                // Si no se encontraron tipologías, mostrar un mensaje
                echo "<option value=\"\">Error: No se han encontrado tipologías.</option>";
            }
            ?>
        </select><br>


        <label for="placa">Placa de vehículo:</label>
        <input type="text" name="placa" required><br>
        
        <label for="fecha">Fecha de supervisión:</label>
        <input type="date" name="fecha" required><br>

        <input type="submit" value="Registrar">
    </form>
</div>
<footer>
    <p>&copy; Todos los derechos reservados</p>
</footer>
</body>
</html>