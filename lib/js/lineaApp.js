'use strict'

var angular_model = angular.module('lineaApp',[]);
angular_model.controller('lineaController', function($scope,$http){
	$scope.datosTablas = [];
	$http.post('linea.php',{op:1}).success(function(data){
		$scope.tablas = data;

		for(var i = 0; i < data.length; i++){
			console.log(data[i].nombre);
			$http.post('linea.php',{op:2,tabla:data[i].nombre}).success(function(datos){
				$scope.datosTablas[i] = datos;
				console.log($scope.datosTablas[i]);
			});
		}
		
	});
});