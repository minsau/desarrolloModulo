<!DOCTYPE html>
<html lang="en" ng-app="loginApp">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../../lib/css/bootstrap.css">
</head>
<body ng-controller="loginController">

	<div id="formLogin" class="col-md-6 col-md-offset-3" >
		<div class="panel panel-default">
			<div class="panel-heading">
				Ingresar al sistema
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="idUsuario">ID:</label>
					<input type="text" name="idUsuario" class="form-control" ng-model="usuario.idUsuario">
				</div>
				
				<div class="form-group">
					<label for="pass">Password:</label>
					<input type="password" name="pass" class="form-control" ng-model="usuario.pass">
				</div>			
				
				<div class="alertas">
					{{login.mensaje}}
				</div>
				<button id="ingresar" ng-click="loguear()">Ingresar</button>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="../../lib/js/jquery.js"></script>
	<script type="text/javascript" src="../../lib/js/bootstrap.js"></script>
	<script type="text/javascript" src="../../lib/js/angular.js"></script>
	<script type="text/javascript" src="../../lib/js/loginApp.js"></script>
</body>
</html>