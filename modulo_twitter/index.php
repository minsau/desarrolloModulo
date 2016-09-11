<?php
	session_start();
	$path = '../lib/';
?>

<!DOCTYPE html>
<html lang="es" ng-app="agendaApp">
<head>
	<meta charset="UTF-8">
	<title>Minuto a minuto</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/bootstrap.css">
	<link rel='stylesheet' href='<?php echo $path; ?>css/fullcalendar.css' />
	
	<style type="text/css">
		#twits{
			height: 720px;
			border: 1px;
			overflow: scroll;
		}
	</style>
</head>
<body id="bodyAgenda" ng-controller="agendaController">
	<div class="container">
		<div class="row">
			<div class="col-md-6" id="twits" style="display:none;">
				<a class="twitter-timeline" data-lang="es" href="https://twitter.com/unoticias?lang=es">Tweets de Jazmin</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>

			<div class="col-md-4 col-md-offset-7" id="menuAgenda">
				<ul class="nav nav-tabs">
				  <li class="active" id="calendario" onclick="activar('#calendario')"><a href="#"><span class="glyphicon glyphicon-calendar"></span></a></li>
				  <li id="agenda" onclick="activar('#agenda')"><a href="#" ><span class="glyphicon glyphicon-tasks"></span></a></li>
				  <li id="minuto" onclick="activar('#minuto')" ng-click="mostrarTwits()"><a href="#"><span class="glyphicon glyphicon-time"></span></a></li>
				</ul>
				<br>
				<div id="calendar"></div>
				<div id="actividadesDia" style="display:none;">
					<div id="tituloEventos"></div>
					<table class="table">
						<tr ng-repeat="evento in eventos">
							<td>
								{{evento.titulo}}
							</td>
							<td>
								{{evento.lugar}}
							</td>
							<td></td>
							<td>
								<button class="btn btn-sm btn-default" ng-click="verArchivos(evento.id)">Ver más</button>
							</td>
						</tr>

					</table>				
				</div>

				<!--<div id="archivosEvento" style="display:none;">{{files.mensaje}}
					<div class="text-center" ng-if="files.hecho==1">
						<a href="obtenerArchivo.php?id={{claves[0].ordenDia}}"   class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Orden del dia</a><br>
						<a href="obtenerArchivo.php?id={{claves[0].gaceta}}"   class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Gaceta</a><br>
						<a href="obtenerArchivo.php?id={{claves[0].asistencias}}"   class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Asistencias</a><br>
						<a href="obtenerArchivo.php?id={{claves[0].votaciones}}"   class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Votaciones</a><br>
						<div>{{claves[0].versionEstenografia}}</div>
						<a href="obtenerArchivo.php?id={{claves[0].debates}}"   class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Diario de los debates</a><br>
						<a href="obtenerArchivo.php?id={{claves[0].numeralia}}"   class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Numeralia legislativa</a><br>
					</div>
				</div>-->

				<div id="archivosEvento" style="display:none;">{{files.mensaje}}
					<div class="text-center" ng-if="files.hecho==1">
						<a ng-click="obtenerFile(claves[0].ordenDia)" class="btn btn-sm btn-default"  data-toggle="modal" data-target="#myModal"> Orden del dia</a><br>
						<a ng-click="obtenerFile(claves[0].gaceta)" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Gaceta</a><br>
						<a ng-click="obtenerFile(claves[0].asistencias)" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Asistencias</a><br>
						<a ng-click="obtenerFile(claves[0].votaciones)" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Votaciones</a><br>
						<div>{{claves[0].versionEstenografia}}</div>
						<a ng-click="obtenerFile(claves[0].debates)" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Diario de los debates</a><br>
						<img ng-click="obtenerFile(claves[0].numeralia)" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"> Numeralia legislativa</a><br>
					</div>
				</div>
				
				<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <iframe ng-src="{{archivo}}" name="ventanaArchivos" style="width:500px; height:375px;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

				
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo $path; ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/angular.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/agendaApp.js"></script>
	<script type="text/javascript" src='<?php echo $path; ?>js/moment.min.js'></script>
	<script type="text/javascript" src='<?php echo $path; ?>js/fullcalendar.js'></script>
	<script type="text/javascript" src='<?php echo $path; ?>js/locale-all.js'></script>
	<script type="text/javascript">
			$(document).ready(function() {
    			// page is now ready, initialize the calendar...
			    $('#calendar').fullCalendar({
			        // put your options and callbacks here
			        locale: 'es',
			        dayClick: function(date, jsEvent, view) {
        				//alert('Clicked on: ' + date.format());
        				angular.element(document.getElementById('bodyAgenda')).scope().eventosDia(date.format());
				        //$(this).css('background-color', 'gray');
				    }
			    })
			});
	</script>

	

</body>
</html>