<?php
include("funciones.php");
$conexion = ConexionBD();
?>

<?php
//RECUPERACIONES
$consulta = "select * from cliente order by id_cliente desc";
$resultado = mysqli_query($conexion, $consulta);

$consulta_parte = "select id_parte from parte_servicio where id_parte not in (select id_parte from solicita_recuperacion) and id_parte not in (select id_parte from solicita_reparacion)";
$resultado_consulta_parte = mysqli_query($conexion, $consulta_parte);

$consulta_sn_disco = "select sn from discos where sn not in( select sn_disco from solicita_recuperacion)";
$resultado_sn_disco = mysqli_query($conexion, $consulta_sn_disco);

//REPARACIONES
$consulta_sn_equipo = "select sn from ordenador where sn not in (select sn_pc from solicita_reparacion)";
$resultado_sn_equipo = mysqli_query($conexion, $consulta_sn_equipo);

$consulta_cliente = "select * from cliente order by id_cliente desc";
$cliente = mysqli_query($conexion, $consulta_cliente);

$consulta_parte_reparacion = "select id_parte from parte_servicio where id_parte not in (select id_parte from solicita_reparacion) and id_parte not in(select id_parte from solicita_recuperacion)";
$reparacion_parte = mysqli_query($conexion, $consulta_parte_reparacion);

if (isset($_POST['id_cliente']))
    $id_cliente = $_POST['id_cliente'];
if (isset($_POST['sn_disco']))
    $sn_disco = $_POST['sn_disco'];
if (isset($_POST['id_parte']))
    $id_parte = $_POST['id_parte'];
if (isset($_POST['sn_equipo']))
    $sn_equipo = $_POST['sn_equipo'];

if (isset($_POST["envia_recuperacion"])) {

    $insercion = mysqli_query($conexion, "insert into solicita_recuperacion values ('$id_cliente','$sn_disco','$id_parte')");
    echo mysqli_error($conexion);
    header("Location:servicios.php");
}

if (isset($_POST["envia_reparacion"])) {

    $insertar = mysqli_query($conexion, "insert into solicita_reparacion values ('$id_cliente','$sn_equipo','$id_parte')");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Servicios</title>
<?php $cabecera = cabecera() ?>
    </head>
<body>
<!--Menu-->
<?php $menu = menu() ?>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Servicios</h2>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <ol class="breadcrumb">
                <li class="active">Vista General</li>
            </ol>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
              <!--ACCESO RÁPIDO-->
            <?php $acceso_rapido = acceso_rapido() ?>
                <div class="col-md-10">
                    <div class="card-header">
                        <h4>Agregar</h4></div>
                        <div class="card-body">
                            <div class="card-group">
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body text-center" data-toggle="modal" data-target="#recuperacion">
                                            <h1><img src="glyphicons/glyphicons-343-hdd.png"></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body text-center" data-toggle="modal" data-target="#reparacion">
                                            <h1><img src="glyphicons/glyphicons-440-wrench.png"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
        <!-- FORMULARIO PARA AÑADIR CLIENTE-->
        <section class="seccion_dos">
            <div class="modal fade" id="recuperacion" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
                    <div class="modal-content">
                        <form action="servicios.php" method="POST">
                            <div class="modal-header">

                                <h4 class="modal-title">Agregar al servicio De Recuperación De datos</h4>
                            </div>
                            <div class="modal-body"> <!--Cuerpo del BODY form-->
                                <div class="form-group">
                                    <label>Seleccione el cliente</label>
                                    <select name="id_cliente" id='nombre_valor' class="form-control" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="Seleccione el nombre del cliente que solicita el servicio">
                                        <?php
                                        while (($fila = mysqli_fetch_assoc($resultado)) == true) {
                                            echo "<option value=" . $fila['id_cliente'] . ">" . $fila['nombre'] . ' ' . $fila['apellido'] . "</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el Número de Serie del Disco duro</label>
                                    <select name="sn_disco" id='sn_valor' class="form-control" title="Información Importante" data-toggle="popover" data-trigger="focus" data-content="Se muestra el Nº de Serie de los discos que no tienen asignada una recuperación">
                                        <?php
                                        while (($fila = mysqli_fetch_assoc($resultado_sn_disco)) == true) {
                                            echo "<option value=" . $fila['sn'] . ">" . $fila['sn'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el Parte de Servicio</label>
                                    <select name="id_parte" id='parte_valor' class="form-control" title="Información Importante" data-toggle="popover" data-trigger="focus" data-content="Se muestra el último Parte de servicio creado o sin asignar">
                                        <?php
                                        while (($fila = mysqli_fetch_assoc($resultado_consulta_parte)) == true) {
                                            echo "<option value=" . $fila['id_parte'] . ">" . $fila['id_parte'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" name="envia_recuperacion" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section><!--FIN DEL FORMULARIO-->
        <!-- FORMULARIO PARA AÑADIR SERVICIO REPARACION-->
        <section class="seccion_dos">
            <div class="modal fade" id="reparacion" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
                    <div class="modal-content">
                        <form action="servicios.php" method="POST">
                            <div class="modal-header">

                                <h4 class="modal-title">Agregar al servicio de Reparación de Equipos</h4>
                            </div>
                            <div class="modal-body"> <!--Cuerpo del BODY form-->
                                <div class="form-group">
                                    <label>Seleccione el cliente</label>
                                    <select name="id_cliente" id='nombre_valor' class="form-control" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="Seleccione el nombre del cliente">
                                        <?php
                                        while (($fila = mysqli_fetch_assoc($cliente)) == true) {
                                            echo "<option value=" . $fila['id_cliente'] . ">" . $fila['nombre'] . ' ' . $fila['apellido'] . "</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el Número de Serie del Ordenador</label>
                                    <select name="sn_equipo" class="form-control" title="Información Importante" data-toggle="popover" data-trigger="focus" data-content="Se muestra el Nº de los equipos que no tienen asignada una recuperación">
                                        <?php
                                        while (($fila = mysqli_fetch_assoc($resultado_sn_equipo)) == true) {
                                            echo "<option value=" . $fila['sn'] . ">" . $fila['sn'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el Parte de Servicio</label>
                                    <select name="id_parte" class="form-control" title="Información Importante" data-toggle="popover" data-trigger="focus" data-content="Se muestra el último Parte de servicio creado o sin asignar">
                                    <?php
                                    while (($fila = mysqli_fetch_assoc($reparacion_parte)) == true) {
                                        echo "<option value=" . $fila['id_parte'] . ">" . $fila['id_parte'] . "</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" name="envia_reparacion" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </section><!--FIN DEL FORMULARIO-->
<?php $pie = footer(); ?>
        <script type="text/javascript" src="js/scripts.js"></script>
    </body>
</html>