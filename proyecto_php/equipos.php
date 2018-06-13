<?php
include("funciones.php");
$conexion = ConexionBD();
?>

<!-- Insertar un disco-->
<?php
if (isset($_POST['sn']))
    $sn = $_POST['sn'];
if (isset($_POST['modelo']))
    $modelo = $_POST['modelo'];
if (isset($_POST['familia']))
    $familia = $_POST['familia'];
if (isset($_POST['marca']))
    $marca = $_POST['marca'];
if (isset($_POST['descripcion_cargador']))
    $descripcion_cargador = $_POST['descripcion_cargador'];
if (isset($_POST['funda']))
    $funda = $_POST['funda'];
if (isset($_POST['descripcion__averia']))
    $descripcion__averia = $_POST['descripcion__averia'];
if (isset($_POST['garantia']))
    $garantia = $_POST['garantia'];

if (isset($_POST["envia_equipo"])) {

    $insercion = mysqli_query($conexion, "insert into ordenador values ('$sn','$modelo','$familia','$marca','$descripcion_cargador','$funda','$descripcion__averia','$garantia')");
    echo mysqli_error($conexion);
    header("Location:equipos.php");
}
?>  
<!DOCTYPE HTML>
<html>
    <head>
        <title>Equipos</title>
<?php
$head = cabecera();
?>
        <script src="js/tinymce.min.js"></script>
<style type="text/css">

     td, th{
      text-align: center;
      padding: 5px;
      border-bottom:solid 1px black;
      margin:0;
    }
</style>
    </head>
<body onload="hora(<?php date_default_timezone_set('Europe/Dublin'); echo date("H").", ".date("i").", ".date("s")?>)">
    <script>tinymce.init({ selector:'textarea' });</script>

