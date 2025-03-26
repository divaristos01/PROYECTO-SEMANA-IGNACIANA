<?php
// Obtiene la información del formulario
$nombreJesuita = $_POST["nombreJesuita"];   // Nombre del Jesuita
$ipLugar = $_POST["ip"];  // IP del lugar

// Conecta con la base de datos ($conexion)
include 'configdb.php';  // Archivo con los datos de conexión
$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);  // Conecta con la base de datos
$conexion->set_charset("utf8");  

// Desactiva errores
$controlador = new mysqli_driver();
$controlador->report_mode = MYSQLI_REPORT_OFF;

// Buscar el idJesuita a partir del nombre del jesuita
$sql = "SELECT idJesuita FROM jesuita WHERE nombre = '$nombreJesuita'";  // Obtiene el idJesuita
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // En el caso de encontrar Jesuita, obtendremos su id
    $fila = $resultado->fetch_array();
    $idJesuita = $fila["idJesuita"];
    
    // Cadena de caracteres de la consulta SQL para insertar la visita
    $sqlInsert = "INSERT INTO visita (idJesuita, ip) VALUES ($idJesuita, '$ipLugar');";  // Realizamos el INSERT con el idJesuita

    
    // Se mostrara en el caso de que haga la visita
    if ($conexion->query($sqlInsert)) {
        echo "<h2>Visita del jesuita realizada</h2>";
    } else {
        echo "<h2>Error</h2>";
    }
} else {
    // Se mostrara en el caso de que no haga la visita
    echo "<h2>No encontrado</h2>";
    echo '<h3><a href="visitas.php">Vuelve a intentarlo</a></h3>';
}

// Cierra la conexión
$conexion->close();
?>
