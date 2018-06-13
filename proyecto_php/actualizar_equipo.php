<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<?php
$sn = $_GET['sn'];
 $consulta = "select * from ordenador where sn = '$sn'";
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
                <h2>Actualizar El equipo <?php echo $sn?></h2>
                 <p>Elija una opción</p>
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#equipo">Actualizar</button>
                <a href="equipos.php"><button class="btn">volver</button></a>
            </div>
        </div>
   
<!-- INICIO FORMULARIO ACTUALIZAR POR COMPLETO EL PARTE-->
 <?php while(($fila= mysqli_fetch_assoc($resultado))==true){ ?>
<section>
    <div class="modal fade" id="equipo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
    <div class="modal-content">
        <form action="actualizar_equipo.php" method="POST">
      <div class="modal-header">
        <h4 class="modal-title">Actualizar el Equipo</h4>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form-->
        <div class="form-group">
            <label>SN</label>
            <input type ="text" name="sn" readonly="yes" value='<?php echo $fila['sn']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Modelo</label>
           <input type ="text" name="modelo" value='<?php echo $fila['modelo']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Familia</label>
           <input type ="text" name="familia" pattern="[A-Za-z]{3,}" value='<?php echo $fila['familia']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Marca</label>
           <input type ="text" name="marca" pattern="[A-Za-z]{3,}" value='<?php echo $fila['marca']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Descripción Cargador</label>
            <textarea maxlength="250" name="descripcion_cargador" class="form-control"><?php echo $fila['descripcion_cargador']?></textarea>
        </div>
        <div class="form-group">
            <label>Funda</label>
             <select name="funda" class="form-control" value='<?php echo $fila['funda']?>'>
               <?php 
               if($fila['funda'] == 'Si'){?>
                 <option value="Si">Si</option>
                 <option value="No">No</option>
              <?php
               }else{?>
                 <option value ="No">No</option>
                 <option value ="Si">Si</option>    
                     <?php
               }
               ?>
             </select>
        </div>
        <div class="form-group">
            <label>Avería</label>
            <textarea maxlength="250" name="descripcion__averia" class="form-control"><?php echo $fila['descripcion__averia']?></textarea>
        </div>
        <div class="form-group">
            <label>Garantia</label>
            <select name="garantia" class="form-control" value='<?php echo $fila['garantia']?>'>
               <?php 
               if($fila['garantia'] == 'Si'){?>
                 <option value="Si">Si</option>
                 <option value="No">No</option>
              <?php
               }else{?>
                 <option value ="No">No</option>
                 <option value ="Si">Si</option>    
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
   if(isset($_POST['sn'])) $sn = $_POST['sn'];
    if(isset($_POST['modelo'])) $modelo = $_POST['modelo'];
    if(isset($_POST['familia'])) $familia = $_POST['familia'];
    if(isset($_POST['marca'])) $marca = $_POST['marca'];
    if(isset($_POST['descripcion_cargador'])) $descripcion_cargador = $_POST['descripcion_cargador'];
    if(isset($_POST['funda'])) $funda = $_POST['funda'];
    if(isset($_POST['descripcion__averia'])) $descripcion__averia = $_POST['descripcion__averia'];
    if(isset($_POST['garantia'])) $garantia = $_POST['garantia'];
    ?>
   <?php
    if(isset($_POST['actualizar'])){
echo $sn;
	$actualizar = "update ordenador set modelo ='".$_POST["modelo"]."',familia='".$_POST["familia"]."',marca='".$_POST["marca"]."',descripcion_cargador='".$_POST["descripcion_cargador"]."',funda='".$_POST["funda"]."',descripcion__averia='".$_POST["descripcion__averia"]."',garantia='".$_POST["garantia"]."'where sn='".$_POST['sn']."'";
        echo $actualizar;
	if(mysqli_query($conexion, $actualizar)){ 
            header("Location: equipos.php"); 
	}else{ 
          echo  mysqli_error($conexion);
	}
       }
     ?>
        </div>
    </div>
</body>
</html>
