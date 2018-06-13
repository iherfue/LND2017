<?php
include("funciones.php");
$conexion = ConexionBD();

if (isset($_POST['sn']))
    $sn = $_POST['sn'];
if (isset($_POST['descripcion']))
    $descripcion = $_POST['descripcion'];
if (isset($_POST['marca']))
    $marca = $_POST['marca'];
if (isset($_POST['familia']))
    $familia = $_POST['familia'];
if (isset($_POST['tipo']))
    $tipo = $_POST['tipo'];
?>
<?php
if (isset($_POST["envia_repuesto"])) {

    $insercion = mysqli_query($conexion, "insert into repuestos values ('$sn','$descripcion','$marca','$familia','$tipo')");
    echo mysqli_error($conexion);
    header("Location: {$_SERVER['PHP_SELF']}");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Repuestos</title>
        <?php $cabecera = cabecera() ?>
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <style type="text/css">
            td, th{
                text-align: center;
                padding:5px;
                border-bottom:solid 1px black;
                margin:0;
            }
        </style>
    </head>
    <body>
        <script>tinymce.init({selector: 'textarea'});</script>
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
                    <li class="active">Panel de Control</li>
                </ol>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">                    
                    <!--ACCESO RÁPIDO-->
                    <?php $acceso_rapido = acceso_rapido() ?>
                    <!--PESTAÑAS-->
                    <div class="col-md-10">        
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#ver">Repuestos En uso</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#repuestos">Repuestos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#añadir">Añadir Repuestos</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="añadir" class="container tab-pane fade">
                                <form action="<?php htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Nuevo Repuesto</h4>
                                    </div>
                                    <div class="modal-body"> <!--Cuerpo del BODY form(antes modal)-->
                                        <div class="form-group">
                                            <label>SN *</label>
                                            <input type="text" name="sn" class="form-control" required="required" placeholder="ejemplo: 0045NSSHH" maxlength="12" title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduca el Nº de serie del Repuesto, máximo 12 carácteres">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="descripcion" class="form-control" maxlenght="250"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <input type="text" name="marca" pattern="[A-Za-z ]{2,20}" class="form-control" placeholder="marca" title="Información importante" data-toggle="popover" data-trigger="focus" data-content="Debe introducir una de las siguientes marcas: WD,Hitachi,Toshiba,Seagate">
                                        </div>
                                        <div class="form-group">
                                            <label>Familia</label>
                                            <input type="text" name="familia" pattern="[A-Za-z . ]{2,20}" class="form-control" placeholder="memoria ram">
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select name="tipo" class="form-control" title="Información" data-toggle="popover" data-trigger="focus" data-content="Seleccione el tipo de repuesto">
                                                <option value="Nuevo">Nuevo</option>
                                                <option value="Segunda Mano">Segunda Mano</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="envia_repuesto" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                            <div id="repuestos" class="container tab-pane fade">
                                <h2>Repuestos</h2>
                                <div class="table-responsive">
                                    <table id="example_dos" class="table-striped">
                                        <thead>
                                            <tr>    
                                                <th>NºSerie</th>
                                                <th>Descripcion</th>
                                                <th>Marca</th>
                                                <th>Familia</th>
                                                <th>Tipo</th>
                                                <th>Operación</th>
                                                <th>Operación</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulta = "select * from repuestos;";
                                            $resultado = mysqli_query($conexion, $consulta);

                                            while (($fila = mysqli_fetch_assoc($resultado)) == true):
                                                ?>
                                                <tr>
                                                    <td><?php echo $fila['numero_serie']; ?></td>
                                                    <td><?php echo $fila['descripcion']; ?></a></td>
                                                    <td><?php echo $fila['marca']; ?></td>
                                                    <td><?php echo $fila['familia']; ?></td>
                                                    <td><?php
                                                    if($fila['tipo'] == 'Segunda Mano'){
                                                        echo "<img src='img/segunda_mano.svg' width='40%'>";
                                                    }else{
                                                        echo "<img src='img/new.svg' width='40%'>";
                                                    }
                                                    ?></td>
                                                    <td><a href="actualizar_repuesto.php?numero_serie=<?php echo $fila['numero_serie'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                                    <td><a href="eliminar_repuesto.php?numero_serie=<?php echo $fila['numero_serie'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                                                </tr>  
                                            <?php endwhile; ?>
                                            <?php mysqli_free_result($resultado); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br/>
                            <div id="ver" class="container tab-pane active"><br/>
                                <h2>Repuestos Asignados</h2>
                                <div class="table-responsive">
                                    <table id="example" class="table-striped">
                                        <thead>
                                            <tr>    
                                                <th>NºSerie</th>
                                                <th>Marca</th>
                                                <th>Familia</th>
                                                <th>Equipo Asignado</th>
                                                <th>Tipo</th>
                                                <th>Operación</th>
                                                <th>Operación</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulta = "select repuestos.numero_serie,repuestos.marca,repuestos.familia,repuestos.tipo,ordenador.modelo from repuestos,ordenador,nesecita_repuesto where repuestos.numero_serie = nesecita_repuesto.numero_serie and nesecita_repuesto.sn_pc = ordenador.sn;";
                                            $resultado = mysqli_query($conexion, $consulta);

                                            while (($fila = mysqli_fetch_assoc($resultado)) == true):
                                                ?>
                                                <tr>
                                                    <td><?php echo $fila['numero_serie']; ?></td>
                                                    <td><?php echo $fila['marca']; ?></a></td>
                                                    <td><?php echo $fila['familia']; ?></td>
                                                    <td><?php echo $fila['modelo']; ?></td>
                                                   <td><?php
                                                    if($fila['tipo'] == 'Segunda Mano'){
                                                        echo "<img src='img/segunda_mano.svg' width='40%'>";
                                                    }else{
                                                        echo "<img src='img/new.svg' width='40%'>";
                                                    }
                                                    ?></td>
                                                    <td><a href="actualizar_repuesto.php?numero_serie=<?php echo $fila['numero_serie'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                                    <td><a href="eliminar_repuesto.php?numero_serie=<?php echo $fila['numero_serie'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                                                </tr>  
                                            <?php endwhile; ?>
                                            <?php mysqli_free_result($resultado); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <?php $pie = footer(); ?>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#example').DataTable();
            });
             $(document).ready(function () {
                $('#example_dos').DataTable();
            });
        </script>
    </body>
</html>
