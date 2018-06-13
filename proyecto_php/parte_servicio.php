<?php
include("funciones.php");
$conexion = ConexionBD();

// PARTES
$consulta = "select count(*) as total from  parte_servicio where estado = 'Pendiente'";
$resultado = mysqli_query($conexion, $consulta);

$consulta_encurso = "select count(*) as total from  parte_servicio where estado = 'En Curso'";
$resultado_encurso = mysqli_query($conexion, $consulta_encurso);

$consulta_finalizado = "select count(*) as total from  parte_servicio where estado = 'Finalizado'";
$resultado_finalizado = mysqli_query($conexion, $consulta_finalizado);

$consulta_entregado = "select count(*) as total from  parte_servicio where estado = 'Entregado'";
$resultado_entregado = mysqli_query($conexion, $consulta_entregado);

$consulta_partes = "select cliente.nombre,cliente.apellido,parte_servicio.id_parte,parte_servicio.estado,parte_servicio.fechaentrada from cliente,parte_servicio,solicita_recuperacion
                     where cliente.id_cliente = solicita_recuperacion.id_cliente and 
                     solicita_recuperacion.id_parte = parte_servicio.id_parte;";
$resultado_partes = mysqli_query($conexion, $consulta_partes);

$consulta_partes_reparacion = "select cliente.nombre,cliente.apellido,parte_servicio.id_parte,parte_servicio.estado,parte_servicio.fechaentrada from cliente,parte_servicio,solicita_reparacion
                     where cliente.id_cliente = solicita_reparacion.id_cliente and 
                     solicita_reparacion.id_parte = parte_servicio.id_parte;";
$resultado_partes_reparaciones = mysqli_query($conexion, $consulta_partes_reparacion);
?>

<?php
//INSERT PARTE
if (isset($_POST['acepta_presupuesto']))
    $acepta_presupuesto = $_POST['acepta_presupuesto'];
if (isset($_POST['valor_presupuesto']))
    $valor_presupuesto = $_POST['valor_presupuesto'];
if (isset($_POST['parte_estados']))
    $parte_estados = $_POST['parte_estados'];

