<?php
include("funciones.php");
$conexion = ConexionBD();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
    <form action="datos_recuperacion.php" method="post">
            <p>Esta seguro de que desea</p>
            <input class="btn-danger" type="submit" name="eliminar" value="Eliminar" />
            <input type="hidden" name="borrar" value="true" />
            <?php if(isset($_GET['id_cliente'])): ?>
            <input type="hidden" name="id_cliente" value="<?php echo $_GET['id_cliente']; ?>" />
            <?php endif; ?>
        </form><br><br>
    <a href="clientes.php">volver</a><br>
	</div>
    <?php
    if(isset($_POST['borrar']) == true){

	$eliminar = "delete from cliente where id_cliente =".$_POST['id_cliente']; 
	if(mysqli_query($conexion, $eliminar)){ 
		header("Location: clientes.php"); 
	}else{ 
            echo "Hubo un problema al eliminar el registro, Esto puede deberse a las Restricciones que existen, Asegurese de eliminar los partes de servicio asociados al cliente <br>";
          ?><a href="parte_servicio.php">Partes</a>
        <?php
	}
    }?>
</body>
</html>