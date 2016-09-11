<?php
	session_start();
	$path = '../lib/';
	function mostrarEventos($dia,$path){		
		require_once($path.'baseDatos/conexion.php');
		$sql = "SELECT * FROM Evento WHERE DATE(inicio) = '$dia'";
		$res = mysqli_query($conexion,$sql) or die("Error obteniendo eventos".mysqli_error($conexion));
		$data = [];

		if(mysqli_num_rows($res)>0){
			while($reg = mysqli_fetch_assoc($res)){
				$data[] = $reg;
			}
		}else{
			$data = -1;
		}
		

		return $data;
	}

	function guardarEvento($path,$titulo,$descripcion,$lugar,$inicio,$final){
		require_once($path.'baseDatos/conexion.php');
		$sql = "INSERT INTO Evento VALUES (null,'$titulo','$descripcion','$lugar','$inicio','$final')";
		$res = mysqli_query($conexion,$sql) or die("Error insertando evento".mysqli_error($conexion));
		$data = [];
		if($res){
			$data['hecho'] = 1;
			$data['mensaje'] = 'Evento guardado'.$final;
		}else{
			$data['hecho'] = -1;
			$data['mensaje'] = 'No se pudo guardar el evento';			
		}

		return $data;
	}

	function eventosConcluidos($path){		
		require_once($path.'baseDatos/conexion.php');
		$sql = "SELECT * FROM Evento WHERE final < now()";
		$res = mysqli_query($conexion,$sql) or die("Error obteniendo eventos".mysqli_error($conexion));
		$data = [];

		if(mysqli_num_rows($res)>0){
			while($reg = mysqli_fetch_assoc($res)){
				$data[] = $reg;
			}
		}else{
			$data = -1;
		}
		

		return $data;
	}

	function eventoConcluido($path,$id){		
		require_once($path.'baseDatos/conexion.php');
		$sql = "SELECT * FROM Evento WHERE final < now() and id = '$id'";
		$res = mysqli_query($conexion,$sql) or die("Error obteniendo eventos".mysqli_error($conexion));
		$data = [];

		if(mysqli_num_rows($res)>0){
			$data['hecho'] = 1;
			$data['mensaje'] = 'De click sobre algun boton para cargar el documento';
		}else{
			$data['hecho'] = -1;
			$data['mensaje'] = 'Aún no hay archivos sobre este evento';
		}
		

		return $data;
	}

	function guardarArchivo($path,$archivo){
			$id = "";
			$conexion = mysqli_connect("localhost", "root", "esasistemas", "events");
			if (mysqli_connect_errno()) {
    			printf("Conexión fallida: %s\n", mysqli_connect_error());
   				 exit();
			}
			mysqli_query($conexion,"SET NAMES 'utf8'");            
            $archivo_temporal = $archivo['tmp_name'];
            $tipo = $archivo['type'];
            if($tipo == "application/force-download"){
    			$tipo = "application/pdf";
    		}
            $name = $archivo['name'];
            $fp = fopen($archivo_temporal, 'r+b');
            $data = fread($fp, filesize($archivo_temporal));
            fclose($fp);
            $data = mysqli_real_escape_string($conexion,$data);
            $sql = "INSERT INTO Files VALUES (null,'$data','$tipo','$name')";
            $resultado = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
            if ($resultado)
            {
            	$sqlID = "SELECT id FROM Files order by id desc limit 1";
            	$resID = mysqli_query($conexion, $sqlID) or die(mysqli_error($conexion));
            	if($regid = mysqli_fetch_array($resID)){
            		$id = $regid['id'];
            	}
                echo "El archivo ha sido copiado exitosamente.";
            }
            else
            {
                echo "Ocurrió algun error al copiar el archivo.";
                $id=-1;
            }
            mysqli_close($conexion);
            return $id;       
    }

    function obtenerClavesDocumentos($path,$idEvento){
    	require_once($path.'baseDatos/conexion.php');
    	$sql = "SELECT * FROM DocumentosAgenda WHERE idEvento = '$idEvento'";
		$res = mysqli_query($conexion,$sql) or die("Error obteniendo eventos".mysqli_error($conexion));
		$data = [];

		if(mysqli_num_rows($res)>0){
			while($reg = mysqli_fetch_assoc($res)){
				$data[] = $reg;
			}
		}else{
			$data = -1;
		}

		return $data;

    }

    if($_POST){
    	$op = $_POST['op'];
    }else{
    	$data = json_decode(file_get_contents('php://input'), true);
		$op = $data['op'];
    }


	if($op == 1){
		$dia = $data['dia'];
		$resultado = mostrarEventos($dia,$path);
		print json_encode($resultado);
	}

	if($op==2){
		$titulo = $data['titulo'];
		$descripcion = $data['descripcion'];
		$lugar = $data['lugar'];
		$inicio = $data['inicio'];
		$final = $data['final'];
		$resultado = guardarEvento($path,$titulo,$descripcion,$lugar,$inicio,$final);
		print json_encode($resultado);
	}

	if($op == 3){
		$resultado = eventosConcluidos($path);
		print json_encode($resultado);
	}
	if($op==4){
		require_once($path.'baseDatos/conexion.php'); 
		$id = $_POST['idEvento'];
		$ordenDia = $_FILES['ordenDia'];
		$gaseta = $_FILES['gaseta'];
		$asistencias = $_FILES['asistencias'];
		$votaciones = $_FILES['votaciones'];
		$debates = $_FILES['debates'];
		$numeralia = $_FILES['numeralia'];
		$estenografia = $_POST['estenografia'];
		
		$idordenDia = guardarArchivo($path,$ordenDia);
		$idgaseta = guardarArchivo($path,$gaseta);
		$idasistencias = guardarArchivo($path,$asistencias);
		$idvotaciones = guardarArchivo($path,$votaciones);
		$iddebates = guardarArchivo($path,$debates);
		$idnumeralia = guardarArchivo($path,$numeralia);

		$sql = "INSERT INTO DocumentosAgenda VALUES (null,'$id','$idordenDia','$idgaseta','$idasistencias','$idvotaciones','$estenografia','$iddebates','$idnumeralia')";
		//echo "$sql";
		$result = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

		if($result){
			header("Location: adminAgenda.php");
		}else{
			echo "Hubo un error al guardar los documentos";
		}
		//echo "$id";
		//echo $ordenDia['name'];
	}

	if($op == 5){
		$id = $data['id'];
		$resultado = eventoConcluido($path,$id);
		print json_encode($resultado);
	}

	if($op == 6){
		$idEvento = $data['id'];
		$resultado = obtenerClavesDocumentos($path,$idEvento);
		print json_encode($resultado);
	}

?>