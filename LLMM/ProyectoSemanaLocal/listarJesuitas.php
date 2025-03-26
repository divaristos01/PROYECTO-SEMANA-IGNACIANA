<?php
//Conecxion con la base de datos
    include 'configdb.php'; //Traemos los datos para poder conectar
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Nos conectamos a la base de datos
    $conexion->set_charset("utf8"); 
	//Desactivamos los errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;

	$sql="SELECT     ";
	echo $sql;
	$resultado=$conexion->query($sql); //Busca en la base de datos
	echo <h1>LISTADO DE JESUITAS</h1> 
	
//Cierre de conexion
	$conexion->close();
?>

