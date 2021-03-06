<?php include "Controlador/AsistClase/ListarAsistClase.php";

if($result->num_rows>0):?>
<table class="table table-bordered table-hover">
<thead>
  <th>Id</th>
  <th>Fecha</th>
  <th>Hora</th>
  <th>Estado</th>
  <th>Materia</th>
	<th></th>
</thead>
<?php while ($r=$result->fetch_array()):?>
<tr>
  <td><?php echo $r["Id"]; ?></td>
  <td><?php echo $r["Fecha"]; ?></td>
  <td><?php echo $r["Hora"]; ?></td>  
  <td><?php echo $r["Estado"]; ?></td>
  <td><?php echo $r["Id_Materia"]; ?></td>

	<td style="width:150px;">
    <a data-id="<?php echo $r["Id"]; ?>" class="btn btn-edit btn-sm btn-warning" style="width:60px">Editar</a>
    <a href="#" id="bor-<?php echo $r["Id"]; ?>" class="btn btn-sm btn-danger" style="width:60px">Eliminar</a>
    <script>
    		$('#bor-'+<?php echo $r['Id']?>).click(function(e){
      e.preventDefault();
      p = confirm('¿Está Seguro?');
      if(p){$.get('./Controlador/AsistClase/EliminarAsistClase.php','idA='+<?php echo $r['Id']?>
		,function(status) {
			$('#tabla').html('');
			CargarTabla();
		});}
		});
</script>
      </td>
</tr>
<?php endwhile; ?>
</table>
<?php else: ?>
  <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>
<script>
	$(".btn-edit").click(function() {
		id = $(this).data("id");
		$.get("./Controlador/AsistClase/Formulario_Editar_AsistClase.php", "idA=" + id, function(data) {
			$("#form-Editar").html(data);
		});
		$('#editModal').modal('show');
	}); 
</script>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Actualizar</h4>
        </div>
        <div class="modal-body">
        <div id="form-Editar"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->