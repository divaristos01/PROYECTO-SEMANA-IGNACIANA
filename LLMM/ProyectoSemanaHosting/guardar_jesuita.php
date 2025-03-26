<?php
	 // Conectar con la base de datos
    include 'configdb.php'; // Incluye el archivo con los datos de conexión
    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); // Conecta con la base de datos
    $conexion->set_charset("utf8");
	
	// Desactiva errores
    $controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
	// Recibir datos del formulario
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$nombreAlumno = $_POST['nombreAlumno'];
	$firma = $_POST['firma'];
	$firmaIngles = $_POST['firmaIngles'];
	
	// Hashear el código antes de guardarlo en la base de datos
	$codigoHash = password_hash($codigo, PASSWORD_DEFAULT);

	// Insertar en la base de datos
	$sql = "INSERT INTO jesuita (codigo, nombre, nombreAlumno, firma, firmaIngles) 
        VALUES ('$codigoHash', '$nombre', '$nombreAlumno', '$firma', '$firmaIngles')";
	
	if ($conexion->query($sql)) {
		echo "<h2>Jesuita Guardado Correctamente</h2>";
		echo '<a href="inicioSesion.html">Ir a inicio de sesión</a>';
		exit();
	} else {
		echo "<h2>Error al guardar: " . $conexion->error . "</h2>";
	}
    
    // Cierra la conexión
    $conexion->close();
?>
