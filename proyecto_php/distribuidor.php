<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<?php
if (isset($_POST['nombre']))
    $nombre = $_POST['nombre'];
if (isset($_POST['tipo_distribucion']))
    $tipo_distribucion = $_POST['tipo_distribucion'];
if (isset($_POST['direccion']))
    $direccion = $_POST['direccion'];
if (isset($_POST['persona_contacto']))
    $persona_contacto = $_POST['persona_contacto'];
if (isset($_POST['cp']))
    $cp = $_POST['cp'];
if (isset($_POST['telefono']))
    $telefono = $_POST['telefono'];
?>
<?php
if (isset($_POST["envia"])) {

    $insercion = mysqli_query($conexion, "insert into distribuidor values (null,'$nombre','$tipo_distribucion','$direccion','$persona_contacto','$cp')");
    echo mysqli_error($conexion);
   
    header("Location: {$_SERVER['PHP_SELF']}");
    if($insercion == true){
        $distribuidorTelefono = mysqli_query($conexion, "insert into distribuidorTelefono(id_distribuidor,telefono) values ((select id_distribuidor from distribuidor where nombre = '$nombre'  and direccion = '$direccion'),'$telefono')");
    }
    }ELSE {
    echo mysqli_error($conexion);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Distribuidores</title>
    <?php
    $head = cabecera();
    ?>
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
                   <a class="nav-link active" data-toggle="tab" href="#ver">Ver Distribuidores</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" data-toggle="tab" href="#añadir">Añadir Distribuidores</a>
                 </li>
               </ul>

                <div class="tab-content">
                    <div id="ver" class="container tab-pane active"><br>
                        <table class="table-responsive-sm table-striped">
                            <thead>
                                <tr>    
                                    <th>Nombre</th>
                                    <th>Distribución</th>
                                    <th>Direccion</th>
                                    <th>Contacto</th>
                                    <th>Teléfono</th>
                                    <th>Operación</th>
                                    <th>Operación</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php 
                            
                            $consulta = "select * from distribuidor,distribuidorTelefono where distribuidor.id_distribuidor = distribuidorTelefono.id_distribuidor";
                            $resultado = mysqli_query($conexion, $consulta);
                            
                            while(($fila = mysqli_fetch_assoc($resultado))== true){
                                ?>
                            <tr>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['tipo_distribucion']; ?></a></td>
                                <td><?php echo $fila['direccion']; ?></td>
                                <td><?php echo $fila['persona_contacto']; ?></td>
                                <td><?php echo $fila['telefono']; ?></td>
                                <td><a href="actualizar_distribuidor.php?id_distribuidor=<?php echo $fila['id_distribuidor'] ?>" class="btn btn-primary btn-sm">Modificar</a></td>
                                <td><a href="eliminar_distribuidor.php?id_distribuidor=<?php echo $fila['id_distribuidor'] ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                            </tr> 
                            <?php }?>
                           
                            </tbody>
                        </table>
                    </div>
                    <div id="añadir" class="container tab-pane fade"><br>
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="formulario" id="formulario">
                            <div class="form-group">
                                <label>Nombre del Distribuidor *</label>
                                <input type="text" name ="nombre" required = required id="nombre" class="form-control" pattern="[A-Za-z . ]{2,40}" placeholder="ejemplo: distribuciones S.L" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="distribuciones S.L">
                            </div>
                           <div class="form-group">
                                <label>Distribución</label>
                                <input type="text" name="tipo_distribucion" maxlengh = "20" id="distribucion" class="form-control" placeholder="" title="Ayuda" data-toggle="popover" data-trigger="focus" data-content="Introduzca el tipo de distribución (Pantallas,Componentes,etc..)">
                            </div>
                            <div class="form-group">
                                <label>Dirección *</label>
                                <input type="text" name="direccion" required ="required" pattern="[A-Za-z0-9 /]{2,20}" class="form-control" placeholder="C/Reyes Católicos,24" title="Recomendación" data-toggle="popover" data-trigger="focus" data-content="Introduzca la dirección siguiendo el ejemplo">
                            </div>
                            <div class="form-group">
                                <label>Teléfono *</label>
                                <input type="tel" name="telefono" required ="required" pattern="[0-9]{9,9}" class="form-control" title="Recomendación" data-toggle="popover" data-trigger="focus" data-content="Introduzca el teléfono">
                            </div>
                            <div class="form-group">
                                <label>Persona Contacto *</label>
                                <input type="tel" name="persona_contacto" required ="required" pattern="[A-Za-z]{2,10}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>CP</label>
                                <select name="cp" class="form-control">
                                    <option value="35600">35600</option>
                                    <option value="30001">30001</option>
                                </select>
                            </div>
                            <button type="submit" name="envia" class="btn btn-primary">Guardar Cambios</button>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
</section>      
<?php $pie = footer(); ?>
      <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>