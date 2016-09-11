<?php
	session_start();
	$path = '../lib/';

	function consultarTablas($path){
		require_once($path."baseDatos/conexion.php");
		$base = 'linea';
		$sql = "SELECT TABLE_NAME as nombre FROM INFORMATION_SCHEMA.tables WHERE TABLE_SCHEMA='$base'";
		$res = mysqli_query($conexion,$sql) or die("Error obteniendo tablas".mysqli_error($conexion));
		$data = [];
		while($reg = mysqli_fetch_assoc($res)){
			$data[] = $reg;
		}
		return $data;
	}

	function datosTablas($path,$tabla){
		require_once($path."baseDatos/conexion.php");
		//$base = 'admin';
		$sql = "SELECT * FROM $tabla";
		$res = mysqli_query($conexion,$sql) or die("Error obteniendo tablas".mysqli_error($conexion));
		$data = [];
		while($reg = mysqli_fetch_assoc($res)){
			$data[] = $reg;
		}
		return $data;
	}

    $data = json_decode(file_get_contents('php://input'), true);
	$op = $data['op'];

	if($op == 1){
		$resultado = consultarTablas($path);
		print json_encode($resultado);	
	}

	if ($op == 2) {
		$tabla = $data['tabla'];
		$resultado = datosTablas($path,$tabla);
		print json_encode($resultado);
	}
		
?>