<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="conexion.php" method="post">
        <label for="nombreDeTutor">nombre del tutor:</label>
        <input type="text" name="nombreDeTutor" required><br>
        
        <label for="placa">placa de vehiculo:</label>
        <input type="text" name="placa"  required><br>

        <label for="fecha">placa de vehiculo:</label>
        <input type="date" name="fecha"  required><br>

        
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
