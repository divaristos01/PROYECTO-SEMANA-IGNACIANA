<!DOCTYPE html>
<?php
    // Obtiene los datos enviados desde el formulario
    $nombre = $_POST["nombre"];  // Ahora usamos el nombre en lugar del id
    $codigo = $_POST["codigo"];
    
    // Conectar con la base de datos
    include 'configdb.php'; // Incluye el archivo con los datos de conexión
    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); // Conecta con la base de datos
    $conexion->set_charset("utf8");
    
    // Desactiva errores
    $controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
    
    // Realiza una busqueda segun el nombre y el codigo
    $sql = "SELECT nombre FROM jesuita WHERE nombre = '$nombre' AND codigo = '$codigo'";
    $resultado = $conexion->query($sql); 
    $fila = $resultado->fetch_array();
    
    if ($fila) {
        $nombreJesuita = $fila["nombre"];
    } else {
        echo "<h2>No encontrado.</h2>";
        echo '<h3><a href="index.html">Volver</a></h3>';
        return;
    }

    // Consulta para obtener los lugares
    $sql = "SELECT ip, lugar FROM lugar;";
    $resultado = $conexion->query($sql); //Ejecuta
    echo "<h2>VISITAS</h2>";
    
    // Cierra la conexión
    $conexion->close();
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visitas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <p>¡Hola, <?php echo $nombreJesuita; ?>!</p> <!-- Nos aporta el nombre del jesuita encontrado -->

    <form action="guardarVisita.php" method="post">
        <label for="ip">Elige un lugar:</label>
        <select name="ip">
            <?php
                while ($fila = $resultado->fetch_array()) {
                    echo '<option value="' . $fila["ip"] . '">' . $fila["lugar"] . '</option>';
                }
            ?>
        </select>
        <br>
        <button type="submit">Realizar visita</button>
        <input type="hidden" name="nombreJesuita" value="<?php echo $nombreJesuita; ?>"> <!-- Envia el nombre al siguiente script -->
    </form>
</body>
</html>
