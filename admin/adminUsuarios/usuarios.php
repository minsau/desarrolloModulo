<?php
	
	function mostrarUsuarios(){
		require_once("../../lib/baseDatos/conexion.php");
		$sql = "SELECT * FROM Usuario";
		$res = mysqli_query($con, $sql) or die ("error al insertar "+mysqli_connect_error());
		$data = [];
		while($reg = mysqli_fetch_assoc($res)){
			$data[] = $reg;
		}
		return $data;
	}


	function mostrarPermisos($id){
		require_once("../../lib/baseDatos/conexion.php");
		$sql = "SELECT * FROM Permiso as a , Lugar as b WHERE a.idUsuario = '$id' and a.idLugar = b.id";
		$res = mysqli_query($con, $sql) or die ("error al insertar "+mysqli_connect_error());
		$data = [];
		while($reg = mysqli_fetch_assoc($res)){
			$data[] = $reg;
		}

		return $data;
	}

	function guardarPermisos($idUser,$lugar,$estado){
		require_once("../../lib/baseDatos/conexion.php");
		$sql = "UPDATE Permiso set estado = '$estado' where idUsuario = '$idUser' and idLugar = '$lugar'";
		$res = mysqli_query($con, $sql) or die ("error al insertar "+mysqli_connect_error());
		$data = [];
		
		if($res){
			$data['hecho'] = 1;
			$data['mensaje'] = 'Cambio guardado';
		}else{
			$data['hecho'] = -1;
			$data['mensaje'] = 'Hubo un error';
		}

		return $data;
	}

	function registrarUsuario($nombre,$aPaterno,$aMaterno,$cargo,$clave){
		require_once("../../lib/baseDatos/conexion.php");
		$sql = "INSERT INTO Usuario VALUES (null,'$nombre','$aPaterno','$aMaterno','$cargo','$clave',now(),DATE_ADD(now(), INTERVAL 60 MINUTE))";
		$res = mysqli_query($con, $sql) or die ("error al insertar "+mysqli_connect_error());
		$data = [];
		
		if($res){
			$data['hecho'] = 1;
			$data['mensajeUser'] = 'Usuario guardado';
			$sql = "SELECT * from Usuario order by id desc limit 1";
			$res = mysqli_query($con, $sql) or die ("error al obtener registros "+mysqli_connect_error());
			if($reg = mysqli_fetch_assoc($res)){
				$data['mensajePermiso'] = 'No se han guardado permisos';
				$idUser = $reg['id'];
				$sqlPermiso = "INSERT INTO Permiso VALUES (null,'$idUser',1,1,now())";
				$res = mysqli_query($con, $sqlPermiso) or die ("error al guardar registros "+mysqli_connect_error());
				$sqlPermiso = "INSERT INTO Permiso VALUES (null,'$idUser',2,0,now())";
				$res = mysqli_query($con, $sqlPermiso) or die ("error al guardar registros "+mysqli_connect_error());
				$sqlPermiso = "INSERT INTO Permiso VALUES (null,'$idUser',3,0,now())";
				$res = mysqli_query($con, $sqlPermiso) or die ("error al guardar registros "+mysqli_connect_error());
				$sqlPermiso = "INSERT INTO Permiso VALUES (null,'$idUser',4,0,now())";
				$res = mysqli_query($con, $sqlPermiso) or die ("error al guardar registros "+mysqli_connect_error());
				$data['mensajePermiso'] = 'Permisos guardados';
			}
		}else{
			$data['hecho'] = -1;
			$data['mensajeUser'] = 'Hubo un error al registrar el usuario';
		}


		return $data;
	}

	function actualizarPass($idUser,$pass){
		require_once("../../lib/baseDatos/conexion.php");
		$sql = "UPDATE Usuario set clave = '$pass', inicioClave = now(), finClave = DATE_ADD(now(), INTERVAL 60 MINUTE) WHERE id = '$idUser'";
		$res = mysqli_query($con, $sql) or die ("error al insertar "+mysqli_connect_error());
		$data = [];
		
		if($res){
			$data['hecho'] = 1;
			$data['mensaje'] = 'Cambio guardado';
		}else{
			$data['hecho'] = -1;
			$data['mensaje'] = 'Hubo un error';
		}

		return $data;

	}

	//$data = json_decode(file_get_contents('php://input'), true);
	$op = $_GET['op'];

	if($op == 1){
		$users = mostrarUsuarios();
		print json_encode($users);
	}

	if($op == 2){
		$id = $data['id'];
		$permisos = mostrarPermisos($id);
		print json_encode($permisos);
	}

	if($op == 3){
		$id = $data['id'];
		$estado = $data['state'];
		$lugar = $data['lugar'];
		$resultado = guardarPermisos($id,$lugar,$estado);
		print json_encode($resultado);
	}
	
	if($op == 4){
		$nombre = $data['nombre'];
		$aPaterno = $data['aPaterno'];
		$aMaterno = $data['aMaterno'];
		$cargo = $data['cargo'];
		$clave = $data['clave'];
		$resultado = registrarUsuario($nombre,$aPaterno,$aMaterno,$cargo,$clave);
		print json_encode($resultado);
	}

	if($op == 5){
		$id = $data['id'];
		$pass = $data['pass'];
		$resultado = actualizarPass($id,$pass);
		print json_encode($resultado);

	}
?>