<?php
	session_start();
	$path = '../lib/';
?>

<!DOCTYPE html>
<html lang="es" ng-app="lineaApp">
<head>
	<meta charset="UTF-8">
	<title>Linea del tiempo</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/bootstrap.css">
	
</head>
<body ng-controller="lineaController">
	

	<div ng-repeat="tabla in tablas">{{tabla.nombre}}




	<script type="text/javascript" src="<?php echo $path; ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/angular.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/timeliner.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/lineaApp.js"></script>

</body>
</html>