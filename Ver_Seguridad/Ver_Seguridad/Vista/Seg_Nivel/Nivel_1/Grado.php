<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!--Responsive-->
</head>
<body>
<div class="container">
          <h1 class="page-header" style="background-color:blue;color:white;">Grado</h1>
<form class="form-inline" role="search" id="buscar" style="float:left;">
        <div class="form-group">
          <input type="text" name="busqueda" class="form-control" placeholder="Buscar" onkeyup="bus();" id="busc">
        </div>
        <button type="submit" class="btn btn-default">
          <i class="glyphicon glyphicon-search"></i>
        </button>
        <a data-toggle="modal" href="#Modal" class="btn btn-default">Agregar</a>
      </form>

<br>
 <!-- Modal -->
  <div class="modal fade" id="Modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Agregar</h4>
        </div>
        <div class="modal-body">
<form role="form" id="agregar" method="post">
  <div class="form-group">
    <label for="nombre">Grado</label>
    <input type="text" class="form-control" name="nombre">
  </div>
  <div class="form-group">
    <label for="idbachi">Id Bachiller</label>
    <select class="form-control" name="Grado">
   <?php
   require_once '../../../Modelo/BachillerCl13.php';
                    $bac = new BachillerCl13();
                    $query = $bac -> BachillerCl13_ListaTodo();
                    while ($valores = mysqli_fetch_array($query)) {
                      echo '<option value="' . $valores["id"] . '">' . $valores["Bachiller"] . '</option>';
                    }
                    ?>               
  </select>
  </div>
  <div class="modal-footer">
          <button type="submit" class="btn btn-success">Agregar</button>         
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
  </div>
</form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<div id="tabla"> 
</div>
</div>

<script type="text/javascript">
  $('#agregar').submit(function(e) {
        e.preventDefault();
        $.post('Controlador/Grado/AgregarGrado.php', $('#agregar').serialize(), function(data) {
          if (data != 1) {
            swal('Ups...', 'Algo sali?? mal!', 'error');
          } else {
            $('#agregar')[0].reset();
            $('#Modal').modal('hide');
            $('#tabla').html('');
            CargarTabla(1);
            swal('Agregado!', 'El registro fue agregado.', 'success')
          }
        });
      });

function CargarTabla(pagina){
    var parametros = {"pagina":pagina};
    $("#animacion").fadeIn('slow');
    $.ajax({
      url:'Vista/Seg_Nivel/Nivel_1/TablaGrado.php',
      data: parametros,
      success:function(data){
        $("#tabla").html(data).fadeIn('slow');
        $("#animacion").html("");
      }
    })
  }

$(document).ready(function(){
  CargarTabla(1);
});

function bus() {
        var par = {
          'busqueda' : $('#busc').val()
        };
        $.ajax({
          url : "Controlador/Grado/BuscarGrado.php",
          data : par,
          success : function(data) {
            $('#tabla').html(data);
          }
        })
      }
</script>
</body>
</html>