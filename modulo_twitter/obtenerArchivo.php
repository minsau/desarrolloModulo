<?php
	session_start();
	$path = '../lib/';
	require_once($path.'baseDatos/conexion.php');
	$idArchivo = $_GET['id'];
	$sql = "SELECT * FROM Files WHERE id = '$idArchivo'";
	$resultado = mysqli_query($conexion,$sql) or die("Error obteniendo archivo".mysqli_error($conexion));
	$datos = mysqli_fetch_array($resultado);
 
    $archivo = $datos['archivo']; // Datos binarios de la imagen.
    $tipo = $datos['tipo'];  // Mime Type de la imagen.
    // Mandamos las cabeceras al navegador indicando el tipo de datos que vamos a enviar.
    //if($tipo == "application/force-download"){
    //	$tipo = "application/pdf";
    //}
    //echo "$tipo";
    header("Content-type: $tipo");
    // A continuación enviamos el contenido binario de la imagen.
    echo $archivo;


?>