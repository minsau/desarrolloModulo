'use strict'

var angular_model = angular.module('sesionesApp', [ ]);

angular_model.controller('sesionesController',function($scope,$http,$interval){
	$scope.sesion = [];
	$scope.tiempo = "";
	var con = 60;
	$interval(function () {
        $scope.tiempo = con;
        con--;
        if(con == 20){
        	alert("Su sesion esta apunto de expirar");
        }
        if(con == 0){
        	$http.post('funciones.php',{op: 4}).success(function(res){
        		$scope.resultado = res;
        		window.location.href = 'login.php';
        	});
        }
    }, 1000);

	$scope.validar = function(idLugar){
		$http.post('funciones.php',{op: 3, id: idLugar }).success(function(res){
			$scope.sesion = res;
			console.log($scope.sesion);
			console.log($scope.sesion.permitido);
			if($scope.sesion.permitido == -1){
				window.location.href = 'forbiden.php';
			}

			if($scope.sesion.permitido == 0){
				alert("Tienes que iniciar sesion");
				window.location.href = 'login.php';
			}

		});
		console.log(idLugar);
	}
});