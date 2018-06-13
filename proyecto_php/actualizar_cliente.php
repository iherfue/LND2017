<?php
include("funciones.php");
$conexion = ConexionBD();
$id = $_GET['id_cliente'];
 $consulta = "select * from cliente,clienteTelefono,clienteEmail where cliente.id_cliente = clienteTelefono.id_cliente and cliente.id_cliente = clienteEmail.id_cliente and cliente.id_cliente = '$id'";
 $resultado = mysqli_query($conexion, $consulta);
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php $cabecera = cabecera()?>
</head>
<body>
<?php while(($fila= mysqli_fetch_assoc($resultado))==true){ ?>
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Actualizar El cliente <?php echo $fila['nombre']?></h2>
                <p>Elija una opción</p>
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#todo">Actualizar</button>
                <a href="clientes.php"><button class="btn">volver</button></a>
            </div>
        </div>
<section>
    <div class="modal fade" id="todo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
    <div class="modal-content">
        <form action="actualizar_cliente.php" method="POST" onsubmit="return comprueba()">
      <div class="modal-header">
        <h4 class="modal-title">Actualización</h4>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form-->
        <div class="form-group">
             <label>Id_cliente</label>
             <input type="text" name="id_cliente" readonly="yes" value='<?php echo $fila['id_cliente']?>' class="form-control">
        </div>
        <div class="form-group">
             <label>Nombre</label>
             <input type="text" name="nombre" maxlength="20" pattern="[A-Za-z]{1,10}" value='<?php echo $fila['nombre']?>' class="form-control" id="nombre">
        </div>
        <div class="form-group">
             <label>Apellido</label>
             <input type="text" name="apellido" pattern="[A-Za-z ]{1,25}" class='form-control' value="<?php echo $fila['apellido']?>" id="apellido">
        </div>
        <div class="form-group">
             <label>Direccion</label>
             <input type="text" name="direccion" pattern="[A-Za-z0-9/ ]{5,30}" class='form-control' value="<?php echo $fila['direccion']?>">
        </div>
        <div class="form-group">
             <label>Teléfono</label>
             <input type="text" name="telefono" pattern="[0-9]{9,9}" class='form-control' value="<?php echo $fila['telefono']?>">
        </div>
        <div class="form-group">
             <label>Email</label>
             <input type="text" name="email" class='form-control' value="<?php echo $fila['email']?>">
        </div>
      </div>
          <?php }?>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" name="actualizar" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
      </div>
  </div>
 </div>
</section><!--FIN DEL FORMULARIO-->
<!--ACTUALIZA-->    
 <?php
 if(isset($_POST['id_cliente'])) $id_cliente = $_POST['id_cliente'];
   if(isset($_POST['nombre'])) $nombre = $_POST['nombre'];
    if(isset($_POST['apellido'])) $apellido = $_POST['apellido'];
    if(isset($_POST['direccion'])) $direccion = $_POST['direccion'];
    if(isset($_POST['telefono'])) $telefono = $_POST['telefono'];
    if(isset($_POST['email'])) $email = $_POST['email'];
   
    ?>
    <?php
    if(isset($_POST['actualizar']) == true){

	$actualizar_cliente = "update cliente set nombre ='".$_POST["nombre"]."',apellido='".$_POST["apellido"]."',direccion='".$_POST["direccion"]."' where id_cliente ='".$_POST['id_cliente']."'";
	echo mysqli_error($conexion);
        if($actualizar_cliente == true){
            
            $actualizar_telefono = mysqli_query($conexion,"update clienteTelefono set telefono = '".$_POST["telefono"]."' where id_cliente =".$_POST['id_cliente']);
        }
        
        if($actualizar_telefono == true){
            
            $actualizar_email = mysqli_query($conexion,"update clienteEmail set email = '".$_POST["email"]."' where id_cliente = ".$_POST['id_cliente']);
        }
        if(mysqli_query($conexion, $actualizar_cliente)){ 
            header("Location: clientes.php"); 
	}
    }else {
        echo mysqli_error($conexion);
    }
    ?>
</div>
</div>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>
