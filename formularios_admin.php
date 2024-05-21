<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Formularios</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al archivo CSS externo para diseño -->
</head>
<body>
    <header class="paginaInicial">
        <h1>"Administración - Diligenciar Tablas"</h1>
        <nav>
            <ul>
                <li><a href="./index.html">Inicio</a></li>
                <li><a href="./logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="formularios">
        <?php 
        // Incluir el archivo que contiene la función obtenerEstructuraTabla()
        require_once 'generar_formularios.php';
        // incluyo los metodos y la conexion //
        require_once 'MetodosConexion.php';
        $config = require 'config.php';
        $conexion = new MetodosConexion($config);
        
        // Generar formularios para las tablas
         // Generar formularios para las tablas
        
         echo "<h2>Formulario para la tabla informacion_usuarios</h2>";
         generarFormulario(obtenerEstructuraTabla($conexion, 'informacion_usuarios'));

         echo "<h2>Formulario para la tabla acceso</h2>";
         generarFormulario(obtenerEstructuraTabla($conexion, 'acceso'));
 
         echo "<h2>Formulario para la tabla tipologias</h2>";
         generarFormulario(obtenerEstructuraTabla($conexion, 'tipologias'));
        ?>
    </div>
    <footer>
        <p>&copy; Todos los derechos reservados</p>
    </footer>
</body>
</html