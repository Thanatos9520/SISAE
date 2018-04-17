<?php 
require_once '../../../Modelo/GradoCl12.php';
$pagina = $_REQUEST['pagina'];
$por_pagina = 10;
$inicio = ($pagina -1)*$por_pagina;
$gra = new GradoCl12(); 
$result = $gra->GradoCl12_ListaGra($inicio,$por_pagina);
$total = $gra->GradoCl12_Cantidad(); 
$total_botones = ceil($total/$por_pagina);
if($total>$por_pagina):?>
<div class="table-pagination pull-right">
  <div class="scrollmenu" style="overflow:auto;white-space:nowrap;max-width:140px;">
  <?php for($i=1;$i<=$total_botones;$i++):?>
    <a type="submit" class="btn btn-pag btn-xs btn-default" style="font-size:10px;" data-id="<?php echo $i; ?>"><?php echo $i; ?>
    </a>  
  <?php endfor; ?>
</div>
</div> 
<?php endif; ?>
<label style="float:right;margin-right:8px;">Total <?php echo $total; ?></label>

<table class="table table-bordered table-hover" style="font-size:13px;" id="Grad">
<thead>
  <th>Id</th>
  <th>Grado</th>
  <th>Bachiller</th>
  <th>Opciones</th>
</thead>
<?php while ($r=$result->fetch_array()){
?>
<tr> 
  <td><?php echo $r["id_grado"]; ?></td>
  <td><?php echo $r["Nombre"]; ?></td>
  <td><?php echo $r["Bachiller"]; ?></td>
  <td style="width:150px;">
    <a data-id="<?php echo $r["id_grado"]; ?>" class="btn btn-edit btn-sm btn-warning" style="width:60px">Editar</a>
    <a href="#" id="bor-<?php echo $r["id_grado"]; ?>" class="btn btn-sm btn-danger" style="width:60px">Eliminar</a>
    <script>
    		$('#bor-'+<?php echo $r['id_grado']?>).click(function(e){
       e.preventDefault();
      swal({
        title: '¿Está seguro?',
        text: "No se puede recuperar el dato!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar',
        }).then(function () {
          swal({
  title: 'Procesando',
  text: 'Su petición se esta procesando',
  imageUrl: './Public/img/Loading.gif',
  showConfirmButton:false,
  imageWidth: 130,
  animation:false,
});
          //ELIMINA
      $.ajax({
      url:'Controlador/Grado/EliminarGrado.php',
      type:'GET',
      data:'id='+<?php echo $r['id_grado']?>,
      success:function(data){
    if(data!=1){swal('Ups...', 'Algo salió mal!', 'error')}
    else{
    $('#tabla').html('');
    CargarTabla(<?php echo $pagina; ?>
		);
		swal('Eliminado!','El registro fue eliminado.','success')
		}
		}
		});
		});
		});
</script>
      </td>
</tr>
<?php } ?>
</table>

<script>
	$(".btn-edit").click(function() {
		id = $(this).data("id");
		$.get("Controlador//Grado/Formulario_Editar_Grado.php", "id=" + id, function(data) {
			$("#form-Editar").html(data);
		});
		$('#Modal_Editar').modal('show');
	});

	$(".btn-pag").click(function(e) {
		pg = $(this).data("id");
		CargarTabla(pg);
	}); 
</script>
<script src="assets/datatables/js/dataTableGrad.js" type="text/javascript"></script>
<div class="modal fade" id="Modal_Editar" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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