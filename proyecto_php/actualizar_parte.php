<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<!--ACTUALIZA EL ESTADO-->    
    <?php
     if(isset($_POST['estado'])) $estado = $_POST['estado'];
     if(isset($_POST['valor_presupuesto'])) $valor_presupuesto = $_POST['valor_presupuesto'];
     if(isset($_POST['acepta_presupuesto'])) $estado = $_POST['acepta_presupuesto'];
    ?>
   <?php
    if(isset($_POST['actualizar'])){

	$actualizar = "update parte_servicio set estado='".$_POST["estado"]."',fechaentrada = fechaentrada where id_parte=".$_POST['id_parte'];
	if(mysqli_query($conexion, $actualizar)){ 
		header("Location: parte_servicio.php"); 
	}else{ 
            echo mysqli_error($conexion);
	}
       }
      if(isset($_POST['actualizar_todo'])){

	$actualizar = "update parte_servicio set acepta_presupuesto  ='".$_POST["acepta_presupuesto"]."', valor_presupuesto='".$_POST["valor_presupuesto"]."', estado='".$_POST["estado"]."',fechaentrada = fechaentrada where id_parte=".$_POST['id_parte'];
	if(mysqli_query($conexion, $actualizar)){ 
		header("Location: parte_servicio.php"); 
	}else{ 
            echo "Ocurrio un error";
	}
    }?>
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
            <h2>Actualizar El Parte</h2>
            <p>Elija una opción</p>
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#estado">Actualizar Estado</button>
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#todo">Actualizar Todo</button>
            <a href="parte_servicio.php"><button class="btn">volver</button></a>
            </div>
        </div>
<!--FORMULARIO ESTADO-->
 <section>
    <div class="modal fade" id="estado" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
    <div class="modal-content">
        <form action="actualizar_parte.php" method="POST">
      <div class="modal-header">
        <h4 class="modal-title">Actualizar Estado del Parte</h4>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form-->
        <div class="form-group">
              <label>Estado *</label>
              <select name="estado" class="form-control">
                  <option value="Pendiente">Pendiente</option>
                  <option value="En curso">En curso</option>
                  <option value="Finalizado">Finalizado</option>
                  <option value="Entregado">Entregado</option>
              </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="actualizar" class="btn btn-primary">Guardar Cambios</button>
        <?php if(isset($_GET['id_parte'])): ?>
            <input type="hidden" name="id_parte" value="<?php echo $_GET['id_parte']; ?>" />
            <?php endif; ?>
      </div>
    </form>
    </div>
  </div>
</div>
</section>
<!--FIN DEL FORMULARIO-->
<!-- INICIO FORMULARIO ACTUALIZAR POR COMPLETO EL PARTE-->
<section>
    <div class="modal fade" id="todo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
    <div class="modal-content">
        <form action="actualizar_parte.php" method="POST">
      <div class="modal-header">
        <h4 class="modal-title">Actualizar Todo el Parte</h4>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form-->
        <div class="form-group">
            <label>Acepta Presupuesto *</label>
             <select name="acepta_presupuesto" class="form-control">
                <option value="Si">Si</option>
                <option value="No">No</option>
             </select>
        </div>
        <div class="form-group">
            <label>Valor Presupuesto</label>
            <input type ="text" name="valor_presupuesto" pattern="[0-9]{2,3}" class="form-control">
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option value="Pendiente">Pendiente</option>
                <option value="En curso">En curso</option>
                <option value="Finalizado">Finalizado</option>
                <option value="Entregado">Entregado</option>
             </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="actualizar_todo" class="btn btn-primary">Guardar Cambios</button>
        <?php if(isset($_GET['id_parte'])): ?>
            <input type="hidden" name="id_parte" value="<?php echo $_GET['id_parte']; ?>" />
            <?php endif; ?>
      </div>
    </form>
    </div>
  </div>
</div>
</section><!--FIN DEL FORMULARIO-->

        </div>
    </div>
</body>
</html>