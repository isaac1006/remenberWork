<?php
// procesar_formulario.php

$servername = "localhost"; //  servidor 
$username = "root"; // Tu usuario de la base de datos
$password = ""; // Tu contraseña de la base de datos
$dbname = "remenberWorkBD"; // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreDeTipologia = $conn->real_escape_string($_POST['nombreDeTipologia']);

    $sql = "INSERT INTO tipologias (nombreDeTipologia) VALUES ('$nombreDeTipologia')";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva tipología agregada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
