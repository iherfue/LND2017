<?php
include("funciones.php");
$conexion = ConexionBD();

if (isset($_POST['nombre']))
    $nombre = $_POST['nombre'];
if (isset($_POST['apellido']))
    $apellido = $_POST['apellido'];
if (isset($_POST['direccion']))
    $direccion = $_POST['direccion'];
if (isset($_POST['telefono']))
    $telefono = $_POST['telefono'];
if (isset($_POST['email']))
    $email = $_POST['email'];
?>
<?php
if (isset($_POST["envia"])) {

    $insercion = mysqli_query($conexion, "insert into cliente values (null,'$nombre','$apellido','$direccion')");
    echo mysqli_error($conexion);
    if ($insercion == true) {
        $insert_telefono = mysqli_query($conexion, "insert into clienteTelefono(id_cliente,telefono) values ((select id_cliente from cliente where nombre = '$nombre' and apellido = '$apellido' and direccion = '$direccion'),'$telefono')");
    }
   // if ($insert_telefono == true) {
     //   $parte = mysqli_query($conexion, "insert into parte_servicio values (null,'No','0','Pendiente')");
    //}
    if ($insert_telefono == true) {
        $insertar_email = mysqli_query($conexion, "insert into clienteEmail(id_cliente,email) values ((select id_cliente from cliente where nombre = '$nombre' and apellido = '$apellido' and direccion = '$direccion'),'$email')");
    }
    header("Location: {$_SERVER['PHP_SELF']}");
}
?>
<!DOCTYPE html>
<html>
    <head>
     <title>Clientes</title>
     <?php $cabecera = cabecera() ?>
    <style type="text/css">
        td, th{
            text-align: center;
            padding:5px;
            border-bottom:solid 1px black;
            margin:0;
        }
    </style>
    </head>
<body onload="hora(<?php date_default_timezone_set('Europe/London'); echo date("H").", ".date("i").", ".date("s")?>)">
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
                <li class="active">Panel de Control</li><div style="margin-left: 70%" id="muestra_hora"></div>
            </ol>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="row">
    <!--ACCESO RÁPIDO-->
<?php $acceso_rapido = acceso_rapido() ?>
                <div class="col-md-10">
