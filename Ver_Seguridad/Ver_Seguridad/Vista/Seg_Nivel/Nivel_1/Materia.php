<html lang="en">
	<head> 
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!--Responsive-->
    </head>
	<body>
		<div class="container">
				<h2 class="page-header" style="background-color:#6b6bec;color:white;">Materias</h2>
				<form class="form-inline" role="search" id="buscar" style="float:left;">
					<div class="form-group">
						<input type="text" name="busqueda" class="form-control" placeholder="Buscar" onkeyup="bus();" id="busc">
					</div>
					<button type="submit" class="btn btn-default">
						&nbsp;<i class="glyphicon glyphicon-search"></i>&nbsp;
					</button>
					<a data-toggle="modal" href="#Modal" class="btn btn-default">Agregar</a>
				</form>

				<br>
				<!-- Modal -->
				<div class="modal fade" id="Modal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;	</button>
								<h4 class="modal-title">Agregar</h4>
							</div>
							<div class="modal-body">
								<form role="form" id="agregar" method="post">
									<div class="form-group">
										<label for="nombre">Nombre</label>
										<input type="text" class="form-control" name="nombre">
									</div>	
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">
											Agregar
										</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">
											Cancelar
										</button>
									</div>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->

  <div class="modal fade" id="ModalA" role="dialog" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Lista</h4>
        </div>
        <div class="modal-body">
        <div id="tabla-lista"></div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

				<div id="tabla"></div> 
		</div>

		<script type="text/javascript">
			$('#agregar').submit(function(e) {
				e.preventDefault();
				$.post('Controlador/Materia/AgregarMat.php', $('#agregar').serialize(), function(data) {
					if (!data) {
						swal('Ups...', 'Algo sali?? mal!', 'error')
					} else {
						$('#agregar')[0].reset();
						$('#Modal').modal('hide');
						$('#tabla').html('');
						swal('??xito!','El registro se ha guardado!','success')
						CargarTabla(1);
					}
				});
			});

			$('.btn-listado').click(function() {
				$.get('Controlador/Materia/Tabla_ListaAsignacion.php'),function(data){
						$("#tabla-lista").html('');
					};
					   	$('#ModalA').modal('hide');			
				});
			
			$('#tabla-lista').click(function(e) {
				e.preventDefault();
				$.get('Controlador/Materia/Tabla_ListaAsignacion.php', $('#tabla-lista').serialize(), function(data) {
						$('#ModalA').modal('hide');
						$('#tabla-lista').html('');
				});
			});

			function CargarTabla(pagina) {
				var parametros = {
					"pagina" : pagina
				};
				$("#animacion").fadeIn('slow');
				$.ajax({
					url : 'Vista/Seg_Nivel/Nivel_1/TablaMat.php',
					data : parametros,
					success : function(data) {
						$("#tabla").html(data).fadeIn('slow');
						$("#animacion").html("");
					}
				})
			}

			$(document).ready(function(){
			 CargarTabla(1); 
			});

			$('#buscar').submit(function(e) {
				e.preventDefault();
				$.get('Controlador/Materia/BuscarMat.php', $('#buscar').serialize(), function(data) {
					$('#tabla').html(data);
				});
			});

			function bus() {
				var par = {
					'busqueda' : $('#busc').val()
				};
				$.ajax({
					url : "Controlador/Materia/BuscarMat.php",
					data : par,
					success : function(data) {
						$('#tabla').html(data);
					}
				})
			}
		</script>
	</body>
</html>