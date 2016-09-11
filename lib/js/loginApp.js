'use strict'

var angular_model = angular.module('loginApp', [ ]);

angular_model.controller('loginController',function($scope,$http){
	$scope.mensajes = "";
	$scope.login = "";
	$scope.loguear = function(){
		var idU = $scope.usuario.idUsuario;
		var pass = $scope.usuario.pass;

		
			$scope.mensajes = "";
			console.log(idU + " " +pass);
			$http.post('funciones.php',{op:2,id: idU,clave:pass}).success(function(res){
				$scope.login = res;
				console.log(res);
				if($scope.login.hecho == 1){
					window.location.href = 'index.php'
				}
				
			});
		

		

	}
});

function esEntero(x){
	var y = parseInt(x);
	if (isNaN(y)) 
		return false;
	return x == y && x.toString() == y.toString();
}