<!-- FORMULARIO PARA AÑADIR CLIENTE-->
                    <div class="col-md-9">
                        <button class="btn btn-primary añadir" type="button" data-toggle="collapse" data-target="#cliente">
                        Añadir Cliente
                        </button>
                        
                    </div>
                        <section>
                            <div id="cliente" class="collapse">
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return comprueba()" name="formulario" id="formulario">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Nuevo Cliente</h4>
                                        <button type="button" class="close" data-toggle="collapse" data-target="#cliente" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body"> <!--Cuerpo del BODY form-->
                                        <div class="form-group">
                                            <label>Nombre del Cliente *</label>
                                            <input type="text" name ="nombre" id="nombre" required = "required" class="form-control"   placeholder="ejemplo: roberto" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="Introduzca el nombre del cliente Mínimo 2 carácteres Máximo 10">
                                        </div>
                                        <div class="form-group">
                                            <label>Apellidos *</label>
                                            <input type="text" name="apellido" REQUIRED="required" id="apellido" pattern="[A-Za-z]{2, }" class="form-control" placeholder="ejemplo: ramirez perez" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="Introduzca el apellido del cliente  Máximo 20 carácteres">
                                        </div>
                                        <div class="form-group">
                                            <label>Dirección *</label>
                                            <input type="text" name="direccion" required ="required" pattern="[A-Za-z0-9/ ]{5,}" class="form-control" placeholder="C/Reyes Católicos 24" title="Recomendación" data-toggle="popover" data-trigger="focus" data-content="Introduzca la dirección siguiendo el ejemplo">
                                        </div>
                                        <div class="form-group">
                                            <label>Teléfono *</label>
                                            <div title="Información" data-toggle="popover" data-trigger="focus" data-content="No es obligatorio introducir un EMAIL al rellenar el teléfono"> 
                                            <input type="tel" name="telefono" pattern="[0-9]{9}" required ="required" maxlength="9" class="form-control" >

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email"  class="form-control" placeholder="correo@correo"> </div></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#cliente">Cerrar</button>
                                        <button type="submit" name="envia" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </section><!--FIN DEL FORMULARIO-->
                        <!-- BUSCAR CLIENTE Y MUESTRA LA TABLA-->
                        <?php if (isset($_GET['buscar'])) $busqueda = $_GET['buscar']; ?>
                        <form action="clientes.php" method="GET" class="buscar">
                            <label><input type="text" name="buscar" class="form-control"></label>
                            <select name="filtra" style="margin-right: 20%;">
                                <option value="1">Nombre</option>
                                <option value="2">Apellido</option>
                            </select>
                            <input type="submit" name="envia_busqueda" value="Buscar">
                        </form>
                        <a href="csv.php"><img src="img/csv.svg" style="width:5%; "></a>
                        <a href="pdf/clientes.php" target="_blank"><img src="glyphicons/pdf.svg" style="width:5%;"></a>
                        <a href="xml.php" target="_blank"><img src="img/xml.svg" style="width:5%;"></a>
                        <?php if (isset($_GET["envia_busqueda"])) { ?>
                            <h2>Clientes</h2>
                            <table class="table-responsive-sm table-striped">
                                <thead>
                                    <tr>    
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Direccion</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Operación</th>  
                                        <th>Operación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($_GET["filtra"] == 1){
                                    $consulta_registro = "select cliente.id_cliente,nombre,apellido,direccion,telefono,email from cliente,clienteTelefono,clienteEmail "
                                            . "where cliente.id_cliente = clienteTelefono.id_cliente and clienteEmail.id_cliente = cliente.id_cliente and cliente.nombre like '%$busqueda%'";
                                    $resultado = mysqli_query($conexion, $consulta_registro);
                                    
                                    }else{
                                       $consulta_registro = "select cliente.id_cliente,nombre,apellido,direccion,telefono,email from cliente,clienteTelefono,clienteEmail "
                                            . "where cliente.id_cliente = clienteTelefono.id_cliente and clienteEmail.id_cliente = cliente.id_cliente and cliente.apellido like '%$busqueda%'";
                                    $resultado = mysqli_query($conexion, $consulta_registro);
                                    }
                                    while (($fila = mysqli_fetch_assoc($resultado)) == true):
                                        ?>
                                        <tr>
                                            <td><?php echo $fila['id_cliente']; ?></td>
                                            <td><?php echo $fila['nombre']; ?></a></td>
                                            <td><?php echo $fila['apellido']; ?></td>
                                            <td><?php echo $fila['direccion']; ?></td>
                                            <td><?php echo $fila['telefono']; ?></td>
                                            <td><?php echo $fila['email']; ?><a href="mailto:<?php echo$fila['email'] ?>"> <img src="glyphicons/glyphicons-125-message-plus.png" style="margin-top: -6%;"></a></td>
                                            <td><a href="actualizar_cliente.php?id_cliente=<?php echo $fila['id_cliente'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                            <td><a href="eliminar.php?id_cliente=<?php echo $fila['id_cliente'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                                        </tr>  
                                    <?php endwhile; ?>
                                    <?php mysqli_free_result($resultado); ?>
                                </tbody>
                            </table>
                                    <?php }else { ?>
                            <!-- SI NO SE BUSCA MUESTRA LA TABLA-->
                            
                            <h2>Cliente</h2>
                            <table class="table-responsive-sm table-striped">
                                <thead>
                                    <tr>    
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Dirección</th>
                                        <th>Operación</th>
                                        <th>Operación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta = "select * from cliente";
                                    $resultado = mysqli_query($conexion, $consulta);

                                    while (($fila = mysqli_fetch_assoc($resultado)) == true):
                                        ?>
                                        <tr>
                                            <td><?php echo $fila['id_cliente']; ?></td>
                                            <td><?php echo $fila['nombre']; ?></a></td>
                                            <td><?php echo $fila['apellido']; ?></td>
                                            <td><?php echo $fila['direccion']; ?></td>
                                            <td><a href="actualizar_cliente.php?id_cliente=<?php echo $fila['id_cliente'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                            <td><a href="eliminar.php?id_cliente=<?php echo $fila['id_cliente'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                                        </tr>  
                                    <?php endwhile; ?>
                                    <?php mysqli_free_result($resultado); ?>
                                </tbody>
                            </table>
                                   <?php } //fin del else ?>
                </div>
            </div>
        </div>
    </section>
<?php $pie = footer(); ?>
<script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>