<!--Menu-->
<?php $menu = menu() ?>
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
               <li class="active">Información sobre los Equipos</li><div style="margin-left: 60%" id="muestra_hora"></div>
            </ol>
        </div>
    </section>

    <section>
       <div class="container">
            <div class="row">
               <!--ACCESO RÁPIDO-->
         <?php $acceso_rapido = acceso_rapido() ?>
                <div class="col-md-10">
                    <div class="panel-body"> 
                  <!-- FORMULARIO PARA AÑADIR CLIENTE-->
                        <div class="col-md-9">
                            <button class="btn btn-primary añadir" type="button" data-toggle="collapse" data-target="#equipo">
                            Añadir Equipo
                            </button>
                       </div>
                        <section>
                            <div id="equipo" class="collapse">
                                <form action="equipos.php" method="POST" <!--onsubmit="return equipos()"-->>
                                    <div class="modal-header">
                                        <h4 class="modal-title">Nuevo Equipo</h4>
                                        <button type="button" class="close" data-toggle="collapse" data-target="#equipo" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body"> <!--Cuerpo del BODY form-->
                                        <div class="form-group">
                                            <label>SN *</label>
                                            <input type="text" name="sn" maxlength="14" class="form-control"  required="required" pattern="[A-Za-z0-9]{5,14}" placeholder="ejemplo: 0045NSSHH"  title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduzca el Nº de Serie del equipo, Mínimo 5 máximo 10">
                                        </div>
                                        <div class="form-group">
                                            <label>Modelo *</label>
                                            <input type="text" name="modelo" required="required" class="form-control" placeholder="" title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduzca el modelo del equipo">
                                        </div>
                                        <div class="form-group">
                                            <label>Familia *</label>
                                            <input type="text" name="familia" required="required" class="form-control" placeholder="familia" title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduzca la familia del ordenador">
                                        </div>
                                        <div class="form-group">
                                            <label>Marca *</label>
                                            <input type="text" name="marca" required="required" class="form-control" id="marca_equipos" title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduzca la marca del Ordendador">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripcion Cargador</label>
                                            <input type="text" name="descripcion_cargador"  class="form-control" pattern="[A-Za-z0-9]{0,250}" title="Recomendación" data-toggle="popover" data-trigger="focus" data-content="Si el cliente ha dejado el cargador se recomienda una descripción del mismo">
                                        </div>
                                        <div class="form-group">
                                            <label>Funda</label>
                                            <select name="funda" class="form-control" required="required" title="Información" data-toggle="popover" data-trigger="focus" data-content="Seleccione si el cliente ha dejado una funda o no">
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Descripcion averia</label>
                                            <textarea name="descripcion__averia"  maxlength="250" class="form-control" placeholder="el fallo se debe" title="Recomendación" data-toggle="popover" data-trigger="focus" data-content="Describa el problema que tiene el ordenador máximo 250 carácteres"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Garantia</label>
                                            <select name="garantia" class="form-control" title="Información" data-toggle="popover" data-trigger="focus" data-content="Seleccione si el Equipo está en garantía">
                                                <option value="Si">Si</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-target="#equipo" data-toggle="collapse">Cerrar</button>
                                            <button type="submit" name="envia_equipo" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                </form>
                            </div>
                        </section><!--FIN DEL FORMULARIO-->
                            <!-- BUSCAR EQUIPO Y MUESTRA LA TABLA-->
                            <?php if (isset($_GET['buscar'])) $busqueda = $_GET['buscar']; ?>

                            <form action="equipos.php" method="GET" class="buscar">
                                <label><input type="text" name="buscar" class="typeahead form-control"></label>
                                <input type="submit" name="envia_busqueda" value="Buscar">
                            </form>
                            <?php if (isset($_GET["envia_busqueda"])) { ?>
                                <h2>Equipo</h2>
                                <table>
                                    <thead>
                                        <tr>    
                                            <th>SN</th>
                                            <th>Modelo</th>
                                            <th>Familia</th>
                                            <th>Marca</th>
                                            <th>Cargador</th>
                                            <th>Funda</th>
                                            <th>Garantia</th>
                                            <th>Operación</th>
                                            <th>Operación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $consulta_registro = "select * from ordenador where sn like '$busqueda%'";
                                        $resultado = mysqli_query($conexion, $consulta_registro);

                                        while (($fila = mysqli_fetch_assoc($resultado)) == true):
                                            ?>
                                            <tr>
                                                <td><?php echo $fila['sn']; ?></td>
                                                <td><?php echo $fila['modelo']; ?></td>
                                                <td><?php echo $fila['familia']; ?></td>
                                                <td><?php echo $fila['marca']; ?></td>
                                                <td><?php echo $fila['descripcion_cargador']; ?></td>
                                                <td><?php echo $fila['funda']; ?></td>
                                                <td><?php echo $fila['garantia']; ?></td>
                                                <td><a href="actualizar_equipo.php?sn=<?php echo $fila['sn'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                                <td><a href="eliminar_equipo.php?sn=<?php echo $fila['sn'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                                            </tr>  
                                    <?php endwhile; ?>
                                <?php mysqli_free_result($resultado); ?>

                                    </tbody>
                                </table>
                                </tbody>
                                </table>
                            <?php }else { ?>
                                <!-- SI NO SE BUSCA MUESTRA LA TABLA-->
                                <h2>Equipos</h2>
                                <table class="table-responsive-md table-striped">
                                    <thead>
                                        <tr>    
                                            <th>SN</th>
                                            <th>Modelo</th>
                                            <th>Familia</th>
                                            <th>Marca</th>
                                            <th>Funda</th>
                                            <th>Garantia</th>
                                            <th>Operación</th>
                                            <th>Operación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $consulta = "select * from ordenador";
                                        $resultado = mysqli_query($conexion, $consulta);

                                        while (($fila = mysqli_fetch_assoc($resultado)) == true):
                                            ?>
                                            <tr>
                                                <td><?php echo $fila['sn']; ?></td>
                                                <td><?php echo $fila['modelo']; ?></td>
                                                <td><?php echo $fila['familia']; ?></td>
                                                <td><?php echo $fila['marca']; ?></td>
                                                <td><?php echo $fila['funda']; ?></td>
                                                <td><?php echo $fila['garantia']; ?></td>
                                                <td><a href="actualizar_equipo.php?sn=<?php echo $fila['sn'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                                <td><a href="eliminar_equipo.php?sn=<?php echo $fila['sn'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                                            </tr>  
                                <?php endwhile; ?>
                                <?php mysqli_free_result($resultado); ?>

                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>        
        </section>
        <script type="text/javascript" src="js/scripts.js"></script>
<?php $pie = footer();?>
    </body>
</html>
