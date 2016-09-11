<?php
session_start();
function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890/*-+{}[].,~";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);
     
    //Se define la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=10;
     
    //Creamos la contraseña
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos=rand(0,$longitudCadena-1);
     
        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
        $pass .= substr($cadena,$pos,1);
    }

    return $pass;
}


function login($idUser,$pass){
    date_default_timezone_set('America/Mexico_City');
    require_once("../../lib/baseDatos/conexion.php");
    $sql = "SELECT * FROM Usuario WHERE nombre = '$idUser' and clave = '$pass'";
    $res = mysqli_query($con, $sql) or die ("error al consultar "+mysqli_connect_error());
    $data = [];
    if(mysqli_num_rows($res)==1){
        if($reg = mysqli_fetch_array($res)){
            //$interval = date_diff($reg['inicioClave'], $reg['finClave']);
            $actual = date("Y-m-d H:i:00",time());
            //echo $actual." < > ".$reg['finClave'];
            //echo strtotime($reg['finClave']) .">". strtotime($actual)."\n";
            //echo $reg['finClave'] .">". $actual."\n";
             if(strtotime($reg['finClave']) > strtotime($actual)){
                $data['hecho'] = 1;
                //$data['tiempoClave'] = true;
                $data['mensaje'] = 'Se ha logueado correctamente';
                $_SESSION['id'] = $idUser;
                $_SESSION['pass'] = $pass;
                $_SESSION['inicio'] = $actual;
             }else{
                $data['hecho'] = -1;
                //$data['tiempoClave'] = false;
                $data['mensaje'] = 'La contraseña ha expirado, contacte al administrador';
             }
            
        }
    
    }else{
        $data['hecho'] = -1;
        $data['mensaje'] = 'No se encontro la combinación usuario/contraseña';
    }
    
    return $data;
}

function validarSesion($idLugar,$idUsuario){
    require_once("../../lib/baseDatos/conexion.php");
    $sql = "SELECT * FROM Permiso WHERE idLugar = '$idLugar' and idUsuario = '$idUsuario'";
    $res = mysqli_query($con, $sql) or die ("error al consultar "+mysqli_connect_error());
    $data = [];
    if($reg = mysqli_fetch_array($res)){
        if($reg['estado'] == 0){
            $data['permitido'] = -1;
        }else{
            $data['permitido'] = 1;
        }
    }

    return $data;
}

    function destruir(){
        $data['mensaje'] = "Sesion destruida";
        session_destroy();
        return $data;
    }

    $data = json_decode(file_get_contents('php://input'), true);

	$op = $data['op'];

	if($op == 1){
	    $contrasenia['pass'] = generaPass();
		print  json_encode($contrasenia);
	}

    if($op == 2){
        $id = $data['id'];
        $clave = $data['clave'];

        $resultado = login($id,$clave);
        print json_encode($resultado);
    }

    if($op == 3){
        $resultado = [];
        
        if(!isset($_SESSION['id'])){
            $resultado['permitido'] = 0;
        }else{
            $idLugar = $data['id'];
            $idUsuario = $_SESSION['id'];
            $resultado = validarSesion($idLugar,$idUsuario);
        }
        print json_encode($resultado);
    }

    if($op == 4){
        $resultado = destruir();
        print json_encode($resultado);
    }

?>