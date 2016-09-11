<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es" ng-app="sesionesApp">
<head>
	<meta charset="UTF-8">
	<title>Biblioteca</title>
	<link rel="stylesheet" type="text/css" href="../../lib/css/bootstrap.css">
</head>
<body ng-controller="sesionesController" ng-init="validar(3)">

	<?php
		echo $_SESSION['id']."<br>";
		echo $_SESSION['pass']."<br>";
	?>

	

	<script type="text/javascript" src="../../lib/js/jquery.js"></script>
	<script type="text/javascript" src="../../lib/js/bootstrap.js"></script>
	<script type="text/javascript" src="../../lib/js/angular.js"></script>
	<script type="text/javascript" src="../../lib/js/validarSesiones.js"></script>

</body>
</html>