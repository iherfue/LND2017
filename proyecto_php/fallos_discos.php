<?php
include("funciones.php");
$conexion = ConexionBD();
//Fallos por Hardware
$consulta = "select count(*) as total from  discos where tipo_fallo = 'Hardware'";
$hardware = mysqli_query($conexion,$consulta);

//Fallos Por Software
$consulta = "select count(*) as total from discos where tipo_fallo = 'software'";
$software = mysqli_query($conexion, $consulta)
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fallos discos</title>
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

    <section>
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Resumen de los Fallos</li>
        </ol>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <!--ACCESO RÁPIDO-->
          <?php $acceso_rapido = acceso_rapido() ?>
          <div class="col-md-10">
              <div class="card">
                  <div class="card-header">
                      <h5 class="card-title">Número de Fallos</h5>
                  </div>
                  <div class="card-body">
                      <div class="card-group">
                      <div class="col-md-6">
                          <h4>Hardware</h4>
                          <div class="card bg-light">
                            <div class="card-body text-center">
                            <h3 class="card-text"><?php
                                $contados = mysqli_fetch_assoc($hardware);
                                echo $contados['total'];
                                mysqli_free_result($hardware);
                                ?></h3>
                          </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <h4>Software</h4>
                           <div class="card bg-light" align="center">
                               <div class="card-body text-center">
                                 <h3 class="card-text">
                                     <?php
                                    $contados = mysqli_fetch_assoc($software);
                                    echo $contados['total'];
                                    mysqli_free_result($software);
                                    ?>
                                 </h3> 
                               </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div><br><br>
                <?php 
               $busqueda = isset($_GET['buscar']) ? $_GET['buscar'] : '';
             
                $consulta_registro = "select * from discos where sn like '%$busqueda%'";
                $resultado = mysqli_query($conexion,$consulta_registro);
                 ?>
              <div class="card">
                  <div class="card-header">
                      <h5><div class="card-title">Descripciones de los fallos</div></h5>
                  </div>
                  <form action="fallos_discos.php" method="GET" class='busqueda_discos_fallos'>
                    <label><input type="text" name="buscar" class="typeahead form-control"></label>
                    <input type="submit" name="envia_busqueda" value="Buscar">
                 </form>
               <?php 
               while(($fila= mysqli_fetch_assoc($resultado))==true){
               ?>
             <!-- Left-aligned media object -->
                <div class="media" style="margin-left: 2%">
                  <div class="media-left">
                      <span class="glyphicon glyphicon-hdd"></span>
                  </div>
                  <div class="media-body">
                    <h5 class="media-heading">Nº Serie <?php echo $fila['sn']; ?></h5>
                    <div class='col-md-12'>
                    <p><?php echo $fila['descripcion_fallo']; ?></p>
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