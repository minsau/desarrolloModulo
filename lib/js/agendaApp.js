'use strict'
var angular_model = angular.module('agendaApp',[]);

angular_model.controller('agendaController', function($scope,$http){
	var show = 0;
	$scope.dia ="";
	$scope.eventos = [];
	//$scope.evento = [];
	$scope.mensaje ="";
	$scope.mensajeEvento ="";
	$scope.files = {};
	$scope.claves = {};
	$scope.archivo = "";
	$scope.nuevoEvento = function(){
		$('#cargarEventos').hide();
		$('#nuevoEvento').show();		
	}

	$scope.mostrarEventos = function(){
		$('#nuevoEvento').hide();
		$('#cargarEventos').show();
		$http.post('agenda.php',{op:3}).success(function(res){
			$scope.events = res;
		});
	}

	$scope.obtenerFile = function(idFile){
		//$http.get('obtenerArchivo.php?id='+idFile).success(function(dato){
			$scope.archivo = 'obtenerArchivo.php?id='+idFile;
		//});
	}


	$scope.mostrarTwits  = function(){
		//console.log("Entro")
		if(show == 0){
			$('#menuAgenda').removeClass('col-md-offset-7');
			$('#menuAgenda').addClass('col-md-offset-1');
			$('#twits').show('fast');
			show = 1;
		}else{
			$('#menuAgenda').removeClass('col-md-offset-1');
			$('#menuAgenda').addClass('col-md-offset-7');
			$('#twits').hide('fast');
			show = 0;
		}
		
	}

	$scope.eventosDia = function (dia){
		//console.log(dia);
		$('#calendar').hide();
		$('#actividadesDia').show();
		activar('#agenda');
		//$('#actividadesDia').html(dia);

		$http.post('agenda.php',{op:1,dia:dia}).success(function(data){
			if(data == -1){
				$('#tituloEventos').html("No hay eventos aún");
			}else{
				$('#tituloEventos').html("Eventos del dia "+formatoFecha(dia));
				$scope.eventos = data;
				console.log(data);
			}
			
		});
	}

	$scope.guardarEvento = function(){

		if($scope.evento){
			var titulo = $scope.evento.titulo;
			var descripcion = $scope.evento.descripcion;
			var lugar = $scope.evento.lugar;
			var fecha_inicio = $('#fecha_inicio').val();
			var fecha_fin = $('#fecha_fin').val();
			$http.post('agenda.php',{
				op:2,
				titulo: titulo,
				descripcion: descripcion,
				lugar: lugar,
				inicio: fecha_inicio,
				final: fecha_fin
			}).success(function(res){
				$scope.resultado = res;
				if($scope.resultado.hecho == 1){
					$scope.mensaje = $scope.resultado.mensaje;
					console.log(res);
				}else{
					$scope.mensaje = "Hubo un error";
					console.log(res);
				}
			});
		}else{
			$scope.mensaje = "El formulario no puede ir vacio";
		}
	}

	$scope.files = function(idEvento){
		console.log(idEvento);
		$scope.mensajeEvento = idEvento;
		$('#formArchivos').show();
	}

	$scope.verArchivos = function (idEvento){
		console.log(idEvento);
		
		$http.post('agenda.php',{op:5,id:idEvento}).success(function(res){
			$scope.files = res;
			//console.log($scope.files);
			$("#archivosEvento").show();
			if($scope.files.hecho == 1){
				$http.post('agenda.php',{op: 6, id: idEvento}).success(function(datos){
					$scope.claves = datos;
					console.log(datos);
				})
			}
		});
	}
});

function activar(seleccion){

	if(seleccion == '#agenda'){
		$('#calendar').hide();
		$('#actividadesDia').show();
	}

	if(seleccion == '#calendario'){
		$('#actividadesDia').hide();
		$('#calendar').show();
	}
	$('li').removeClass('active');
	$('a').removeClass('active');
	$(seleccion).addClass('active');
	
}

function formatoFecha(fecha){
	var arrayFecha = fecha.split('-');
	var mes = "";
	var fecha ="";
	if(arrayFecha[1] == 1){
		mes = 'Enero';
	}
	if(arrayFecha[1] == 2){
		mes = 'Febrero';
	}
	if(arrayFecha[1] == 3){
		mes = 'Marzo';
	}
	if(arrayFecha[1] == 4){
		mes = 'Abril';
	}
	if(arrayFecha[1] == 5){
		mes = 'Mayo';
	}
	if(arrayFecha[1] == 6){
		mes = 'Junio';
	}
	if(arrayFecha[1] == 7){
		mes = 'Julio';
	}
	if(arrayFecha[1] == 8){
		mes = 'Agosto';
	}
	if(arrayFecha[1] == 9){
		mes = 'Septiembre';
	}
	if(arrayFecha[1] == 10){
		mes = 'Octubre';
	}
	if(arrayFecha[1] == 11){
		mes = 'Noviembre';
	}
	if(arrayFecha[1] == 12){
		mes = 'Diciembre';
	}

	fecha = "<strong>"+arrayFecha[2] + " de "+mes+" de "+arrayFecha[0]+"</strong>";
	return fecha;
}

