<?php
include "../conexion.php";

$sql1 = "CALL PaProfTb04_BuscarProf($_GET[ced])";
$query = $con -> query($sql1);

if ($query -> num_rows > 0) {
	while ($prof = $query -> fetch_object()) {
		break;
	}
}
?>

<?php if($prof!=null):
?>

<form role="form" id="actualizar" method="post">
	<div class="form-group">
		<label for="cedula">Cedula</label>
		<input type="text" class="form-control" name="cedula" value="<?php echo $prof -> Cedula; ?>" readonly>
	</div>
	<div class="form-group">
		<label for="nombre">Nombre</label>
		<input type="text" class="form-control" name="nombre" value="<?php echo $prof -> Nombre; ?>">
	</div>
	<div class="form-group">
		<label for="Apellido1">1° Apellido</label>
		<input type="text" class="form-control" name="Apellido1" value="<?php echo $prof -> Apellido1; ?>">
	</div>
	<div class="form-group">
		<label for="Apellido2">2° Apellido</label>
		<input type="text" class="form-control" name="Apellido2" value="<?php echo $prof -> Apellido2; ?>">
	</div>
	<div class="form-group">
		<label for="Direccion">Domicilio</label>
		<input type="text" class="form-control" name="direccion" value="<?php echo $prof -> Direccion; ?>">
	</div>
	<div class="form-group">
		<label for="Telefono">Telefono</label>
		<input type="text" class="form-control" name="telefono" value="<?php echo $prof -> Telefono; ?>">
	</div>
	<div class="form-group">
		<label for="email">Correo electronico</label>
		<input type="text" class="form-control" name="email" value="<?php echo $prof -> Email; ?>">
	</div>
	<div class="form-group">
		<label for="Clave">Contraseña</label>
		<input type="password" class="form-control" name="clave" value="<?php echo $prof -> Clave; ?>">
	</div>
	<div class="form-group">
		<label for="fecha_nac">Fecha de Nacimiento</label>
		<div class='input-group date' id='fecha'>
			<input type='text' class="form-control" name="fecha_nac" value="<?php echo $prof -> Fecha_Nac; ?>" readonly>
			<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
		</div>
	</div>
	<input type="hidden" name="id" value="<?php echo $prof -> id; ?>">
	<button type="submit" class="btn btn-default">
		Actualizar
	</button>
</form>

<script>
	$("#actualizar").submit(function(e) {
		e.preventDefault();
		$.post("./Controlador/Profesor/ActualizarProf.php", $("#actualizar").serialize(), function(status) {
		});
		$('#Modal_Editar').modal('hide');
		$('body').removeClass('modal-open');
		$('.modal-backdrop').remove();		  
	});

</script>

<?php else: ?>
<p class="alert alert-danger">
	No se encuentra
</p>
<?php endif; ?>