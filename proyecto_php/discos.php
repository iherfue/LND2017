<?php
include("funciones.php");
$conexion = ConexionBD();
?>
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

      if(isset($_POST["envia_disco"])){
        
        $insercion = mysqli_query($conexion, "insert into discos values ('$sn','$capacidad','$origen','$casilla','$fecha','$marca','$formato','$fallo','$descripcion')");
        echo mysqli_error($conexion);
       header("Location: {$_SERVER['PHP_SELF']}");
        
         }
     ?>   
<html>
<head>
    <title>Discos</title>
    <?php
$head = cabecera();
?>
<style type="text/css">
      
        td, th{
            
            text-align: center;
            padding: 5px;
            border-bottom:solid 1px black;
            margin:0;
        }

</style>
</head>
<body onload="hora(<?php date_default_timezone_set('Europe/Dublin'); echo date("H").", ".date("i").", ".date("s")?>)">
    <script>tinymce.init({ selector:'textarea' });</script>
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
          <li class="active">Discos Duros</li><div style="margin-left: 70%" id="muestra_hora"></div>
        </ol>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <!--ACCESO RÁPIDO-->
          <?php $acceso_rapido = acceso_rapido() ?>
      <div class="col-md-10">
     <!-- Insertar un disco-->
   
       <!-- FORMULARIO PARA AÑADIR CLIENTE-->
    <div class="col-md-7">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#disco" style="margin-left:-2%; margin-top:1%;">
            Añadir Disco Duro
        </button>
   </div>
<section>
  <div id="disco" class="collapse">
        <form action="<?php  htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return valida_discos()">
      <div class="modal-header">
       
        <h4 class="modal-title">Nuevo Disco</h4>
        <button type="button" class="close" data-toggle="collapse" data-target="#disco" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form(antes modal)-->
        <div class="form-group">
              <label>SN *</label>
              <input type="text" name ="sn" class="form-control" required="required" placeholder="ejemplo: 0045NSSHH" maxlength="14" title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduca el Nº de serie del disco duro, máximo 12 carácteres">
        </div>
        <div class="form-group">
              <label>Capacidad *</label>
              <input type="text" name="capacidad" required="required" pattern="[0-9]{2,}" class="form-control" id="capacidad" placeholder="En GB" maxlength="4" title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduzca la capacidad del disco duro expresado en GB">
        </div>
          <div class="form-group">
              <label>Origen *</label>
              <input type="text" name="origen" required ="required" class="form-control" pattern="[A-Za-z]{3,}" placeholder="origen" id="origen" maxlength="10" title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduzca dónde se fabrico el disco duro">
          </div>
          <div class="form-group">
              <label>Casilla *</label>
              <input type="text" name="casilla" required ="required" class="form-control" maxlength="4" title="Información" data-toggle="popover" data-trigger="focus" data-content="Introduca la casilla donde esta asignada el disco duro">
          </div>
          <div class="form-group">
              <label>Fecha*</label>
              <input type="date" name="fecha"  class="form-control" id="fecha" placeholder="fecha" title="Información" data-toggle="popover" data-trigger="focus" data-content="Fecha en la que se fabrico el disco duro">
          </div>
          <div class="form-group">
              <label>Marca</label>
              <input type="text" name="marca"  class="form-control" placeholder="marca" id="marca" title="Información importante" data-toggle="popover" data-trigger="focus" data-content="Debe introducir una de las siguientes marcas: WD,Hitachi,Toshiba,Seagate">
          </div>
          <div class="form-group">
              <label>Tipo De disco</label>
          <select name="formato" class="form-control" title="Información" data-toggle="popover" data-trigger="focus" data-content="Seleccione el formato">
              <option value="SATA">SATA</option>
              <option value="IDE">IDE</option>
          </select>
          </div>
          <div class="form-group">
              <label>Tipo Fallo</label>
          <select name="fallo" class="form-control" title="Información" data-toggle="popover" data-trigger="focus" data-content="Seleccione el motivo del fallo">
              <option value="Hardware">Hardware</option>
              <option value="Software">Software</option>
          </select>
          </div>
          <div class="form-group" title="Recomendación" data-toggle="popover" data-trigger="focus" data-content="Describa el fallo del disco duro máximo 250 carácteres">
              <label>Descripción del Fallo</label>
              <textarea name="descripcion" class="form-control" maxlength="250"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"data-toggle="collapse" data-target="#disco">Cerrar</button>
        <button type="submit" name="envia_disco" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </form>
    </div>    
