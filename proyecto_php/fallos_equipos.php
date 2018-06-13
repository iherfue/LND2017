<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fallos Equipos</title>
    <?php $head = cabecera();?>
</head>
<body>
      <!--Menu-->
    <?php $menu = menu()?>

    <header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Vista General</h2>
          </div>
         </div>
      </div>
    </header>
      <br>
    <section>
      <div class="container">
        <div class="row">
          <!--ACCESO RÁPIDO-->
          
          <?php $acceso_rapido = acceso_rapido() ?>
          <div class="col-md-10">
              <?php 
                $busqueda = isset($_GET['buscar']) ? $_GET['buscar'] : '';
                $consulta_registro = "select * from ordenador where sn like '%$busqueda%'";
                $resultado = mysqli_query($conexion,$consulta_registro);
              ?>
              <div class="card">
                  <div class='busqueda' style="margin-left: 70%; margin-top: 2%;">
                  <form action="fallos_equipos.php" method="GET">
                      <label><input type="text" name="buscar" class="typeahead form-control"></label>
                      <input type="submit" name="envia_busqueda" value="Buscar">
                    </form>
                   </div>
                  <div class="card-header">
                  <h4 class="card-title">Descripciones de los fallos</h4>
                  </div><br>
               <?php 
               while(($fila= mysqli_fetch_assoc($resultado))==true){
               ?>
             <!-- Left-aligned media object -->
                <div class="media" style="margin-left: 2%">
                  <div class="media-left">
                      <span class="glyphicons glyphicons-"></span>
                  </div>
                  <div class="media-body">
                    <h5 class="media-heading">Nº Serie <?php echo $fila['sn']; ?></h5>
                    <div class='col-md-12'>
                    <p><?php echo $fila['descripcion__averia']; ?></p>
                    </div>
                  </div>
                </div>
                <hr>
               <?php }?>
             </div>
          </div>
         </div>
      </div>
    </section>
<?php $pie = footer();?>
</body>

</html>