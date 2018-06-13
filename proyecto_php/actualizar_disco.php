<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<?php
$sn = $_GET['sn'];
 $consulta = "select * from discos where sn = '$sn'";
 $resultado = mysqli_query($conexion, $consulta);
?>   
<!DOCTYPE html>
<html>
<head>
	<title>Actualizar disco</title>
	<?php $cabecera = cabecera()?>
        <script src="js/tinymce.min.js"></script>
</head>
<body>
    <script>tinymce.init({ selector:'textarea' });</script>
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Actualizar El disco <?php echo $sn?></h2>
                 <p>Elija una opción</p>
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#todo">Actualizar</button>
                 <a href="discos.php"><button class="btn">volver</button></a>
            </div>
        </div>
   
<!-- INICIO FORMULARIO ACTUALIZAR POR COMPLETO EL PARTE-->
 <?php while(($fila= mysqli_fetch_assoc($resultado))==true){ ?>
<section>
    <div class="modal fade" id="todo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
    <div class="modal-content">
        <form action="actualizar_disco.php" method="POST">
      <div class="modal-header">
        <h4 class="modal-title">Actualizar el disco</h4>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form-->
        <div class="form-group">
            <label>SN</label>
            <input type ="text" name="sn" readonly="yes" value='<?php echo $fila['sn']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Capacidad</label>
           <input type ="text" name="capacidad" pattern="[0-9]{2,}" value='<?php echo $fila['capacidad']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Origen</label>
           <input type ="text" name="origen" pattern="[A-Za-z]{3,}" value='<?php echo $fila['origen']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Casilla</label>
           <input type ="text" name="casilla" value='<?php echo $fila['casilla']?>' class="form-control">
        </div>
        <div class="form-group">
           <label>Fecha</label>
           <input type ="date" name="fecha" value='<?php echo $fila['fecha']?>' class="form-control">
        </div>
         <div class="form-group">
           <label>Marca</label>
           <input type ="text" name="marca" value='<?php echo $fila['marca']?>' class="form-control">
        </div>
        <div class="form-group">
            <label>Formato</label>
             <select name="formato" class="form-control" value='<?php echo $fila['formato']?>'>
               <?php
               if($fila['formato'] == 'SATA'){?>
                 <option value="SATA">SATA</option>
                 <option value="IDE">IDE</option>
               <?php
               
               }else{?>
                 <option value="IDE">IDE</option>
                 <option value="SATA">SATA</option>
               <?php
               }
               ?>
             </select>
        </div>
        <div class="form-group">
            <label>Tipo fallo</label>
            <select name="fallo" class="form-control" value='<?php echo $fila['tipo_fallo']?>'>
              <?PHP if($fila['tipo_fallo'] == 'Hardware'){?>
                <option value="Hardware">Hardware</option>
                <option value="Software">Software</option>
              <?php 
              
              }else{?>
                <option value="Software">Software</option>
                <option value="Hardware">Hardware</option>
              <?php
              }
              ?>
            </select>
        </div>
        <div class="form-group">
            <label>Descripcion Fallo</label>
            <textarea maxlength="250" name="descripcion" class="form-control"><?php echo $fila['descripcion_fallo']?></textarea>
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
    if(isset($_POST['capacidad'])) $capacidad = $_POST['capacidad'];
    if(isset($_POST['origen'])) $origen = $_POST['origen'];
    if(isset($_POST['casilla'])) $casilla = $_POST['casilla'];
    if(isset($_POST['fecha'])) $fecha = $_POST['fecha'];
    if(isset($_POST['marca'])) $marca = $_POST['marca'];
    if(isset($_POST['formato'])) $formato = $_POST['formato'];
    if(isset($_POST['fallo'])) $fallo = $_POST['fallo'];
    if(isset($_POST['descripcion'])) $descripcion = $_POST['descripcion'];
    ?>
   <?php
    if(isset($_POST['actualizar'])){
echo $sn;
	$actualizar = "update discos set capacidad ='".$_POST["capacidad"]."',origen='".$_POST["origen"]."',casilla='".$_POST["casilla"]."',fecha='".$_POST["fecha"]."',marca='".$_POST["marca"]."',formato='".$_POST["formato"]."',tipo_fallo='".$_POST["fallo"]."',descripcion_fallo='".$_POST["descripcion"]."'where sn='".$_POST['sn']."'";
        echo $actualizar;
	if(mysqli_query($conexion, $actualizar)){ 
            header("Location: discos.php"); 
	}else{ 
          echo  mysqli_error($conexion);
	}
       }
     ?>
        </div>
    </div>
</body>
</html>