</section>

<!--FIN DEL FORMULARIO-->
<!-- BUSCAR DISCO Y MUESTRA LA TABLA-->
    <?php  if(isset($_GET['buscar']))$busqueda = $_GET['buscar'];?>
    
    <form action="discos.php" method="GET" class="buscar">
        <label><input type="text" name="buscar" class="typeahead form-control"></label>
        <input type="submit" name="envia_busqueda" value="Buscar">
    </form>
    <?php if(isset($_GET["envia_busqueda"])){?>
    <h2>Discos</h2>
      <table class="table-responsive-md table-striped">
       <thead>
        <tr>    
          <th>SN</th>
          <th>Capacidad</th>
          <th>Origen</th>
          <th>Casilla</th>
          <th>Fecha</th>
          <th>Marca</th>
          <th>Tipo</th>
          <th>Tipo Fallo</th>
          <th>Operación</th>
          <th>Operación</th>
        </tr>
       </thead>
        <tbody>
    <?php
        
        $consulta_registro = "select * from discos where sn like '$busqueda%'";
        $resultado = mysqli_query($conexion,$consulta_registro);
        
        while(($fila= mysqli_fetch_assoc($resultado))==true):
    ?>
        <tr>
       	<td><?php echo $fila['sn']; ?></td>
	<td><?php echo $fila['capacidad']; ?></td>
	<td><?php echo $fila['origen']; ?></td>
	<td><?php echo $fila['casilla']; ?></td>
        <td><?php echo $fila['fecha']; ?></td>
        <td><?php echo $fila['marca']; ?></td>
        <td><?php echo $fila['formato']; ?></td>
        <td><?php echo $fila['tipo_fallo']; ?></td>
        <td><a href="actualizar_disco.php?sn=<?php echo $fila['sn']?>" class="btn btn-primary btn-sm">Modificar</a></td>
        <td><a href="eliminar_disco.php?sn=<?php echo $fila['sn']?>" class="btn btn-danger btn-sm">Eliminar</a></td>
	</tr>  
        <?php endwhile; ?>
            <?php mysqli_free_result($resultado); ?>
	
        </tbody>
      </table>
    <?php }else{?>
        <!-- SI NO SE BUSCA MUESTRA LA TABLA-->
    <h2>Discos</h2>
      <table class="table-responsive-md table-striped">
       <thead>
        <tr>    
            <th>SN</th>
            <th>Capacidad</th>
            <th>Origen</th>
            <th>Casilla</th>
            <th>Tipo</th>
            <th>Fallo</th>
            <th>Operación</th>
            <th>Operación</th>
             </tr>
             </thead>
        <tbody>
    <?php
        
        $consulta = "select * from discos order by casilla asc";
        $resultado = mysqli_query($conexion,$consulta);
        
        while(($fila= mysqli_fetch_assoc($resultado))==true):
    ?>
        <tr>
       	<td><?php echo $fila['sn']; ?></td>
	<td><?php echo $fila['capacidad']; ?></a></td>
	<td><?php echo $fila['origen']; ?></td>
	<td><?php echo $fila['casilla']; ?></td>
        <td><?php echo $fila['formato']; ?></td>
        <td><?php echo $fila['tipo_fallo']; ?></td>
        <td><a href="actualizar_disco.php?sn=<?php echo $fila['sn']?>" class="btn btn-primary btn-sm">Modificar</a></td>
        <td><a href="eliminar_disco.php?sn=<?php echo $fila['sn']?>" class="btn btn-danger btn-sm">Eliminar</a></td>
	</tr>  
        <?php endwhile; ?>
            <?php mysqli_free_result($resultado); ?>
	
        </tbody>
      </table>
        <?php }?>
        </div>
        </div>
    </div>        
</section>
  <?php $pie = footer();?>
<script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>