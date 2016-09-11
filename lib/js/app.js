'use strict'

var angular_model = angular.module('adminApp', [ ]);

angular_model.controller('adminController',function($scope,$http){
	$scope.clave = "";
	$scope.mensajes = "";
	$scope.permisos = [];
	$scope.checkPermisos = {};
	$scope.resultado = [];
	$scope.gClave ="";
	$http.post('usuarios.php',{op:1}).success(function(data){
			$scope.personas = data;
	});

	$scope.generarClave = function(accion,idUser){
		if(accion == 1){
			$http.post('funciones.php',{op : 1}).success(function(pass){
				$scope.clave = pass;
				$('#passShow').append($scope.clave.pass);
				$('#generar').hide();
				//$('#generar').hide();
			});			
		}

		if (accion == 2) {
			$http.post('funciones.php',{op : 1}).success(function(pass){
				$scope.clave = pass;
				var label = '#pass_'+idUser;

				$http.post('usuarios.php',{op: 5, id: idUser,pass: $scope.clave.pass}).success(function(res){
					$scope.gClave = res;
					console.log(res);
					if($scope.gClave.hecho == 1){
						$(label).html($scope.clave.pass);
					}else{
						console.log(gClave);
						$(label).html('Error');
					}
				});
								
			});	
		}

	}

	$scope.registrarUsuario = function(){
		
		
		if(!$scope.usuario){
			$scope.mensajes = "El formulario no puede ir vacio";
			$('#mensajes').addClass('alert alert-danger');
		}else{
			if(!$scope.usuario.nombre || !$scope.usuario.paterno || !$scope.usuario.materno || !$scope.usuario.cargo || $scope.clave == ""){
				$scope.mensajes = "Alguno de los campos esta vacio, por favor revise";
				$('#mensajes').addClass('alert alert-danger');
			}else{
				$http.post('usuarios.php',{op : 4,
						nombre:$scope.usuario.nombre,
						aPaterno: $scope.usuario.paterno,
						aMaterno: $scope.usuario.materno,
						cargo : $scope.usuario.cargo,
						clave : $scope.clave.pass
					 }).success(function(res){

						$scope.resultado = res;
						$scope.mensajes = $scope.resultado.mensajeUser;
						console.log(res);
						$('#mensajes').removeClass('alert alert-danger');
						$('#mensajes').addClass('alert alert-success');
				});
				
			}
		}

	}

	$scope.obtenerPermisos = function(idm){
		console.log(idm);
		$('#resultado').hide();
		$http.post('usuarios.php',{op:2, id: idm}).success(function(data){
			$scope.permisos = data;


			console.log($scope.permisos.length);

			for(var i = 0; i < $scope.permisos.length; i++){
				console.log($scope.permisos[i].id + " " + $scope.permisos[i].nombreLugar + " " + $scope.permisos[i].estado);
				if ($scope.permisos[i].id == 1) {
					if($scope.permisos[i].estado == 1){
						$scope.checkPermisos.biblioteca = true;
					}else{
						$scope.checkPermisos.biblioteca = false;
					}
				}

				if ($scope.permisos[i].id == 2) {
					if($scope.permisos[i].estado == 1){
						$scope.checkPermisos.centroComputo = true;
					}else{
						$scope.checkPermisos.centroComputo = false;
					}
				}

				if ($scope.permisos[i].id == 3) {
					if($scope.permisos[i].estado == 1){
						$scope.checkPermisos.laboratorio = true;
					}else{
						$scope.checkPermisos.laboratorio = false;
					}
				}

				if ($scope.permisos[i].id == 4) {
					if($scope.permisos[i].estado == 1){
						$scope.checkPermisos.direccion = true;
					}else{
						$scope.checkPermisos.direccion = false;
					}
				}
			}

			$('#personasContainer').removeClass('col-md-12');
			$('#personasContainer').addClass('col-md-8');
			$('#permisosContainer').show();
		});


	}

	$scope.guardarPermiso = function (idLugar,idUser){
		
		console.log("id Usuario" + idUser);
		console.log($scope.checkPermisos.biblioteca);
		console.log($scope.checkPermisos.centroComputo);
		console.log($scope.checkPermisos.laboratorio);
		console.log($scope.checkPermisos.direccion);
		var estado = 0;
		if(idLugar == 1) {estado = $scope.checkPermisos.biblioteca};
		if(idLugar == 2) {estado = $scope.checkPermisos.centroComputo};
		if(idLugar == 3) {estado = $scope.checkPermisos.laboratorio};
		if(idLugar == 4) {estado = $scope.checkPermisos.direccion};

		$http.post('usuarios.php',{
			op:3,
			id: idUser,
			lugar: idLugar,
			state: estado }).success(function(res){
			$scope.resultado = res;

			if($scope.resultado.hecho == 1){
				$('#resultado').show();
				$('#resultado').removeClass('alert alert-danger');
				$('#resultado').addClass('alert alert-success');
				
				//$('#resultado').hide('slow');
			}else{
				$('#resultado').removeClass('alert alert-succes');
				$('#resultado').addClass('alert alert-danger');
				
			}
		});
	}

});

function wait(ms){
   var start = new Date().getTime();
   var end = start;
   while(end < start + ms) {
     end = new Date().getTime();
  }
}

function cerrarPermisos(){
	$('#permisosContainer').hide();
	$('#personasContainer').removeClass('col-md-8');
	$('#personasContainer').addClass('col-md-12');
}