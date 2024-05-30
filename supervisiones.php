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
        <label for="">visualizar supervision realizada</label>
        <textarea name="" id=""></textarea>

    </div>
    
    <div class="IngresoSistema">
        <form action="registroSupervisiones.php" method="post">
        <label for="cargarTipologia">Selecciones la Tipologia a registrar: </label>
        <select name="cargarTipologia" id="cargarTipologia">
        <?php
        // Verificar si se pasaron los datos en la URL
        if (isset($_GET['nombreDeTipologia'])) {
            // Obtener los nombres de las tipologías de la URL
            $nombresTipologias = explode("&nombreDeTipologia=", $_GET['nombreDeTipologia']);
            // Eliminar el primer elemento del arreglo, que está vacío
            array_shift($nombresTipologias);
            
            // Iterar sobre cada nombre de tipología y crear una opción en el select
            foreach ($nombresTipologias as $nombreTipologia) {
                echo "<option value=\"$nombreTipologia\">$nombreTipologia</option>";
            }
        } else {
            // Si no se pasaron los datos en la URL, mostrar un mensaje de error
            echo "<option value=\"\">Error: No se han recibido los datos necesarios.</option>";
        }
        ?>
        </select>

        <label for="Placa">Placa de vehiculo:</label>
        <input type="text" name="Placa"  required><br>
        
        <label for="Fecha">Fecha de supervicion:</label>
        <input type="date" name="Fecha"  required><br>

        
        <input type="submit" value="Registrar">
        </form>
    </div>

</body>
<footer>
    <p>&copy; Todos los derechos reservados</p>
</footer>
</html>
