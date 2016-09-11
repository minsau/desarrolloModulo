<?php
	session_start();
	$path = '../lib/';
?>

<!DOCTYPE html>
<html lang="es" ng-app="agendaApp">
<head>
	<meta charset="UTF-8">
	<title>Administrar Eventos</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/bootstrap.css">
	<link rel='stylesheet' href='<?php echo $path; ?>css/fullcalendar.css' />
	<link rel="stylesheet" href="<?php echo $path; ?>css/bootstrap-datetimepicker.css">
	<style type="text/css">
		#cargarEventos{
			height: 670px;
			border: 1px;
			overflow: scroll;
		}

		#formArchivos{
			height: 670px;
			border: 1px;
			overflow: scroll;
		}
	</style>
</head>
<body ng-controller="agendaController">
	<div class="container">
		<div class="row">
			<a  id = "nuevoEventoBtn" class="btn btn-default btn-sm" onclick="activar('#nuevoEventoBtn')" ng-click="nuevoEvento()">Nuevo Evento</a>
			<a  id = "cargarArchivosBtn" class="btn btn-default btn-sm" onclick="activar('#cargarArchivosBtn')" ng-click="mostrarEventos()">Cargar archivos</a><br><br>

			<div id="nuevoEvento" class = "col-md-6 " style="display: none;">

				<legend>Nuevo Evento</legend>
				<div class="form-group">
					<label for="titulo">Titulo:</label>
			        <input type='text' class="form-control" name='titulo' id='titulo' ng-model="evento.titulo"/>
			    </div>

			    <div class="form-group">
					<label for="descripcion">Descripcion :</label>
					<textarea class="form-control" name='descripcion' id='descripcion' ng-model="evento.descripcion">
						
					</textarea>
			    </div>

			    <div class="form-group">
					<label for="lugar">Lugar:</label>
			        <input type='text' class="form-control" name='lugar' id='lugar' ng-model="evento.lugar"/>
			    </div>

				<div class="form-group">
					<label for="fecha_inicio">Inicio del evento:</label>
			            <div class='input-group date' id='fecha_iniciod'>
					        <input type='text' class="form-control" name="startdate" 
					               id='fecha_inicio' placeholder="yyyy-mm-dd"  required/>
					        <span class="input-group-addon">
					            <span class="glyphicon glyphicon-calendar"></span>
					        </span>
					    </div>
			    </div>

			    <div class="form-group">
					<label for="fecha_inicio">Fin del evento:</label>
			            <div class='input-group date' id='fecha_find'>
					        <input type='text' class="form-control" name="startdate" 
					               id='fecha_fin' placeholder="yyyy-mm-dd"  required/>
					        <span class="input-group-addon">
					            <span class="glyphicon glyphicon-calendar"></span>
					        </span>
					    </div>
			    </div>	

				<div class="alertas">{{mensaje}}</div>
			    <button class="btn btn-large btn-primary" ng-click="guardarEvento()">Guardar evento</button> 	                   
	        </div>
			
			<div id="cargarEventos" class = "col-md-6 " style="display: none;">
				<table class="table">
					<tr ng-repeat="event in events">
						<td>{{event.id}}</td>
						<td>{{event.titulo}}</td>
						<td>{{event.inicio}}</td>
						<td>{{event.lugar}}</td>
						<td><button class="btn btn-default btn-sm" ng-click="files(event.id)"><span class="glyphicon glyphicon-plus" style="color: green;"> </span>Añadir archivos</button></td>
					</tr>
				</table>
			</div>

			<div id="formArchivos" class = "col-md-6 " style="display:none;">
				<form action="agenda.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Orden del dia:</label>
						<input type="file"  id="ordenDia" name="ordenDia" required>
					</div>

					<div class="form-group">
						<label for="">Gaseta:</label>
						<input type="file"  id="gaseta" name="gaseta"  required>
					</div>

					<div class="form-group">
						<label for="">Asistencias:</label>
						<input type="file"  id="asistencias" name="asistencias" required>
					</div>

					<div class="form-group">
						<label for="">Votaciones:</label>
						<input type="file"  id="votaciones" name="votaciones" required>
					</div>

					<div class="form-group">
						<label for="">Versión estenográfica:</label>
						<textarea cols="30" rows="10" class="form-control" name = "estenografia" id="estenografia" required></textarea>
					</div>

					<div class="form-group">
						<label for="">Diario de los debates:</label>
						<input type="file"  id="debates" name="debates" required>
					</div>

					<div class="form-group">
						<label for="">Numeralia legislativa:</label>
						<input type="file"  id="numeralia" name="numeralia" required>
					</div>
					<input type="hidden" name="op" value="4">
					<input type="hidden" name="idEvento" value="{{mensajeEvento}}">
					<input type="submit" name="" value="Guardar">
				</form>
			</div>
				
			
	
		</div>


	</div>







	<script type="text/javascript" src="<?php echo $path; ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/angular.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/upload.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/agendaApp.js"></script>
	<script type="text/javascript" src='<?php echo $path; ?>js/moment.min.js'></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/collapse.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/transition.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/bootstrap-datetimepicker.min.js"></script>
	
	<script type="text/javascript">
        $(function () {
            $('#fecha_inicio').datetimepicker({
            	format: 'Y-MM-DD HH:mm:ss'        		
            });
            $('#fecha_fin').datetimepicker({
            	format: 'Y-MM-DD HH:mm:ss'
            });
        })
    </script>
</body>
</html>