<!DOCTYPE html>
<html lang="es" ng-app="adminApp">
<head>
	<meta charset="UTF-8">
	<title>Area de administración</title>
	<link rel="stylesheet" type="text/css" href="../../lib/css/bootstrap.css">
</head>
<body ng-controller="adminController">
	<div class="container">	

		<!-- Modal -->
		<div id="registroUsuario" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Registro de usuarios</h4>
		      </div>
		      <div class="modal-body">
		        	<div class="form-group">
		        		<label for="nombre">Nombre: </label>
		        		<input type="text" name="nombre" class="form-control" ng-model="usuario.nombre">
		        	</div>

		        	<div class="form-group">
		        		<label for="paterno">Apellido Paterno: </label>
		        		<input type="text" name="paterno" class="form-control" ng-model="usuario.paterno">
		        	</div>

		        	<div class="form-group">
		        		<label for="materno">Apellido Materno: </label>
		        		<input type="text" name="materno" class="form-control" ng-model="usuario.materno">
		        	</div>

		        	<div class="form-group">
		        		<label for="cargo">Cargo: </label>
		        		<input type="text" name="cargo" class="form-control" ng-model="usuario.cargo">
		        	</div>

		        	<div class="form-group">
		        		<label for="clave">Clave: </label>
		        		<a id="passShow"></a>
		        		<button name="Generar" id="generar" ng-click="generarClave(1)" >Generar clave</button>		        		
		        	</div>	        	
		      </div>
		      <div class="modal-footer">
		        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
		        <div id="mensajes">{{resultado.mensajeUser}}</div>
		        <button class="btn btn-success" ng-click="registrarUsuario()">Registrar usuario</button>
		        
		      </div>
		    </div>

		  </div>
		</div>

	<h2 class = "text-primary" >Bienvenido al sitio de administración</h2>
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#registroUsuario">Nuevo Usuario</button>

	<div class="row">
		<div id="personasContainer" class="col-md-12 ">
			<table class="table table-hover">
				<thead >
					<td>Nombre</td>
					<td>Cargo</td>
					<td>Contraseña Actual</td>
					<td></td>
					<td></td>
				</thead>

				<tr ng-repeat="persona in personas">
					<td>{{persona.nombre + " " + persona.apellidoPaterno + " " + persona.apellidoMaterno}}</td>
					<td>{{persona.cargo}}</td>
					<td><label id="{{'pass_'+persona.id}}">{{persona.clave}}</label></td>
					<td><button name="Generar" id="generar" ng-click="generarClave(2,persona.id)" >Generar clave</button></td>
					<td><button name="permisos" id="permisos" ng-click="obtenerPermisos(persona.id)" class="btn btn-danger btn-sm">Asignar permisos</button></td>	
				</tr>
			</table>			
		</div>

		<div class="col-md-3 col-md-offset-1" id="permisosContainer" style="display: none;">
		<h3 class="text-primary">Permisos del usuario</h3>
			<div class="checkbox">
				<label ><input type="checkbox" ng-model="checkPermisos.biblioteca" ng-change = "guardarPermiso(1,permisos[0].idUsuario)" name="">Biblioteca</label>
			</div>
			<div class="checkbox">
				<label ><input type="checkbox" ng-model="checkPermisos.centroComputo" ng-change = "guardarPermiso(2,permisos[0].idUsuario)" name="">Centro de computo</label>
			</div>
			<div class="checkbox">
				<label ><input type="checkbox" ng-model="checkPermisos.laboratorio" ng-change = "guardarPermiso(3,permisos[0].idUsuario)" name="">Laboratorio</label>
			</div>
			<div class="checkbox">
				<label ><input type="checkbox" ng-model="checkPermisos.direccion" ng-change = "guardarPermiso(4,permisos[0].idUsuario)" name="">Dirección</label>
			</div>
			<div id="resultado">
				{{resultado.mensaje}}
			</div>
			<button class="close" id="cerrar" onclick="cerrarPermisos()">Cerrar</button>
		</div>
	</div>

	</div><!-- Fin del div Container -->
	<script type="text/javascript" src="../../lib/js/jquery.js"></script>
	<script type="text/javascript" src="../../lib/js/bootstrap.js"></script>
	<script type="text/javascript" src="../../lib/js/angular.js"></script>
	<script type="text/javascript" src="../../lib/js/app.js"></script>
</body>
</html>