<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php $head = cabecera();?>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="eliminar.php" method="post">
                        <h2>Eliminar al cliente</h2>
                        <input class="btn btn-danger btn-sm" type="submit" name="eliminar" value="Eliminar" /><br><br>
                        <div class="alert alert-warning">
                            <strong>Atención!</strong>Seguro que desea realizar esta operación
                        </div>
                        <input type="hidden" name="borrar" value="true" />
                        <?php if(isset($_GET['id_cliente'])): ?>
                        <input type="hidden" name="id_cliente" value="<?php echo $_GET['id_cliente']; ?>" />
                        <?php endif; ?>
                    </form>
        <a href="clientes.php"><button class="btn">volver</button></a>
                </div>
            </div><br>
    <?php
    //$cogeid = $_POST['id_cliente']; por si acaso borramos directamente
    if(isset($_POST['borrar']) == true){

	$eliminar = "delete from cliente where id_cliente =".$_POST['id_cliente']; 
	if(mysqli_query($conexion, $eliminar)){ 
		header("Location: clientes.php"); 
	}else{ 
            
            echo '<div class="alert alert-danger alert-dismissible">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Atención:</strong> No se puede eliminar al cliente debido a las restricciones existentes, por favor elimine los <a href="parte_servicio.php" class="alert-link">partes de servicio </a>asociados al cliente
                  </div>';
           
            ?><h3>Parte Servicio</h3>
            <a href="parte_servicio.php"><button class='btn btn-primary'>Partes</button></a>
        <?php
	}
    }?>
        </div>
    </div>
</body>
</html>