<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<?php
$sn = $_GET['numero_serie'];
 $consulta = "select * from repuestos where numero_serie = '$sn'";
 $resultado = mysqli_query($conexion, $consulta);
?>   
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php $cabecera = cabecera()?>
        <script src="js/tinymce.min.js"></script>
</head>
<body>
    <script>tinymce.init({ selector:'textarea' });</script>
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Actualizar El repuesto: <?php echo $sn?></h2>
                 <p>Elija una opción</p>
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#repuesto">Actualizar</button>
                <a href="repuestos.php"><button class="btn">volver</button></a>
            </div>
        </div>
   
<!-- INICIO FORMULARIO ACTUALIZAR POR COMPLETO EL PARTE-->
 <?php while(($fila= mysqli_fetch_assoc($resultado))==true){ ?>
<section>
    <div class="modal fade" id="repuesto" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
    <div class="modal-content">
        <form action="actualizar_repuesto.php" method="POST">
      <div class="modal-header">
        <h4 class="modal-title">Actualizar el Repuesto</h4>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form-->
        <div class="form-group">
            <label>SN</label>
            <input type ="text" name="numero_serie" readonly="yes" value='<?php echo $fila['numero_serie']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Descripción</label>
           <textarea maxlength="250" name="descripcion" class="form-control"><?php echo $fila['descripcion']?></textarea>
        </div>
        <div class="form-group">
           <label>Marca</label>
           <input type ="text" name="marca" pattern="[A-Za-z ]{2,20}" value='<?php echo $fila['marca']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Familia</label>
           <input type ="text" name="familia"  pattern="[A-Za-z . ]{2,20}" value='<?php echo $fila['familia']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Tipo</label>
           <select name="tipo" class="form-control" value='<?php echo $fila['tipo']?>'>
               <?php 
               if($fila['tipo'] == 'Nuevo'){?>
                 <option value="Nuevo">Nuevo</option>
                 <option value="Segunda Mano">Segunda Mano</option>
              <?php
               }else{?>
                 <option value ="Segunda Mano">Segunda Mano</option>
                 <option value ="Nuevo">Nuevo</option>    
                     <?php
               }
               ?>
             </select>
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
   if(isset($_POST['numero_serie'])) $numero_serie = $_POST['numero_serie'];
    if(isset($_POST['descripcion'])) $descripcion = $_POST['descripcion'];
    if(isset($_POST['marca'])) $marca = $_POST['marca'];
    if(isset($_POST['familia'])) $familia = $_POST['familia'];    
    if(isset($_POST['tipo'])) $tipo = $_POST['tipo'];    
    ?>
   <?php
    if(isset($_POST['actualizar'])){
echo $sn;
	$actualizar = "update repuestos set descripcion ='".$_POST["descripcion"]."',marca='".$_POST["marca"]."',familia='".$_POST["familia"]."',tipo='".$_POST["tipo"]."'where numero_serie='".$_POST['numero_serie']."'";
        echo $actualizar;
	if(mysqli_query($conexion, $actualizar)){ 
            header("Location: repuestos.php"); 
	}else{ 
          echo  mysqli_error($conexion);
	}
       }
     ?>
        </div>
    </div>
</body>
</html>