if (isset($_POST["parte_nuevo"])) {

    $parte_insert = mysqli_query($conexion, "insert into parte_servicio values (null,'$acepta_presupuesto','$valor_presupuesto','$parte_estados',current_timestamp())");
    echo mysqli_error($conexion);
    header("Location:parte_servicio.php");
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Partes</title><?php $cabecera = cabecera() ?>
    </head>
    <body onload="hora(<?php date_default_timezone_set('Europe/Dublin'); echo date("H").", ".date("i").", ".date("s")?>)">
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <!--Menu-->
<?php $menu = menu() ?>

        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <h2>Vista General</h2>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Vista de los Partes de Servicio</li><div style="margin-left: 60%" id="muestra_hora"></div>
                </ol>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <!--ACCESO RÁPIDO-->
<?php $acceso_rapido = acceso_rapido() ?>
                <div class="col-md-10">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formulario">
                        Añadir Parte
                    </button>
                    <br><br>
                    <!-- FORMULARIO PARA AÑADIR PARTE-->
                    <section>
                        <div id="formulario" class="collapse">
                            <form action="parte_servicio.php" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Nuevo Parte</h4>
                                    <button type="button" class="close" data-toggle="collapse" data-target="#formulario" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="form-group">
                                    <label>Acepta Presupuesto</label>
                                    <select name='acepta_presupuesto' class="form-control" required="required" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="Elija una opción">
                                        <option value='Si'>Si</option>
                                        <option value='No'>No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Valor Presupuesto</label>
                                    <input tpye="text" name="valor_presupuesto" pattern="[0-9]{2,3}" class="form-control" required="required" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="Indique el valor del presupuesto si hay decimales indiquelo con .">
                                </div>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select name="parte_estados" class="form-control" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="Seleccione en que estado se encuentra la reparación">
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="En curso">En Curso</option>
                                        <option value="Finalizado">Finalizado</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#formulario">Cerrar</button>
                                    <button type="submit" name="parte_nuevo" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </section><!--FIN DEL FORMULARIO-->
                    <div class="col-md-13">
                        <div class="card-header">
                            <h4>Resumen General</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="card-group">
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h2 class="card-text"> <?php
                                            $contados = mysqli_fetch_assoc($resultado);
                                            echo $contados['total'];
                                            mysqli_free_result($resultado);
                                            ?>
                                            <img src="glyphicons/glyphicons-530-list-alt.png">                   
                                        </h2>
                                        <h5>Pendientes</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h2 class="card-text">
                                            <?php
                                            $reparaciones_contadas = mysqli_fetch_assoc($resultado_encurso);
                                            echo $reparaciones_contadas['total'];
                                            ?>
                                            <img src="glyphicons/glyphicons-530-list-alt.png">
                                        </h2>
                                        <h5>En Curso</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h2 class="card-text"> <?php
                                            $recuperaciones_contadas = mysqli_fetch_assoc($resultado_finalizado);
                                            echo $recuperaciones_contadas['total'];
                                            ?> 
                                            <img src="glyphicons/glyphicons-530-list-alt.png">
                                        </h2>
                                        <h5>Finalizado</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h2 class="card-text"> <?php
                                            $clientes_contados = mysqli_fetch_assoc($resultado_entregado);
                                            echo $clientes_contados['total'];
                                            ?>  
                                            <img src="glyphicons/glyphicons-530-list-alt.png"> 
                                        </h2>
                                        <h5>Entregado</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!-- TABLAS-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Partes de Servicio de las Recuperaciones<a href="pdf/index.php" target="_blank"><img src="glyphicons/pdf.svg" style="width: 5%; float: right;"></a></h5>
                            <table class="table table-striped table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>ID Parte</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Entrada</th>
                                        <th>Estado</th>
                                        <th>Operación</th>
                                        <th>Operación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while (($fila = mysqli_fetch_assoc($resultado_partes)) == true) { ?>
                                        <tr>
                                            <td><?php echo $fila['id_parte']; ?></td>
                                            <td><?php echo $fila['nombre']; ?></td>
                                            <td><?php echo $fila['apellido']; ?></td>
                                            <td><?php echo $fila['fechaentrada']; ?></td>
                                            <?php
                                            if ($fila['estado'] == 'Pendiente') {
                                                ?>
                                                <td><span class="btn btn-warning btn-sm" data-toggle="tooltip" title="Pendiente de reparación, Empiece cuanto antes!!!"><?php echo $fila['estado']; ?></span></td>
                                            <?php } else {
                                                if ($fila['estado'] == 'En curso') { ?>
                                                    <td><a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="Actualmente se trabaja en ello"><?php echo $fila['estado']; ?></a></td>
                                                <?php } else {
                                                    if ($fila['estado'] == 'Finalizado') { ?>    
                                                        <td><span class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Pongase en contacto con el cliente"><?php echo $fila['estado']; ?></span></td>
                                                    <?php }if ($fila['estado'] == 'Entregado') { ?>
                                                        <td><span class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="El parte será eliminado en unos días"><?php echo $fila['estado']; ?></span></td>
                                                <?php }
                                                    if ($fila['estado'] == 'Retrasado'){?>
                                                        <td><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="Retrasado, Empiece cuanto antes!!!"><?php echo $fila['estado']; ?></span></td>
                                                   <?php }
                                                ?>
                                            <?php }
                                        } ?>
                                            <td><a href="actualizar_parte.php?id_parte=<?php echo $fila['id_parte'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                            <td><a href="eliminar_parte.php?id_parte=<?php echo $fila['id_parte'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                                        </tr>
                                <?php } ?>
                                <?php mysqli_free_result($resultado_partes); ?>
                                </tbody>
                            </table>
                        </div>
                    </div><br><br>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Partes de Servicio de las Reparaciones<a href="pdf/reparaciones.php" target="_blank"><img src="glyphicons/pdf.svg" style="width: 5%; float: right;"></a></h5>
                            <table class="table table-striped table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>ID Parte</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Entrada</th>
                                        <th>Estado</th>
                                        <th>Operación</th>
                                        <th>Operación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php while (($fila = mysqli_fetch_assoc($resultado_partes_reparaciones)) == true) { ?>
                                        <tr>
                                            <td><?php echo $fila['id_parte']; ?></td>
                                            <td><?php echo $fila['nombre']; ?></td>
                                            <td><?php echo $fila['apellido']; ?></td>
                                            <td><?php echo $fila['fechaentrada']; ?></td>
                                            <?php
                                            if ($fila['estado'] == 'Pendiente') {
                                                ?>
                                                <td><span class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Pendiente de reparación, Empiece cuanto antes!!!"><?php echo $fila['estado']; ?></span></td>
                                            <?php } else {
                                                if ($fila['estado'] == 'En curso') { ?>
                                                    <td><span class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="Actualmente se trabaja en ello"><?php echo $fila['estado']; ?></span></td>
                                            <?php } else {
                                             if ($fila['estado'] == 'Finalizado') { ?>    
                                                        <td><span class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Pongase en contacto con el cliente"><?php echo $fila['estado']; ?></span></td>
                                                <?php }if ($fila['estado'] == 'Entregado') { ?>
                                                        <td><span class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Se recomienda Borrar el Parte"><?php echo $fila['estado']; ?></span></td>
                                                <?php } 
                                                       if ($fila['estado'] == 'Retrasado'){?>
                                                        <td><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="Retrasado, Empiece cuanto antes!!!"><?php echo $fila['estado']; ?></span></td>
                                                   <?php }?>
                                                <?php }
                                                } ?>
                                            <td><a href="actualizar_parte.php?id_parte=<?php echo $fila['id_parte'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                            <td><a href="eliminar_parte.php?id_parte=<?php echo $fila['id_parte'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                                        </tr>
                                        <?php } //fin del while?>
                                        <?php mysqli_free_result($resultado_partes_reparaciones); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $pie = footer(); ?>
<script type="text/javascript" src="js/scripts.js"></script>
    </body>
</html>