<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <form action="conexion.php" method="post">
        <label for="nombre">nombre:</label>
        <input type="text" name="nombre" required><br>
        
        <label for="placa">placa de vehiculo:</label>
        <input type="text" name="placa"  required><br>
        
        <label for="tipologia">tipologia:</label>
        <select id="tipologia" name="tipologia" ><br>
        <option value="vehiculo_Microbus">vehiculo - Microbus</option>
        <option value="vehiculo_Enseñanza">vehiculo - Enseñanza</option>
        <option value="vehiculo_Taxi">vehiculo - Taxi</option>
        <option value="vehiculo_carga">vehiculo - carga</option>
        <option value="vehiculo_Diesel">vehiculo - Diesel</option>
        <option value="vehiculo_Gasolina">vehiculo - Gasolina</option>
        <option value="vehiculo_Hibrido">vehiculo - Hibrido</option>
        <option value="vehiculo_Eletrico">vehiculo - Eletrico</option>
        <option value="Moto_Sport">Moto - Sport</option>
        <option value="Moto_Scoter">Moto - Scoter</option>
        <option value="Moto_Alto Cilindraje">Moto - Alto Cilindraje</option>
        <option value="Moto_Doble_Escape">Moto - Doble Escape</option>

        <label for="fecha">placa de vehiculo:</label>
        <input type="date" name="fecha"  required><br>

        <label for="archivo">selecione un archivo:</label>
        <input type="file" id="archivo" name="archivo"  required><br>


        
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
