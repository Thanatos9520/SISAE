<?php
if (!empty($_GET)) {  //incluir modelo
	include "../conexion.php";

	$sql = "CALL PaAsistClaseTb18_EliminarAsistClase(\"$_GET[idA]\")";
	$query = $con -> query($sql);
	if (!$con) {print "Fallo";
	}
}
?>