<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<?php
$id_distribuidor = $_GET['id_distribuidor'];
 $consulta = "select distribuidor.id_distribuidor,nombre,tipo_distribucion,direccion,persona_contacto,telefono from distribuidor,distribuidorTelefono where distribuidor.id_distribuidor =  distribuidorTelefono.id_distribuidor  and distribuidor.id_distribuidor= '$id_distribuidor'";
 $resultado = mysqli_query($conexion, $consulta);
 
?>   
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php $cabecera = cabecera()?>
</head>
<body>
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Actualizar El Distribuidor <?php echo $_GET['id_distribuidor']?></h2>
                 <p>Elija una opción</p>
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#todo">Actualizar</button>
                <a href="distribuidor.php"><button class="btn">volver</button></a>
            </div>
        </div>
   
<!-- INICIO FORMULARIO ACTUALIZAR POR COMPLETO EL PARTE-->
 <?php while(($fila= mysqli_fetch_assoc($resultado))==true){ ?>
<section>
    <div class="modal fade" id="todo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
    <div class="modal-content">
        <form action="actualizar_distribuidor.php" method="POST">
      <div class="modal-header">
        <h4 class="modal-title">Actualizar el distribuidor</h4>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form-->
        <div class="form-group">
            <label>ID</label>
            <input type ="text" name="id_distribuidor" readonly="yes" value='<?php echo $fila['id_distribuidor']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Nombre</label>
           <input type ="text" name="nombre"  pattern="[A-Za-z . ]{2,40}" value='<?php echo $fila['nombre']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Distribución</label>
           <input type ="text" name="tipo_distribucion" value='<?php echo $fila['tipo_distribucion']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Dirección</label>
           <input type ="text" name="direccion" pattern="[A-Za-z0-9 /,]{2,20}" value='<?php echo $fila['direccion']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Teléfono</label>
           <input type ="tel" name="telefono" pattern="[0-9]{9,9}" value='<?php echo $fila['telefono']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Contacto</label>
           <input type ="text" name="persona_contacto" pattern="[A-Za-z ]{2,35}" value='<?php echo $fila['persona_contacto']?>' class="form-control">
        </div>
           <?php }?>
      </div>
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
   if(isset($_POST['id_distribuidor'])) $id_distribuidor = $_POST['id_distribuidor'];
    if(isset($_POST['nombre'])) $nombre = $_POST['nombre'];
    if(isset($_POST['tipo_distribucion'])) $tipo_distribucion = $_POST['tipo_distribucion'];
    if(isset($_POST['direccion'])) $direccion = $_POST['direccion'];
    if(isset($_POST['persona_contacto'])) $persona_contacto = $_POST['persona_contacto'];
    if(isset($_POST['telefono'])) $telefono = $_POST['telefono'];
    ?>
   <?php
    if(isset($_POST['actualizar'])){

	$actualizar = "update distribuidor set nombre ='".$_POST["nombre"]."',tipo_distribucion='".$_POST["tipo_distribucion"]."',direccion='".$_POST["direccion"]."',persona_contacto='".$_POST["persona_contacto"]."'where id_distribuidor='".$_POST['id_distribuidor']."'";
        if($actualizar == true){
            
            $actualizar_telefono = mysqli_query($conexion,"update distribuidorTelefono set telefono ='".$_POST["telefono"]."'where id_distribuidor = '".$_POST['id_distribuidor']."'");
        }
	if(mysqli_query($conexion, $actualizar)){ 
            header("Location: distribuidor.php"); 
	}else{ 
          echo  mysqli_error($conexion);
	}
       }
     ?>
        </div>
    </div>
</body>
</html>